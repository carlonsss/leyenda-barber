<?php

use App\Models\Product;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Product::all()->each(function ($product) {
            $opts = $product->size_options;
            if (is_array($opts) && !empty($opts) && array_is_list($opts)) {
                $product->size_options = array_fill_keys($opts, 0);
                $product->saveQuietly();
            }
        });
    }

    public function down(): void
    {
        Product::all()->each(function ($product) {
            $opts = $product->size_options;
            if (is_array($opts) && !empty($opts) && !array_is_list($opts)) {
                $product->size_options = array_keys($opts);
                $product->saveQuietly();
            }
        });
    }
};
