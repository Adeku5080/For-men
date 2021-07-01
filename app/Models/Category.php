<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Category.
 *
 * @property SubCategory[]|Collection $subCategories
 */
class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'file_path',
    ];

    /**
     * todo: leave comment
     *
     * @return HasMany
     */
    public function subCategories(): HasMany
    {
        return $this->hasMany(SubCategory::class);
    }
}
