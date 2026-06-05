<?php

namespace App\Services;

use App\Models\Score;
use Illuminate\Support\Facades\Cache;

class ScoreLookupService
{
    public function findBySbd(string $sbd): ?Score
    {
        $scoreData = Cache::remember("score_{$sbd}", 300, function () use ($sbd) {
            $score = Score::where('sbd', $sbd)->first();
            return $score ? $score->toArray() : null;
        });
        return $scoreData ? (new Score())->newFromBuilder($scoreData) : null;
    }
}
