<?php

namespace App\Filament\Resources\TattooWorks\Pages;

use App\Filament\Resources\TattooWorks\TattooWorkResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTattooWork extends EditRecord
{
    protected static string $resource = TattooWorkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (empty($data['image'])) {
            $data['image'] = $this->record->image;
        }

        return $data;
    }
}
