<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BarberGallery extends Model
{
    protected $table = 'barber_gallery';

    protected $fillable = [
        'title',
        'image',
        'barber_id',
    ];

    public function barber(): BelongsTo
    {
        return $this->belongsTo(Barber::class);
    }
}
