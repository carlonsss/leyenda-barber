<?php

namespace App\Filament\Resources\TattooStyles\Pages;

use App\Filament\Resources\TattooStyles\TattooStyleResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTattooStyle extends EditRecord
{
    protected static string $resource = TattooStyleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
