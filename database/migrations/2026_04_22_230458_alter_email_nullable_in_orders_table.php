<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {

            // Hacemos el email opcional para evitar errores SQL
            $table->string('email')->nullable()->change();

        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {

            // Volver a obligatorio si se revierte la migración
            $table->string('email')->nullable(false)->change();

        });
    }
};