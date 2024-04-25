<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SizeChart extends Model
{
    use HasFactory;

    protected $fillable = [
        'chest_size',
        'waist_size',
    ];

    /**
     * @return BelongsTo
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    public function sizeChartValues(): hasMany
    {
        return $this->hasMany(SizeChartValue::class);
    }
}
