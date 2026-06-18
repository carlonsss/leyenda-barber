<?php

namespace App\Filament\Resources\TattooRequests;

use App\Filament\Resources\TattooRequests\Pages\CreateTattooRequest;
use App\Filament\Resources\TattooRequests\Pages\EditTattooRequest;
use App\Filament\Resources\TattooRequests\Pages\ListTattooRequests;
use App\Filament\Resources\TattooRequests\Schemas\TattooRequestForm;
use App\Filament\Resources\TattooRequests\Tables\TattooRequestsTable;
use App\Models\TattooRequest;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TattooRequestResource extends Resource
{
    protected static ?string $model = TattooRequest::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedEnvelope;

    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $modelLabel         = 'Solicitud de tatuaje';
    protected static ?string $pluralModelLabel   = 'Solicitudes';

    public static function getNavigationLabel(): string { return 'Solicitudes'; }
    public static function getNavigationGroup(): string { return 'Tatuajes'; }
    public static function getNavigationSort(): int { return 3; }

    public static function form(Schema $schema): Schema
    {
        return TattooRequestForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TattooRequestsTable::configure($table);
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
            'index' => ListTattooRequests::route('/'),
            'create' => CreateTattooRequest::route('/create'),
            'edit' => EditTattooRequest::route('/{record}/edit'),
        ];
    }
}
