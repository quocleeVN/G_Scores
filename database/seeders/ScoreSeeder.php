<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use SplFileObject;

class ScoreSeeder extends Seeder
{
    protected string $filePath;
    protected int $batchSize = 500;

    public function __construct()
    {
        $this->filePath = storage_path('app/diem_thi_thpt_2024.csv');
    }

    public function run(): void
    {
        if (!file_exists($this->filePath)) {
            $this->command?->error("CSV file not found: {$this->filePath}");
            Log::error("ScoreSeeder: File not found", ['path' => $this->filePath]);
            return;
        }

        $this->command?->info('Starting CSV import...');
        Log::info('ScoreSeeder: Import started');

        DB::table('scores')->truncate();

        $file = new SplFileObject($this->filePath);
        $file->setFlags(SplFileObject::READ_CSV | SplFileObject::DROP_NEW_LINE);

        // Đọc dòng tiêu đề
        $headers = $file->fgetcsv();
        if ($headers === false) {
            $this->command?->error('CSV file is empty or invalid.');
            Log::error('ScoreSeeder: Cannot read headers');
            return;
        }

        $rows = [];
        $lineNo = 1;
        $imported = 0;
        $errors = 0;

        while (!$file->eof()) {
            $lineNo++;
            $data = $file->fgetcsv();
            if ($data === false || $data === [null]) {
                continue;
            }

            // Ghép dữ liệu với header
            $row = array_combine($headers, $data);
            if ($row === false || empty($row['sbd'])) {
                Log::warning("ScoreSeeder: Invalid row at line {$lineNo}", $data);
                $errors++;
                continue;
            }

            // Chuẩn hóa dữ liệu: thay chuỗi rỗng thành null cho các trường điểm
            $row = array_map(function ($value) {
                return $value === '' ? null : $value;
            }, $row);

            $rows[] = [
                'sbd'          => $row['sbd'],
                'toan'         => $row['toan'],
                'ngu_van'      => $row['ngu_van'],
                'ngoai_ngu'    => $row['ngoai_ngu'],
                'vat_li'       => $row['vat_li'],
                'hoa_hoc'      => $row['hoa_hoc'],
                'sinh_hoc'     => $row['sinh_hoc'],
                'lich_su'      => $row['lich_su'],
                'dia_li'       => $row['dia_li'],
                'gdcd'         => $row['gdcd'],
                'ma_ngoai_ngu' => $row['ma_ngoai_ngu'],
                'created_at'   => now(),
                'updated_at'   => now(),
            ];

            if (count($rows) >= $this->batchSize) {
                $this->insertBatch($rows, $imported, $errors);
                $rows = [];
            }
        }

        // Chèn batch cuối cùng
        if (!empty($rows)) {
            $this->insertBatch($rows, $imported, $errors);
        }

        $this->command?->info("Import completed: {$imported} rows inserted, {$errors} errors.");
        Log::info("ScoreSeeder: Import finished", ['imported' => $imported, 'errors' => $errors]);

        // Gọi command để tạo thống kê vào bảng score_statistics
        Artisan::call('scores:generate-statistics');
        $this->command?->info('Đã tạo thống kê điểm thi.');
    }

    protected function insertBatch(array &$rows, int &$imported, int &$errors): void
    {
        try {
            DB::table('scores')->insert($rows);
            $imported += count($rows);
        } catch (\Exception $e) {
            $errors += count($rows);
            Log::error('ScoreSeeder: Batch insert failed', [
                'error' => $e->getMessage(),
                'rows_count' => count($rows),
            ]);
        }
    }
}
