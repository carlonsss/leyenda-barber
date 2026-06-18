<?php

namespace App\Filament\Resources\TattooStyles\Pages;

use App\Filament\Resources\TattooStyles\TattooStyleResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTattooStyles extends ListRecords
{
    protected static string $resource = TattooStyleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
