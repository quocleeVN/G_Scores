<?php

namespace App\Http\Controllers;

use App\Http\Requests\LookupScoreRequest;
use App\Services\ScoreLookupService;
use Illuminate\Http\Request;

class ScoreLookupController extends Controller
{
    public function __construct(protected ScoreLookupService $lookupService) {}

    public function showForm()
    {
        return view('lookup');
    }

    public function lookup(LookupScoreRequest $request)
    {
        $sbd = $request->validated('sbd');
        $score = $this->lookupService->findBySbd($sbd);

        if (!$score) {
            return back()->withInput()->with('error', 'Không tìm thấy thí sinh với số báo danh này.');
        }

        return view('lookup', ['result' => $score]);
    }
}
