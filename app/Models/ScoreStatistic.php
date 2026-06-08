<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScoreStatistic extends Model
{
    protected $table = 'score_statistics';

    protected $fillable = ['subject', 'range_key', 'student_count'];

    public $timestamps = true;
}
