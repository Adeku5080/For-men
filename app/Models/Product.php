<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable =[
        'name',
        'price',
        'brand_id',
        'description',
        'file_path',
        'subcategory_id',
    ];

    /**
     *
     * @return BelongsTo
     *
     */
    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class);
    }

    /**
     * @return BelongsTo
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

}
