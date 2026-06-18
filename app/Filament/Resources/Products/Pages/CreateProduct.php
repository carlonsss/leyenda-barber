<?php

namespace App\Filament\Resources\Products\Pages;

use App\Filament\Resources\Products\ProductResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $sizes = $data['size_options'] ?? [];
        if (!empty($sizes)) {
            $data['stock'] = array_sum(array_map('intval', array_values($sizes)));
        }
        return $data;
    }
}
