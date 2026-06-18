<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\SelectFilter;


class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('images')
                    ->label('')
                    ->disk('public')
                    ->stacked()
                    ->limit(1)
                    ->width(48)
                    ->height(48),
                TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('category')
                    ->label('Categoría')
                    ->badge()
                    ->color(fn (?string $state): string => match ($state) {
                        'camisetas'  => 'info',
                        'sudaderas'  => 'warning',
                        'pantalones' => 'success',
                        'accesorios' => 'gray',
                        default      => 'gray',
                    })
                    ->formatStateUsing(fn (?string $state): string => match ($state) {
                        'camisetas'  => 'Camisetas',
                        'sudaderas'  => 'Sudaderas',
                        'pantalones' => 'Pantalones',
                        'accesorios' => 'Accesorios',
                        default      => '—',
                    }),
                TextColumn::make('price')
                    ->label('Precio')
                    ->money('EUR')
                    ->sortable(),
                TextColumn::make('stock')
                    ->label('Stock')
                    ->numeric()
                    ->sortable(),
                ToggleColumn::make('is_new')
                    ->label('Nueva col.'),
                ToggleColumn::make('is_featured')
                    ->label('Más vendido'),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('category')
                    ->label('Categoría')
                    ->options([
                        'camisetas'  => 'Camisetas',
                        'sudaderas'  => 'Sudaderas',
                        'pantalones' => 'Pantalones',
                        'accesorios' => 'Accesorios',
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make()->label('Eliminar'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
