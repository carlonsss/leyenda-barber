<?php

namespace App\Filament\Resources\BarberGallery\Pages;

use App\Filament\Resources\BarberGallery\BarberGalleryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBarberGalleries extends ListRecords
{
    protected static string $resource = BarberGalleryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
