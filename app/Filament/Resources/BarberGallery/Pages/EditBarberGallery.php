<?php

namespace App\Filament\Resources\BarberGallery\Pages;

use App\Filament\Resources\BarberGallery\BarberGalleryResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditBarberGallery extends EditRecord
{
    protected static string $resource = BarberGalleryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
