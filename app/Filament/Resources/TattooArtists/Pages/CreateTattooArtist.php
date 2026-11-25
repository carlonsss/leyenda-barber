<?php

namespace App\Filament\Resources\TattooArtists\Pages;

use App\Filament\Resources\TattooArtists\TattooArtistResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTattooArtist extends CreateRecord
{
    protected static string $resource = TattooArtistResource::class;
}
