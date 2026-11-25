<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TattooArtist extends Model
{
    protected $fillable = ['name', 'style', 'bio', 'image', 'branch', 'active'];

    protected $casts = ['active' => 'boolean'];
}
