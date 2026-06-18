<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Información del producto')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->label('Nombre del producto')
                            ->required()
                            ->columnSpanFull(),

                        Textarea::make('description')
                            ->label('Descripción')
                            ->rows(3)
                            ->columnSpanFull(),

                        TextInput::make('price')
                            ->label('Precio (€)')
                            ->numeric()
                            ->prefix('€')
                            ->required(),

                        TextInput::make('stock')
                            ->label('Stock disponible')
                            ->numeric()
                            ->default(0)
                            ->helperText('Solo para productos sin tallas. Si usas tallas, el stock se calcula automáticamente.')
                            ->hidden(fn(Get $get): bool => !empty($get('size_options')))
                            ->required(fn(Get $get): bool => empty($get('size_options'))),
                    ]),

                Section::make('Visibilidad en tienda')
                    ->description('Controla cómo aparece el producto en la tienda.')
                    ->columns(2)
                    ->schema([
                        Select::make('category')
                            ->label('Categoría')
                            ->options([
                                'camisetas'  => 'Camisetas',
                                'sudaderas'  => 'Sudaderas',
                                'pantalones' => 'Pantalones',
                                'accesorios' => 'Accesorios',
                            ])
                            ->nullable()
                            ->placeholder('Sin categoría')
                            ->helperText('Filtra el producto en la tienda por categoría.'),

                        Toggle::make('is_new')
                            ->label('Nueva colección')
                            ->helperText('Aparece en la sección "Nueva Colección" con badge NEW.')
                            ->default(false),

                        Toggle::make('is_featured')
                            ->label('Más vendido')
                            ->helperText('Aparece en la sección "Más Vendidos" de la tienda.')
                            ->default(false),
                    ]),

                Section::make('Tallas y stock')
                    ->description('Añade cada talla con su stock. El stock total se calcula automáticamente como la suma de todas las tallas.')
                    ->schema([
                        Select::make('_size_preset')
                            ->label('Rellenar rápido')
                            ->options([
                                'none'  => 'Sin tallas (accesorio / talla libre)',
                                'adult' => 'Ropa adulto — S / M / L / XL / XXL',
                            ])
                            ->live()
                            ->afterStateUpdated(function ($state, $set) {
                                match ($state) {
                                    'none'  => $set('size_options', []),
                                    'adult' => $set('size_options', ['S' => 0, 'M' => 0, 'L' => 0, 'XL' => 0, 'XXL' => 0]),
                                    default => null,
                                };
                            })
                            ->dehydrated(false)
                            ->nullable(),

                        KeyValue::make('size_options')
                            ->label('Tallas y stock disponible')
                            ->keyLabel('Talla (ej: S, M, L, XL)')
                            ->valueLabel('Unidades en stock')
                            ->addActionLabel('Añadir talla')
                            ->live()
                            ->helperText('Pon a 0 las tallas agotadas. Deja vacío si el producto no tiene tallas.'),

                        Textarea::make('size_guide')
                            ->label('Guía de tallas personalizada (opcional)')
                            ->helperText('Si lo rellenas, aparecerá en el modal "Guía de tallas" de este producto. Puedes poner medidas, equivalencias, etc. Si lo dejas vacío se mostrará la tabla genérica.')
                            ->rows(5)
                            ->nullable()
                            ->placeholder("Ej:\nS — Pecho 92-96 cm, Largo 69 cm\nM — Pecho 96-100 cm, Largo 71 cm\n...")
                            ->columnSpanFull(),
                    ]),

                Section::make('Imágenes del producto')
                    ->description('Sube múltiples fotos. Puedes reordenarlas arrastrando. La primera imagen es la principal.')
                    ->schema([
                        FileUpload::make('images')
                            ->label('Fotos del producto')
                            ->multiple()
                            ->image()
                            ->disk('public')
                            ->visibility('public')
                            ->directory('products')
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->maxSize(20480)
                            ->reorderable()
                            ->helperText('JPG, PNG o WebP · Máx. 20 MB por imagen')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
