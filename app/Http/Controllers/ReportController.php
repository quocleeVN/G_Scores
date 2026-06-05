<?php

namespace App\Http\Controllers;

use App\Services\ReportService;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct(protected ReportService $reportService) {}

    public function index()
    {
        $statistics = $this->reportService->getAllSubjectStatistics();
        $subjects = array_keys($statistics);

        return view('report', compact('statistics', 'subjects'));
    }
}
