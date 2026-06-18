<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Barber extends Model
{
    protected $fillable = [
        'name',
        'role',
        'description',
        'image',
        'active',
    ];

    public function gallery(): HasMany
    {
        return $this->hasMany(BarberGallery::class);
    }
}