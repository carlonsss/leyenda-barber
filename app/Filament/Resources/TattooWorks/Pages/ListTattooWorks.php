<?php

namespace App\Filament\Resources\TattooWorks\Pages;

use App\Filament\Resources\TattooWorks\TattooWorkResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTattooWorks extends ListRecords
{
    protected static string $resource = TattooWorkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
