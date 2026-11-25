<?php

namespace App\Filament\Resources\TattooArtists\Schemas;

use App\Models\SiteSetting;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TattooArtistForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            TextInput::make('name')
                ->label('Nombre del artista')
                ->required()
                ->maxLength(100),

            TextInput::make('style')
                ->label('Especialidades')
                ->placeholder('Ej: Realismo · Blackwork · Fine Line')
                ->nullable()
                ->maxLength(150),

            Select::make('branch')
                ->label('Sucursal')
                ->options(fn () => collect(SiteSetting::branches())->mapWithKeys(fn ($b, $i) => [$i + 1 => $b['name']])->all())
                ->placeholder('Ambas sucursales')
                ->helperText('Déjalo vacío si trabaja en las dos.')
                ->nullable(),

            Textarea::make('bio')
                ->label('Biografía / descripción')
                ->rows(4)
                ->nullable()
                ->columnSpanFull(),

            FileUpload::make('image')
                ->label('Foto del artista')
                ->image()
                ->disk('public')
                ->visibility('public')
                ->directory('artists')
                ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                ->maxSize(4096)
                ->nullable()
                ->helperText('JPG, PNG o WebP · Máx. 4 MB'),

            Toggle::make('active')
                ->label('Visible en la web')
                ->default(true)
                ->onColor('success'),
        ]);
    }
}
