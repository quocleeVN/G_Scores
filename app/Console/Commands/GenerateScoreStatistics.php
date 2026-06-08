<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\ScoreStatistic;

class GenerateScoreStatistics extends Command
{
    protected $signature = 'scores:generate-statistics';
    protected $description = 'Tính toán và lưu thống kê điểm vào bảng score_statistics';

    protected array $subjects = [
        'toan',
        'ngu_van',
        'ngoai_ngu',
        'vat_li',
        'hoa_hoc',
        'sinh_hoc',
        'lich_su',
        'dia_li',
        'gdcd',
    ];

    public function handle(): int
    {
        $this->info('Đang tính toán thống kê...');

        // Xóa dữ liệu cũ
        ScoreStatistic::truncate();

        // Chuẩn bị dữ liệu để insert
        $insertData = [];

        foreach ($this->subjects as $subject) {
            $stats = DB::table('scores')
                ->selectRaw("
                    SUM(CASE WHEN {$subject} >= 8 THEN 1 ELSE 0 END) AS ge8,
                    SUM(CASE WHEN {$subject} >= 6 AND {$subject} < 8 THEN 1 ELSE 0 END) AS `6_8`,
                    SUM(CASE WHEN {$subject} >= 4 AND {$subject} < 6 THEN 1 ELSE 0 END) AS `4_6`,
                    SUM(CASE WHEN {$subject} < 4 THEN 1 ELSE 0 END) AS lt4
                ")
                ->first();

            $insertData[] = [
                'subject'       => $subject,
                'range_key'     => '>=8',
                'student_count' => $stats->ge8,
                'created_at'    => now(),
                'updated_at'    => now(),
            ];
            $insertData[] = [
                'subject'       => $subject,
                'range_key'     => '6-8',
                'student_count' => $stats->{'6_8'},
                'created_at'    => now(),
                'updated_at'    => now(),
            ];
            $insertData[] = [
                'subject'       => $subject,
                'range_key'     => '4-6',
                'student_count' => $stats->{'4_6'},
                'created_at'    => now(),
                'updated_at'    => now(),
            ];
            $insertData[] = [
                'subject'       => $subject,
                'range_key'     => '<4',
                'student_count' => $stats->lt4,
                'created_at'    => now(),
                'updated_at'    => now(),
            ];
        }

        ScoreStatistic::insert($insertData);

        $this->info('Đã lưu thống kê thành công.');
        return Command::SUCCESS;
    }
}
