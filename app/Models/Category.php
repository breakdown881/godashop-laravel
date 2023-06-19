<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ViewProduct;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    /**
     * Get all of the comments for the Category
     *
     * 
     */
    public function products(): HasMany
    {
        return $this->hasMany(ViewProduct::class, 'category_id', 'id');
    }
}