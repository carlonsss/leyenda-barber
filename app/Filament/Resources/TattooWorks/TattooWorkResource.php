<?php

namespace App\Filament\Resources\TattooWorks;

use App\Filament\Resources\TattooWorks\Pages\CreateTattooWork;
use App\Filament\Resources\TattooWorks\Pages\EditTattooWork;
use App\Filament\Resources\TattooWorks\Pages\ListTattooWorks;
use App\Filament\Resources\TattooWorks\Schemas\TattooWorkForm;
use App\Filament\Resources\TattooWorks\Tables\TattooWorksTable;
use App\Models\TattooWork;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class TattooWorkResource extends Resource
{
    protected static ?string $model = TattooWork::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPaintBrush;

    protected static ?string $recordTitleAttribute = 'title';
    protected static ?string $modelLabel         = 'Trabajo';
    protected static ?string $pluralModelLabel   = 'Trabajos (portfolio)';

    public static function getNavigationLabel(): string { return 'Trabajos'; }
    public static function getNavigationGroup(): string { return 'Tatuajes'; }
    public static function getNavigationSort(): int { return 1; }

    public static function form(Schema $schema): Schema
    {
        return TattooWorkForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TattooWorksTable::configure($table);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with('style');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTattooWorks::route('/'),
            'create' => CreateTattooWork::route('/create'),
            'edit' => EditTattooWork::route('/{record}/edit'),
        ];
    }
}
