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

class HomeSettings extends Page
{
    protected string $view = 'filament.pages.site-settings';

    public static function getNavigationIcon(): string
    {
        return 'heroicon-o-cog-6-tooth';
    }

    public static function getNavigationLabel(): string
    {
        return 'Ajustes Generales';
    }

    public static function getNavigationGroup(): string
    {
        return 'Ajustes';
    }

    public static function getNavigationSort(): int
    {
        return 10;
    }

    public ?array $data = [];

    public function mount(): void
    {
        $defaults = [
            'home_brand_title'        => 'MÁS QUE UNA BARBERÍA',
            'home_brand_description'  => 'Leyenda nació con un propósito claro: crear un espacio donde el arte del corte y el tatuaje conviven bajo el mismo techo.',
            'home_brand_description2' => 'Nuestro equipo de barberos y tatuadores comparte la misma filosofía: precisión sin compromisos, atención al detalle y un estándar de excelencia que define cada trabajo.',
            'home_stats_clients'      => '+500',
            'home_stats_artists'      => '4',
            'home_stats_experience'   => '+10',
            'home_hero_image'         => null,
            'barberia_hero_image'     => null,
            'tatuajes_hero_image'     => null,
            'tienda_hero_image'       => null,
            'home_brand_photo1'       => null,
        ];

        $saved = SiteSetting::whereIn('key', array_keys($defaults))->pluck('value', 'key')->toArray();
        $this->form->fill(array_merge($defaults, $saved));
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->components([
                Section::make('Imágenes de portada')
                    ->description('Fotos de fondo para los heroes de cada página. Si no subes imagen se usará la foto predeterminada.')
                    ->columns(4)
                    ->schema([
                        FileUpload::make('home_hero_image')
                            ->label('Hero Home')
                            ->image()
                            ->disk('public')
                            ->visibility('public')
                            ->directory('settings')
                            ->nullable(),
                        FileUpload::make('barberia_hero_image')
                            ->label('Hero Barbería')
                            ->image()
                            ->disk('public')
                            ->visibility('public')
                            ->directory('settings')
                            ->nullable(),
                        FileUpload::make('tatuajes_hero_image')
                            ->label('Hero Tatuajes')
                            ->image()
                            ->disk('public')
                            ->visibility('public')
                            ->directory('settings')
                            ->nullable(),
                        FileUpload::make('tienda_hero_image')
                            ->label('Hero Tienda')
                            ->image()
                            ->disk('public')
                            ->visibility('public')
                            ->directory('settings')
                            ->nullable(),
                    ]),

                Section::make('Sección "Más que una barbería"')
                    ->schema([
                        TextInput::make('home_brand_title')
                            ->label('Título')
                            ->required(),
                        Textarea::make('home_brand_description')
                            ->label('Párrafo 1')
                            ->rows(3),
                        Textarea::make('home_brand_description2')
                            ->label('Párrafo 2')
                            ->rows(3),
                    ]),

                Section::make('Foto de la sección "Más que una barbería"')
                    ->description('La foto que aparece a la derecha del texto. Si no subes ninguna, se usa automáticamente la foto del primer servicio.')
                    ->schema([
                        FileUpload::make('home_brand_photo1')
                            ->label('Foto (barbería / estudio)')
                            ->image()
                            ->disk('public')
                            ->visibility('public')
                            ->directory('settings')
                            ->nullable(),
                    ]),

                Section::make('Estadísticas')
                    ->columns(3)
                    ->schema([
                        TextInput::make('home_stats_clients')
                            ->label('Clientes (ej: +500)'),
                        TextInput::make('home_stats_artists')
                            ->label('Artistas (ej: 4)'),
                        TextInput::make('home_stats_experience')
                            ->label('Años exp. (ej: +10)'),
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
        Notification::make()->title('Configuración guardada correctamente')->success()->send();
    }

    public function getTitle(): string
    {
        return 'Ajustes de la Home';
    }
}
