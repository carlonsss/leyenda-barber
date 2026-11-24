<?php

namespace App\Filament\Resources\Orders\Schemas;

use App\Models\Product;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            TextInput::make('customer_name')
                ->label('Nombre del cliente')
                ->required()
                ->maxLength(100),

            TextInput::make('customer_phone')
                ->label('Teléfono')
                ->tel()
                ->required(),

            TextInput::make('customer_email')
                ->label('Email')
                ->email()
                ->nullable(),

            Select::make('pickup_branch')
                ->label('Sucursal de recogida')
                ->options(fn () => collect(\App\Models\SiteSetting::branches())->pluck('label', 'label')->all())
                ->nullable(),

            Textarea::make('notes')
                ->label('Notas del pedido')
                ->rows(2)
                ->nullable()
                ->hint('Recogida en tienda — sin envíos a domicilio')
                ->columnSpanFull(),

            Select::make('status')
                ->label('Estado')
                ->options([
                    'pending'   => 'Pendiente',
                    'contacted' => 'Contactado',
                    'completed' => 'Completado',
                    'cancelled' => 'Cancelado',
                ])
                ->default('pending')
                ->required(),

            Repeater::make('items')
                ->label('Productos del pedido')
                ->relationship()
                ->schema([

                    Select::make('product_id')
                        ->label('Producto')
                        ->options(Product::query()->where('stock', '>', 0)->pluck('name', 'id'))
                        ->searchable()
                        ->required()
                        ->live()
                        ->afterStateUpdated(function ($state, $set) {
                            $product = Product::find($state);
                            if ($product) {
                                $set('price', $product->price);
                                $set('size', null);
                            }
                        }),

                    Select::make('size')
                        ->label('Talla')
                        ->options(function ($get): array {
                            $productId = $get('product_id');
                            if (!$productId) {
                                return [];
                            }
                            $product = Product::find($productId);
                            if (!$product || empty($product->size_options)) {
                                return ['—' => 'Sin talla'];
                            }
                            return array_combine($product->size_options, $product->size_options);
                        })
                        ->nullable()
                        ->live(),

                    TextInput::make('quantity')
                        ->label('Cantidad')
                        ->numeric()
                        ->default(1)
                        ->minValue(1)
                        ->required(),

                    TextInput::make('price')
                        ->label('Precio unitario (€)')
                        ->numeric()
                        ->prefix('€')
                        ->disabled()
                        ->dehydrated(true)
                        ->afterStateHydrated(function ($state, $set, $record) {
                            if ($record && $record->product) {
                                $set('price', $record->product->price);
                            }
                        }),

                ])
                ->columns(4)
                ->columnSpanFull()
                ->defaultItems(1)
                ->addActionLabel('Añadir producto'),

        ]);
    }
}
