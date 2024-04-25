<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SizeChartValue extends Model
{
    use HasFactory;

    public function sizeChart()
    {
        $this->belongsToMany(SizeChart::class);
    }
}
