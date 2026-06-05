<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ScoreLookupController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Top10Controller;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::prefix('scores')->name('scores.')->group(function () {
    Route::get('/lookup', [ScoreLookupController::class, 'showForm'])->name('lookup.form');
    Route::post('/lookup', [ScoreLookupController::class, 'lookup'])->name('lookup');
});

Route::get('/statistics', [ReportController::class, 'index'])->name('statistics');
Route::get('/top10-group-a', [Top10Controller::class, 'index'])->name('top10');
