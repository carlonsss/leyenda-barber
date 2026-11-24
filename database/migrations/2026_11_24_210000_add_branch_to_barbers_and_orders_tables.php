<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // null = trabaja en ambas sucursales
        Schema::table('barbers', function (Blueprint $table) {
            $table->unsignedTinyInteger('branch')->nullable()->after('role');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->string('pickup_branch')->nullable()->after('customer_email');
        });
    }

    public function down(): void
    {
        Schema::table('barbers', function (Blueprint $table) {
            $table->dropColumn('branch');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('pickup_branch');
        });
    }
};
