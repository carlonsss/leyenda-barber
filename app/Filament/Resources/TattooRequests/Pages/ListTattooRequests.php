<?php

namespace App\Filament\Resources\TattooRequests\Pages;

use App\Filament\Resources\TattooRequests\TattooRequestResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTattooRequests extends ListRecords
{
    protected static string $resource = TattooRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
