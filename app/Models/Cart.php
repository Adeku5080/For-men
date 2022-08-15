<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @method static self create(...$data)
 *
 */
class Cart extends Model
{
    use HasFactory;

    protected $fillable =[

        "user_id",

    ];


    /**
     *
     * @return HasMany
     */
   public function cartItem () {
        return $this->hasMany(CartItem::class);
   }

    /**
     *
     * @return BelongsTo
     */
   public function user () {
       return $this->belongsTo(User::class);
   }
}
