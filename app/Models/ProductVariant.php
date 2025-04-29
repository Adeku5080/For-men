<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_path',
        'product_details',
        'quantity',
        'sku',
        'product_id',
        'variant_name',
        'slug',
        'price'
    ];

    public function defaltProduct()
    {
        return $this->hasOne(Product::class, 'default_variant_id');
    }

    public function attributeOptions()
    {
        return $this->belongsToMany(AttributeOption::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
