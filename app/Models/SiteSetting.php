<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = ['key', 'value'];

    protected static ?array $cache = null;

    public static function get(string $key, ?string $default = null): ?string
    {
        if (static::$cache === null) {
            static::$cache = cache()->remember('site_settings_all', 3600,
                fn () => static::pluck('value', 'key')->toArray()
            );
        }
        return static::$cache[$key] ?? $default;
    }

    public static function branches(): array
    {
        $branches = [
            [
                'name'   => static::get('branch1_name', 'Ingenioso Hidalgo'),
                'addr1'  => static::get('contact_address_line1', 'Av. del Ingenioso Hidalgo, 3'),
                'addr2'  => static::get('contact_address_line2', '28906 Getafe, Madrid'),
                'map'    => static::get('contact_map_embed_url'),
                'booksy' => static::get('booksy_url', 'https://booksy.com/es-es/105117_leyenda-barberia_barberia_52975_getafe'),
            ],
            [
                'name'   => static::get('branch2_name', 'Juan Carlos I'),
                'addr1'  => static::get('contact2_address_line1', 'Av. Juan Carlos I, 16'),
                'addr2'  => static::get('contact2_address_line2', '28905 Getafe, Madrid'),
                'map'    => static::get('contact2_map_embed_url'),
                'booksy' => static::get('booksy_url_2', 'https://booksy.com/es-es/197760_leyenda-barberia_barberia_52975_getafe'),
            ],
        ];

        // Contacto por sucursal (sucursal 2 vacía = igual que sucursal 1)
        $phone  = static::get('contact_phone', '+34 600 000 000');
        $wa     = static::get('contact_whatsapp', '34600000000');
        $waTat  = static::get('contact_whatsapp_tattoo') ?: $wa;

        $branches[0] += ['phone' => $phone, 'whatsapp' => $wa, 'whatsapp_tattoo' => $waTat];
        $branches[1] += [
            'phone'           => static::get('contact2_phone') ?: $phone,
            'whatsapp'        => static::get('contact2_whatsapp') ?: $wa,
            'whatsapp_tattoo' => static::get('contact2_whatsapp_tattoo') ?: $waTat,
        ];

        foreach ($branches as &$b) {
            $b['whatsapp']        = preg_replace('/\D/', '', $b['whatsapp']);
            $b['whatsapp_tattoo'] = preg_replace('/\D/', '', $b['whatsapp_tattoo']);
            $b['label']           = $b['name'] . ' - ' . $b['addr1'];
            $query = urlencode($b['addr1'] . ', ' . $b['addr2']);
            // Si pegaron el iframe entero, quedarse solo con la URL
            $b['map'] = $b['map'] ? strtok($b['map'], '"') : 'https://maps.google.com/maps?q=' . $query . '&output=embed';
            $b['directions'] = 'https://www.google.com/maps/dir/?api=1&destination=' . $query;
        }

        return $branches;
    }

    public static function set(string $key, ?string $value): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value]);
        static::$cache = null;
        cache()->forget('site_settings_all');
    }

    public static function setMany(array $data): void
    {
        foreach ($data as $key => $value) {
            static::updateOrCreate(['key' => $key], ['value' => $value]);
        }
        static::$cache = null;
        cache()->forget('site_settings_all');
    }
}
