<?php

namespace App\Filament\Resources\TattooArtists;

use App\Filament\Resources\TattooArtists\Pages\CreateTattooArtist;
use App\Filament\Resources\TattooArtists\Pages\EditTattooArtist;
use App\Filament\Resources\TattooArtists\Pages\ListTattooArtists;
use App\Filament\Resources\TattooArtists\Schemas\TattooArtistForm;
use App\Filament\Resources\TattooArtists\Tables\TattooArtistsTable;
use App\Models\TattooArtist;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TattooArtistResource extends Resource
{
    protected static ?string $model = TattooArtist::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserCircle;

    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $modelLabel         = 'Tatuador';
    protected static ?string $pluralModelLabel   = 'Tatuadores';

    public static function getNavigationLabel(): string { return 'Tatuadores'; }
    public static function getNavigationGroup(): string { return 'Tatuajes'; }
    public static function getNavigationSort(): int { return 4; }

    public static function form(Schema $schema): Schema
    {
        return TattooArtistForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TattooArtistsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListTattooArtists::route('/'),
            'create' => CreateTattooArtist::route('/create'),
            'edit'   => EditTattooArtist::route('/{record}/edit'),
        ];
    }
}
