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

class TatuajesSettings extends Page
{
    protected string $view = 'filament.pages.site-settings';

    public static function getNavigationIcon(): string { return 'heroicon-o-pencil-square'; }
    public static function getNavigationLabel(): string { return 'Textos de la página'; }
    public static function getNavigationGroup(): string { return 'Tatuajes'; }
    public static function getNavigationSort(): int { return 1; }

    public ?array $data = [];

    public function mount(): void
    {
        $defaults = [
            'tatuajes_hero_description'  => 'Arte permanente. Diseño personalizado. Tu tatuaje, creado con precisión en nuestro estudio de Getafe.',
            'tatuajes_intro_heading'     => 'Cada tatuaje es una obra única, diseñada y ejecutada con precisión en nuestro estudio.',
            'tatuajes_intro_description' => 'Trabajamos codo a codo contigo desde el primer boceto hasta el resultado final. Sin prisas, sin compromisos.',
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
                    ->description('Texto que aparece debajo del título "TATUAJES" en la imagen de portada.')
                    ->schema([
                        Textarea::make('tatuajes_hero_description')
                            ->label('Descripción del hero')
                            ->rows(2)
                            ->required(),
                    ]),

                Section::make('Sección introductoria')
                    ->description('Bloque de texto debajo del hero.')
                    ->schema([
                        TextInput::make('tatuajes_intro_heading')
                            ->label('Título destacado'),

                        Textarea::make('tatuajes_intro_description')
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
        Notification::make()->title('Página de Tatuajes actualizada')->success()->send();
    }

    public function getTitle(): string { return 'Página Tatuajes'; }
}
