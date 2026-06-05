<?php

namespace App\Services;

use App\Models\Score;

class Top10Service
{
    public function getTop10GroupA(): \Illuminate\Database\Eloquent\Collection
    {
        return Score::hasValidGroupA()
            ->orderBy('khoi_a_total', 'desc')
            ->select('sbd', 'toan', 'vat_li', 'hoa_hoc', 'khoi_a_total')
            ->limit(10)
            ->get();
    }
}
