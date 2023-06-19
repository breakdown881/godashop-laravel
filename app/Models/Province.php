<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\District;
use Illuminate\Database\Eloquent\Relations\HasMany;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;


class Province extends Model
{
    use HasFactory;

    protected $keyType = 'string';

    /**
     * Get all of the comments for the Category
     *
     * 
     */
    public function districts(): HasMany
    {
        return $this->hasMany(District::class);
    }
}