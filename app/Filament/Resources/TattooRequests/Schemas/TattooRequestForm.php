<?php

namespace App\Filament\Resources\TattooRequests\Schemas;

use App\Models\TattooStyle;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TattooRequestForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nombre')
                    ->required(),

                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required(),

                TextInput::make('phone')
                    ->label('Teléfono')
                    ->tel()
                    ->nullable(),

                TextInput::make('branch')
                    ->label('Sucursal')
                    ->nullable(),

                Select::make('tattoo_style_id')
                    ->label('Estilo de tatuaje')
                    ->options(TattooStyle::query()->pluck('name', 'id'))
                    ->searchable()
                    ->nullable(),

                TextInput::make('body_area')
                    ->label('Zona del cuerpo')
                    ->nullable(),

                TextInput::make('budget')
                    ->label('Presupuesto (€)')
                    ->numeric()
                    ->prefix('€')
                    ->nullable(),

                Select::make('status')
                    ->label('Estado')
                    ->options([
                        'pending'   => 'Pendiente',
                        'contacted' => 'Contactado',
                        'closed'    => 'Cerrado',
                    ])
                    ->default('pending')
                    ->required(),
            ]);
    }
}
