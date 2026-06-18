<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Product;

class TiendaController extends Controller
{
    public function index()
    {
        $products    = Product::where('stock', '>', 0)->latest()->get();
        $bestSellers = $products->where('is_featured', true)->values();
        $newDrop     = $products->where('is_new', true)->values();

        $byCategory = [
            'camisetas'  => $products->where('category', 'camisetas')->values(),
            'sudaderas'  => $products->where('category', 'sudaderas')->values(),
            'pantalones' => $products->where('category', 'pantalones')->values(),
            'accesorios' => $products->where('category', 'accesorios')->values(),
        ];

        $faqs = Faq::forSection('tienda');

        return view('tienda.index', compact('products', 'bestSellers', 'newDrop', 'byCategory', 'faqs'));
    }

    public function show(Product $product)
    {
        $related = Product::where('id', '!=', $product->id)
            ->where('stock', '>', 0)
            ->when($product->category, fn ($q) => $q->where('category', $product->category))
            ->take(4)
            ->get();

        if ($related->count() < 4) {
            $existing = $related->pluck('id')->push($product->id);
            $extra = Product::where('stock', '>', 0)
                ->whereNotIn('id', $existing)
                ->take(4 - $related->count())
                ->get();
            $related = $related->concat($extra);
        }

        return view('tienda.show', compact('product', 'related'));
    }
}
