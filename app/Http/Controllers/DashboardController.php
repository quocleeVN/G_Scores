<?php

namespace App\Http\Controllers;

use App\Models\Score;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalStudents = Score::count();
        $totalSubjects = 9;
        return view('dashboard', compact('totalStudents', 'totalSubjects'));
    }
}
