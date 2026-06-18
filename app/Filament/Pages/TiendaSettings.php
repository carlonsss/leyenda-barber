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

class TiendaSettings extends Page
{
    protected string $view = 'filament.pages.site-settings';

    public static function getNavigationIcon(): string { return 'heroicon-o-shopping-bag'; }
    public static function getNavigationLabel(): string { return 'Textos de la página'; }
    public static function getNavigationGroup(): string { return 'Tienda'; }
    public static function getNavigationSort(): int { return 1; }

    public ?array $data = [];

    public function mount(): void
    {
        $defaults = [
            'tienda_hero_description'  => 'Ropa y accesorios con identidad propia. Piezas para los que viven el estilo.',
            'tienda_recogida_badge'    => 'Recogida en tienda. No enviamos a domicilio.',
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
                    ->description('Texto que aparece debajo del título "LA TIENDA" en la imagen de portada.')
                    ->schema([
                        Textarea::make('tienda_hero_description')
                            ->label('Descripción del hero')
                            ->rows(2)
                            ->required(),

                        TextInput::make('tienda_recogida_badge')
                            ->label('Aviso de recogida en tienda')
                            ->hint('Aparece en el badge junto al botón de Instagram'),
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
        Notification::make()->title('Página de Tienda actualizada')->success()->send();
    }

    public function getTitle(): string { return 'Página Tienda'; }
}
