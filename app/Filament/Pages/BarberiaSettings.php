<?php

namespace App\Filament\Pages;

use App\Models\SiteSetting;
use Filament\Actions\Action;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\EmbeddedSchema;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Schema;

class BarberiaSettings extends Page
{
    protected string $view = 'filament.pages.site-settings';

    public static function getNavigationIcon(): string { return 'heroicon-o-scissors'; }
    public static function getNavigationLabel(): string { return 'Textos de la página'; }
    public static function getNavigationGroup(): string { return 'Barbería'; }
    public static function getNavigationSort(): int { return 1; }

    public ?array $data = [];

    public function mount(): void
    {
        $defaults = [
            'barberia_hero_description'  => 'Cortes precisos, acabados impecables. Tu barbería de confianza en Getafe y Madrid.',
            'barberia_intro_heading'     => 'Cortes precisos. Degradados técnicos. Barba trabajada al detalle.',
            'barberia_intro_description' => 'Tu barbería de referencia en Getafe y sur de Madrid. Peluquería masculina premium donde cada visita es una experiencia.',
        ];

        $saved = SiteSetting::whereIn('key', array_keys($defaults))->pluck('value', 'key')->toArray();
        $this->form->fill(array_merge($defaults, $saved));
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->components([
                Section::make('Hero (portada)')
                    ->description('Texto que aparece debajo del título grande "BARBERÍA" en la imagen de portada.')
                    ->schema([
                        Textarea::make('barberia_hero_description')
                            ->label('Descripción del hero')
                            ->rows(2)
                            ->required(),
                    ]),

                Section::make('Sección introductoria')
                    ->description('Bloque de texto que aparece justo debajo del hero.')
                    ->schema([
                        TextInput::make('barberia_intro_heading')
                            ->label('Título destacado')
                            ->required(),

                        Textarea::make('barberia_intro_description')
                            ->label('Párrafo descriptivo')
                            ->rows(3),
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
            Action::make('save')->label('Guardar cambios')->submit('save'),
        ];
    }

    public function save(): void
    {
        $data = $this->form->getState();
        SiteSetting::setMany($data);
        Notification::make()->title('Página de Barbería actualizada')->success()->send();
    }

    public function getTitle(): string { return 'Página Barbería'; }
}
