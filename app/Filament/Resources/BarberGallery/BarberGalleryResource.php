<?php

namespace App\Filament\Resources\BarberGallery;

use App\Filament\Resources\BarberGallery\Pages\CreateBarberGallery;
use App\Filament\Resources\BarberGallery\Pages\EditBarberGallery;
use App\Filament\Resources\BarberGallery\Pages\ListBarberGalleries;
use App\Filament\Resources\BarberGallery\Schemas\BarberGalleryForm;
use App\Filament\Resources\BarberGallery\Tables\BarberGalleryTable;
use App\Models\BarberGallery;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class BarberGalleryResource extends Resource
{
    protected static ?string $model = BarberGallery::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPhoto;

    protected static ?string $recordTitleAttribute = 'title';
    protected static ?string $modelLabel         = 'Foto de galería';
    protected static ?string $pluralModelLabel   = 'Galería Barbería';

    public static function getNavigationLabel(): string { return 'Galería Barbería'; }
    public static function getNavigationGroup(): string { return 'Barbería'; }
    public static function getNavigationSort(): int { return 3; }

    public static function form(Schema $schema): Schema
    {
        return BarberGalleryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BarberGalleryTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBarberGalleries::route('/'),
            'create' => CreateBarberGallery::route('/create'),
            'edit' => EditBarberGallery::route('/{record}/edit'),
        ];
    }
}
