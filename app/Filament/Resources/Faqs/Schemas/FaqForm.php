<?php

namespace App\Filament\Resources\Faqs\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class FaqForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Pregunta')
                ->schema([
                    Select::make('section')
                        ->label('Sección de la web')
                        ->options([
                            'barberia' => 'Barbería',
                            'tatuajes' => 'Tatuajes',
                            'tienda'   => 'Tienda',
                        ])
                        ->required()
                        ->native(false),

                    TextInput::make('question')
                        ->label('Pregunta')
                        ->required()
                        ->maxLength(500)
                        ->columnSpanFull(),

                    Textarea::make('answer')
                        ->label('Respuesta')
                        ->required()
                        ->rows(4)
                        ->columnSpanFull(),
                ])
                ->columns(2),

            Section::make('Opciones')
                ->schema([
                    TextInput::make('sort_order')
                        ->label('Orden de aparición')
                        ->numeric()
                        ->default(0)
                        ->hint('Número más bajo = aparece primero'),

                    Toggle::make('active')
                        ->label('Visible en la web')
                        ->default(true)
                        ->onColor('success'),
                ])
                ->columns(2),
        ]);
    }
}
