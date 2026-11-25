<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tattoo_artists', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('style')->nullable();
            $table->text('bio')->nullable();
            $table->string('image')->nullable();
            $table->unsignedTinyInteger('branch')->nullable(); // null = ambas sucursales
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        // Pasar el tatuador actual (guardado en ajustes) a la tabla, como tatuador de la sucursal 1
        $s = DB::table('site_settings')->whereIn('key', ['tattoo_artist_name', 'tattoo_artist_style', 'tattoo_artist_bio', 'tattoo_artist_image'])
            ->pluck('value', 'key');

        if (! empty($s['tattoo_artist_name'])) {
            DB::table('tattoo_artists')->insert([
                'name'       => $s['tattoo_artist_name'],
                'style'      => $s['tattoo_artist_style'] ?? null,
                'bio'        => $s['tattoo_artist_bio'] ?? null,
                'image'      => $s['tattoo_artist_image'] ?? null,
                'branch'     => 1,
                'active'     => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('tattoo_artists');
    }
};
