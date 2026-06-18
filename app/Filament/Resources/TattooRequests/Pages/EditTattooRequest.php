<?php

namespace App\Filament\Resources\TattooRequests\Pages;

use App\Filament\Resources\TattooRequests\TattooRequestResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTattooRequest extends EditRecord
{
    protected static string $resource = TattooRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
