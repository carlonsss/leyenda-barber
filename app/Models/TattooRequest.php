<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TattooRequest extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'branch',
        'tattoo_style_id', 'body_area', 'budget', 'status',
    ];

    protected $casts = [
        'images' => 'array',
        'budget' => 'decimal:2',
    ];

    public function style(): BelongsTo
    {
        return $this->belongsTo(TattooStyle::class, 'tattoo_style_id');
    }
}
