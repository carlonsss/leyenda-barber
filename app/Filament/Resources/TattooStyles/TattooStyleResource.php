<?php

namespace App\Filament\Resources\TattooStyles;

use App\Filament\Resources\TattooStyles\Pages\CreateTattooStyle;
use App\Filament\Resources\TattooStyles\Pages\EditTattooStyle;
use App\Filament\Resources\TattooStyles\Pages\ListTattooStyles;
use App\Filament\Resources\TattooStyles\Schemas\TattooStyleForm;
use App\Filament\Resources\TattooStyles\Tables\TattooStylesTable;
use App\Models\TattooStyle;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TattooStyleResource extends Resource
{
    protected static ?string $model = TattooStyle::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedTag;

    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $modelLabel         = 'Estilo';
    protected static ?string $pluralModelLabel   = 'Estilos';

    public static function getNavigationLabel(): string { return 'Estilos'; }
    public static function getNavigationGroup(): string { return 'Tatuajes'; }
    public static function getNavigationSort(): int { return 2; }

    public static function form(Schema $schema): Schema
    {
        return TattooStyleForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TattooStylesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTattooStyles::route('/'),
            'create' => CreateTattooStyle::route('/create'),
            'edit' => EditTattooStyle::route('/{record}/edit'),
        ];
    }
}
