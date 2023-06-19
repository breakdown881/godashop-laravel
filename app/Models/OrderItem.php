<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ViewProduct;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OrderItem extends Model
{
    use HasFactory;
    public $timestamps = false;
    
    /**
     * Get all of the comments for the OrderItem
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    
     /**
      * Get the user associated with the OrderItem
      *
      * @return \Illuminate\Database\Eloquent\Relations\HasOne
      */
     public function product(): BelongsTo
     {
         return $this->belongsTo(ViewProduct::class, 'product_id');
     }
}