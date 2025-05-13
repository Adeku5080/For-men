<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_variant_id',
        'quantity',
        'cart_id',
        'size',
        'item_name',
        'item_file_path',
        'item_price',
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
}
