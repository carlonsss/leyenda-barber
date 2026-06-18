<?php

namespace App\Filament\Resources\Faqs\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class FaqsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('section')
                    ->label('Sección')
                    ->badge()
                    ->formatStateUsing(fn (string $state) => match ($state) {
                        'barberia' => 'Barbería',
                        'tatuajes' => 'Tatuajes',
                        'tienda'   => 'Tienda',
                        default    => $state,
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'barberia' => 'warning',
                        'tatuajes' => 'info',
                        'tienda'   => 'success',
                        default    => 'gray',
                    }),

                TextColumn::make('question')
                    ->label('Pregunta')
                    ->limit(60)
                    ->searchable(),

                TextColumn::make('sort_order')
                    ->label('Orden')
                    ->sortable(),

                ToggleColumn::make('active')
                    ->label('Visible'),
            ])
            ->defaultSort('section')
            ->filters([
                SelectFilter::make('section')
                    ->label('Filtrar por sección')
                    ->options([
                        'barberia' => 'Barbería',
                        'tatuajes' => 'Tatuajes',
                        'tienda'   => 'Tienda',
                    ]),
            ])
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
