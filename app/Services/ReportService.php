<?php

namespace App\Services;

use App\Models\ScoreStatistic;

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
            // Lấy tất cả dòng cho môn học này
            $rows = ScoreStatistic::where('subject', $subject)
                ->pluck('student_count', 'range_key');

            $stats[$subject] = [
                '>=8' => $rows['>=8'] ?? 0,
                '6-8' => $rows['6-8'] ?? 0,
                '4-6' => $rows['4-6'] ?? 0,
                '<4'  => $rows['<4'] ?? 0,
            ];
        }

        return $stats;
    }
}
