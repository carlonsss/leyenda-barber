<?php

namespace App\Filament\Resources\TattooRequests\Pages;

use App\Filament\Resources\TattooRequests\TattooRequestResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTattooRequest extends CreateRecord
{
    protected static string $resource = TattooRequestResource::class;
}
