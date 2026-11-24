<?php

namespace App\Filament\Pages;

use App\Models\SiteSetting;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\EmbeddedSchema;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Schema;

class TattooArtistSettings extends Page
{
    protected string $view = 'filament.pages.site-settings';

    public static function getNavigationIcon(): string
    {
        return 'heroicon-o-user-circle';
    }

    public static function getNavigationLabel(): string
    {
        return 'Tatuadores';
    }

    public static function getNavigationGroup(): string
    {
        return 'Tatuajes';
    }

    public static function getNavigationSort(): int
    {
        return 4;
    }

    public ?array $data = [];

    public function mount(): void
    {
        $keys = ['tattoo_artist_name', 'tattoo_artist_bio', 'tattoo_artist_style', 'tattoo_artist_image',
                 'tattoo2_artist_name', 'tattoo2_artist_bio', 'tattoo2_artist_style', 'tattoo2_artist_image'];
        $saved = SiteSetting::whereIn('key', $keys)->pluck('value', 'key')->toArray();

        $defaults = [
            'tattoo_artist_name'  => 'Artista Leyenda',
            'tattoo_artist_bio'   => 'Tatuador especializado en realismo y diseño personalizado. Cada pieza es única, trabajada con precisión y dedicación.',
            'tattoo_artist_style' => 'Realismo · Blackwork · Fine Line',
            'tattoo_artist_image' => null,
        ];

        $this->form->fill(array_merge($defaults, $saved));
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->components([
                Section::make('Tatuador — Sucursal 1')
                    ->description('Información que aparece en la sección "Nuestros Artistas" de la página de Tatuajes.')
                    ->schema([
                        TextInput::make('tattoo_artist_name')
                            ->label('Nombre del artista')
                            ->required(),

                        TextInput::make('tattoo_artist_style')
                            ->label('Especialidades (ej: Realismo · Blackwork · Fine Line)')
                            ->nullable(),

                        Textarea::make('tattoo_artist_bio')
                            ->label('Biografía / descripción')
                            ->rows(4)
                            ->columnSpanFull(),

                        FileUpload::make('tattoo_artist_image')
                            ->label('Foto del artista')
                            ->image()
                            ->disk('public')
                            ->visibility('public')
                            ->directory('artists')
                            ->nullable()
                            ->columnSpanFull(),
                    ]),

                Section::make('Tatuador — Sucursal 2')
                    ->description('Los campos vacíos usan los datos del tatuador de la Sucursal 1.')
                    ->schema([
                        TextInput::make('tattoo2_artist_name')
                            ->label('Nombre del artista')
                            ->placeholder('Igual que Sucursal 1'),

                        TextInput::make('tattoo2_artist_style')
                            ->label('Especialidades (ej: Realismo · Blackwork · Fine Line)')
                            ->placeholder('Igual que Sucursal 1'),

                        Textarea::make('tattoo2_artist_bio')
                            ->label('Biografía / descripción')
                            ->rows(4)
                            ->placeholder('Igual que Sucursal 1')
                            ->columnSpanFull(),

                        FileUpload::make('tattoo2_artist_image')
                            ->label('Foto del artista')
                            ->image()
                            ->disk('public')
                            ->visibility('public')
                            ->directory('artists')
                            ->nullable()
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public function content(Schema $schema): Schema
    {
        return $schema->components([
            Form::make([EmbeddedSchema::make('form')])
                ->id('form')
                ->livewireSubmitHandler('save')
                ->footer([
                    Actions::make($this->getFormActions())->key('form-actions'),
                ]),
        ]);
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Guardar cambios')
                ->submit('save'),
        ];
    }

    public function save(): void
    {
        $data = $this->form->getState();
        SiteSetting::setMany($data);
        Notification::make()->title('Artista actualizado correctamente')->success()->send();
    }

    public function getTitle(): string
    {
        return 'Artista de Tatuajes';
    }
}
