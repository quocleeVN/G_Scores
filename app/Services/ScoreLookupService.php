<?php

namespace App\Services;

use App\Models\Score;
use Illuminate\Support\Facades\Cache;

class ScoreLookupService
{
    public function findBySbd(string $sbd): ?Score
    {
        return Cache::remember("score_{$sbd}", 300, function () use ($sbd) {
            return Score::where('sbd', $sbd)->first();
        });
    }
}
