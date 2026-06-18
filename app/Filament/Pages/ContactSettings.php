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

class ContactSettings extends Page
{
    protected string $view = 'filament.pages.site-settings';

    public static function getNavigationIcon(): string
    {
        return 'heroicon-o-map-pin';
    }

    public static function getNavigationLabel(): string
    {
        return 'Ajustes Contacto';
    }

    public static function getNavigationGroup(): string
    {
        return 'Ajustes';
    }

    public static function getNavigationSort(): int
    {
        return 11;
    }

    public ?array $data = [];

    public function mount(): void
    {
        $defaults = [
            'contact_phone'              => '+34 600 000 000',
            'contact_whatsapp'           => '34600000000',
            'contact_whatsapp_tattoo'    => '34600000000',
            'contact_email'              => 'hola@leyenda.es',
            'contact_address_line1'      => 'Calle Gran Vía, 00',
            'contact_address_line2'      => '28013 Madrid, España',
            'contact_hours_weekday'      => '10:00 – 20:00',
            'contact_hours_saturday'     => '10:00 – 18:00',
            'contact_hours_sunday'       => 'Cerrado',
            'contact_map_embed_url'      => null,
        ];

        $saved = SiteSetting::whereIn('key', array_keys($defaults))->pluck('value', 'key')->toArray();
        $this->form->fill(array_merge($defaults, $saved));
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->components([
                Section::make('Datos de contacto')
                    ->columns(2)
                    ->schema([
                        TextInput::make('contact_phone')
                            ->label('Teléfono')
                            ->tel(),
                        TextInput::make('contact_email')
                            ->label('Email')
                            ->email(),
                        TextInput::make('contact_whatsapp')
                            ->label('WhatsApp principal (barbería / ropa)')
                            ->hint('Solo dígitos con prefijo país, ej: 34600000000'),
                        TextInput::make('contact_whatsapp_tattoo')
                            ->label('WhatsApp tatuadores')
                            ->hint('Solo dígitos con prefijo país, ej: 34600000000'),
                    ]),

                Section::make('Dirección')
                    ->columns(2)
                    ->schema([
                        TextInput::make('contact_address_line1')
                            ->label('Dirección (línea 1)'),
                        TextInput::make('contact_address_line2')
                            ->label('Ciudad y CP (línea 2)'),
                        TextInput::make('contact_map_embed_url')
                            ->label('URL embed Google Maps (opcional)')
                            ->helperText('Si el mapa no muestra bien tu dirección, ve a Google Maps → Compartir → Insertar mapa → copia solo la URL del src del iframe y pégala aquí.')
                            ->placeholder('https://www.google.com/maps/embed?pb=...')
                            ->columnSpanFull()
                            ->nullable(),
                    ]),

                Section::make('Horario')
                    ->columns(3)
                    ->schema([
                        TextInput::make('contact_hours_weekday')
                            ->label('Lunes – Viernes'),
                        TextInput::make('contact_hours_saturday')
                            ->label('Sábado'),
                        TextInput::make('contact_hours_sunday')
                            ->label('Domingo'),
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
        Notification::make()->title('Datos de contacto guardados')->success()->send();
    }

    public function getTitle(): string
    {
        return 'Ajustes de Contacto';
    }
}
