<?php

namespace App\Filament\Resources\TattooWorks\Schemas;

use App\Models\TattooStyle;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TattooWorkForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            FileUpload::make('image')
                ->label('Foto del trabajo')
                ->image()
                ->disk('public')
                ->visibility('public')
                ->directory('tattoo-works')
                ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                ->maxSize(4096)
                ->required(fn(string $operation): bool => $operation === 'create')
                ->helperText('JPG, PNG o WebP · Máx. 4 MB. Deja vacío al editar para conservar la imagen actual.')
                ->columnSpanFull(),

            TextInput::make('title')
                ->label('Título')
                ->required()
                ->maxLength(100),

            Select::make('tattoo_style_id')
                ->label('Estilo de tatuaje')
                ->options(TattooStyle::query()->pluck('name', 'id'))
                ->searchable()
                ->required()
                ->helperText('El estilo determina en qué categoría aparece en el portfolio.'),

            Textarea::make('description')
                ->label('Descripción (opcional)')
                ->nullable()
                ->rows(3)
                ->maxLength(300)
                ->columnSpanFull(),
        ]);
    }
}
