<?php

namespace App\Filament\Resources\BarberGallery\Schemas;

use App\Models\Barber;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BarberGalleryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('title')
                ->label('Título o descripción')
                ->required()
                ->maxLength(100),

            FileUpload::make('image')
                ->label('Foto')
                ->image()
                ->disk('public')
                ->visibility('public')
                ->directory('gallery')
                ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                ->maxSize(3072)
                ->required()
                ->helperText('JPG, PNG o WebP · Máx. 3 MB'),

            Select::make('barber_id')
                ->label('Barbero (opcional)')
                ->options(Barber::query()->pluck('name', 'id'))
                ->nullable()
                ->searchable()
                ->helperText('Relaciona esta foto con un barbero concreto.'),
        ]);
    }
}
