<?php

namespace App\Filament\Resources\TattooArtists\Pages;

use App\Filament\Resources\TattooArtists\TattooArtistResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTattooArtist extends EditRecord
{
    protected static string $resource = TattooArtistResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
