<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tattoo_styles', function (Blueprint $table) {
            $table->string('image')->nullable()->after('description');
        });

        Schema::table('tattoo_works', function (Blueprint $table) {
            $table->text('description')->nullable()->after('image');
        });

        Schema::table('tattoo_requests', function (Blueprint $table) {
            $table->renameColumn('body_part', 'body_area');
        });
    }

    public function down(): void
    {
        Schema::table('tattoo_styles', function (Blueprint $table) {
            $table->dropColumn('image');
        });

        Schema::table('tattoo_works', function (Blueprint $table) {
            $table->dropColumn('description');
        });

        Schema::table('tattoo_requests', function (Blueprint $table) {
            $table->renameColumn('body_area', 'body_part');
        });
    }
};
