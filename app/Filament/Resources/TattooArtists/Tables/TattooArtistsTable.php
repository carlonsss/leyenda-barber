<?php

namespace App\Filament\Resources\TattooArtists\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TattooArtistsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Foto')
                    ->disk('public')
                    ->circular(),
                TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('style')
                    ->label('Especialidades')
                    ->default('—'),
                TextColumn::make('branch')
                    ->label('Sucursal')
                    ->badge()
                    ->color('gray')
                    ->formatStateUsing(fn ($state) => is_numeric($state) ? (\App\Models\SiteSetting::branches()[$state - 1]['name'] ?? 'Ambas') : 'Ambas')
                    ->default('Ambas'),
                IconColumn::make('active')
                    ->label('Activo')
                    ->boolean(),
            ])
            ->defaultSort('name')
            ->recordActions([
                EditAction::make()->label('Editar'),
                DeleteAction::make()->label('Eliminar'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->label('Eliminar seleccionados'),
                ]),
            ]);
    }
}
