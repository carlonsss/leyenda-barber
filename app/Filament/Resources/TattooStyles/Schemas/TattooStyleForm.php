<?php

namespace App\Filament\Resources\TattooStyles\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TattooStyleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')
                ->label('Nombre del estilo')
                ->required()
                ->maxLength(100)
                ->placeholder('Ej: Realismo, Blackwork, Fine Line...'),

            Textarea::make('description')
                ->label('Descripción')
                ->nullable()
                ->rows(3)
                ->maxLength(300)
                ->columnSpanFull(),

            FileUpload::make('image')
                ->label('Imagen de ejemplo (opcional)')
                ->image()
                ->disk('public')
                ->visibility('public')
                ->directory('tattoo-styles')
                ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                ->maxSize(3072)
                ->nullable()
                ->helperText('JPG, PNG o WebP · Máx. 3 MB')
                ->columnSpanFull(),
        ]);
    }
}
