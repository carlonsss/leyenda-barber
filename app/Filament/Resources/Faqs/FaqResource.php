<?php

namespace App\Filament\Resources\Faqs;

use App\Filament\Resources\Faqs\Pages\CreateFaq;
use App\Filament\Resources\Faqs\Pages\EditFaq;
use App\Filament\Resources\Faqs\Pages\ListFaqs;
use App\Models\Faq;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class FaqResource extends Resource
{
    protected static ?string $model = Faq::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedQuestionMarkCircle;

    protected static ?string $modelLabel           = 'Pregunta frecuente';
    protected static ?string $pluralModelLabel     = 'Preguntas frecuentes';
    protected static ?string $recordTitleAttribute = 'question';

    public static function getNavigationLabel(): string { return 'FAQs'; }
    public static function getNavigationGroup(): string { return 'Contenido'; }
    public static function getNavigationSort(): int     { return 1; }

    public static function form(Schema $schema): Schema
    {
        return \App\Filament\Resources\Faqs\Schemas\FaqForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return \App\Filament\Resources\Faqs\Tables\FaqsTable::configure($table);
    }

    public static function getRelations(): array { return []; }

    public static function getPages(): array
    {
        return [
            'index'  => ListFaqs::route('/'),
            'create' => CreateFaq::route('/create'),
            'edit'   => EditFaq::route('/{record}/edit'),
        ];
    }
}
