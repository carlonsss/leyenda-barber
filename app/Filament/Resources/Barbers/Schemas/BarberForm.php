<?php

namespace App\Filament\Resources\Barbers\Schemas;

use App\Models\SiteSetting;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;

class BarberForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            TextInput::make('name')
                ->label('Nombre completo')
                ->required()
                ->maxLength(100),

            TextInput::make('role')
                ->label('Especialidad / Rol')
                ->placeholder('Ej: Barbero Senior, Especialista en degradados...')
                ->nullable()
                ->maxLength(100),

            Select::make('branch')
                ->label('Sucursal')
                ->options(fn () => collect(SiteSetting::branches())->mapWithKeys(fn ($b, $i) => [$i + 1 => $b['name']])->all())
                ->placeholder('Ambas sucursales')
                ->helperText('Déjalo vacío si trabaja en las dos.')
                ->nullable(),

            Textarea::make('description')
                ->label('Descripción breve')
                ->placeholder('Cuéntanos sobre este barbero...')
                ->nullable()
                ->rows(3)
                ->maxLength(500)
                ->columnSpanFull(),

            FileUpload::make('image')
                ->label('Foto de perfil')
                ->image()
                ->disk('public')
                ->visibility('public')
                ->directory('barbers')
                ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                ->maxSize(4096)
                ->nullable()
                ->helperText('JPG, PNG o WebP · Máx. 4 MB'),

            Toggle::make('active')
                ->label('Visible en la web')
                ->helperText('Si está desactivado, no aparece en la página de barbería.')
                ->default(true)
                ->onColor('success'),
        ]);
    }
}
