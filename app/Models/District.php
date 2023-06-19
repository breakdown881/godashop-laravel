<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ward;
use App\Models\Province;
use Illuminate\Database\Eloquent\Relations\HasMany;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;


class District extends Model
{
    use HasFactory;

    protected $keyType = 'string';

    /**
     * Get all of the comments for the Category
     *
     * 
     */
    /**
     * Get all of the comments for the District
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function wards(): HasMany
    {
        return $this->hasMany(Ward::class);
    }

    /**
     * Get the user that owns the District
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }
}