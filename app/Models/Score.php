<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    //
    protected $table = 'scores';

    protected $fillable = [
        'sbd',
        'toan',
        'ngu_van',
        'ngoai_ngu',
        'vat_li',
        'hoa_hoc',
        'sinh_hoc',
        'lich_su',
        'dia_li',
        'gdcd',
        'ma_ngoai_ngu',
    ];

    protected $casts = [
        'toan' => 'decimal:2',
        'ngu_van' => 'decimal:2',
        'ngoai_ngu' => 'decimal:2',
        'vat_li' => 'decimal:2',
        'hoa_hoc' => 'decimal:2',
        'sinh_hoc' => 'decimal:2',
        'lich_su' => 'decimal:2',
        'dia_li' => 'decimal:2',
        'gdcd' => 'decimal:2',
        'khoi_a_total' => 'decimal:2',
    ];

    public function scopeHasValidGroupA($query)
    {
        return $query->whereNotNull('toan')
            ->whereNotNull('vat_li')
            ->whereNotNull('hoa_hoc');
    }
}
