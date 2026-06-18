<?php

namespace App\Filament\Resources\Services\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Forms\Components\FileUpload;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')
                ->label('Nombre del servicio')
                ->required()
                ->maxLength(100),

            Textarea::make('description')
                ->label('Descripción')
                ->nullable()
                ->rows(3)
                ->maxLength(300)
                ->columnSpanFull(),

            TextInput::make('price')
                ->label('Precio (€)')
                ->numeric()
                ->prefix('€')
                ->minValue(0),

            TextInput::make('duration')
                ->label('Duración (min)')
                ->numeric()
                ->suffix('min')
                ->minValue(1),

            FileUpload::make('image')
                ->label('Imagen del servicio')
                ->image()
                ->disk('public')
                ->visibility('public')
                ->directory('services')
                ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                ->maxSize(4096)
                ->nullable()
                ->helperText('JPG, PNG o WebP · Máx. 4 MB')
                ->columnSpanFull(),
        ]);
    }
}
