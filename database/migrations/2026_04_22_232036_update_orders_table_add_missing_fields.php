<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {

            $table->string('customer_phone')->nullable();
            $table->string('customer_email')->nullable();
            $table->text('address')->nullable();
            $table->decimal('total_price', 10, 2)->default(0);

        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {

            $table->dropColumn([
                'customer_phone',
                'customer_email',
                'address',
                'total_price',
            ]);

        });
    }
};