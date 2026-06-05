<?php

namespace App\Http\Controllers;

use App\Services\Top10Service;
use Illuminate\Http\Request;

class Top10Controller extends Controller
{
    public function __construct(protected Top10Service $top10Service) {}

    public function index()
    {
        $top10 = $this->top10Service->getTop10GroupA();
        return view('top10', compact('top10'));
    }
}
