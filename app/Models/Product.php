<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'price', 'images', 'size_options', 'size_guide', 'stock', 'is_new', 'is_featured', 'category'];

    protected $casts = [
        'price'        => 'decimal:2',
        'images'       => 'array',
        'size_options' => 'array',
        'is_new'       => 'boolean',
        'is_featured'  => 'boolean',
    ];

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
