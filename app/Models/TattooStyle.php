<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TattooStyle extends Model
{
    protected $fillable = ['name', 'description', 'image'];

    public function works(): HasMany
    {
        return $this->hasMany(TattooWork::class);
    }
}
