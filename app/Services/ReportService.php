<?php

namespace App\Services;

use App\Models\Score;
use Illuminate\Support\Facades\DB;

class ReportService
{
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

    public function getAllSubjectStatistics(): array
    {
        $stats = [];
        foreach ($this->subjects as $subject) {
            $stats[$subject] = $this->getStatisticsForSubject($subject);
        }
        return $stats;
    }

    protected function getStatisticsForSubject(string $subject): array
    {
        // Sử dụng query tối ưu với index trên cột điểm
        return [
            '>=8'  => Score::where($subject, '>=', 8)->count(),
            '6-8'  => Score::where($subject, '>=', 6)
                ->where($subject, '<', 8)->count(),
            '4-6'  => Score::where($subject, '>=', 4)
                ->where($subject, '<', 6)->count(),
            '<4'   => Score::where($subject, '<', 4)->count(),
        ];
    }
}
