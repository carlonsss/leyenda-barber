<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tattoo_requests', function (Blueprint $table) {
            $table->foreignId('tattoo_style_id')->nullable()->constrained('tattoo_styles')->nullOnDelete()->after('body_part');
            $table->decimal('budget', 8, 2)->nullable()->after('tattoo_style_id');
            $table->string('status')->default('pending')->after('budget');
        });
    }

    public function down(): void
    {
        Schema::table('tattoo_requests', function (Blueprint $table) {
            $table->dropForeign(['tattoo_style_id']);
            $table->dropColumn(['tattoo_style_id', 'budget', 'status']);
        });
    }
};
