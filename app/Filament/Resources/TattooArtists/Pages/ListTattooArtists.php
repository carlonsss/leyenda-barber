<?php

namespace App\Filament\Resources\TattooArtists\Pages;

use App\Filament\Resources\TattooArtists\TattooArtistResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTattooArtists extends ListRecords
{
    protected static string $resource = TattooArtistResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
