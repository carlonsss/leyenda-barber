<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TattooWork extends Model
{
    protected $fillable = ['title', 'image', 'description', 'tattoo_style_id'];

    public function style(): BelongsTo
    {
        return $this->belongsTo(TattooStyle::class);
    }
}
