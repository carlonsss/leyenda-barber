<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BarberiaController;
use App\Http\Controllers\TatuajesController;
use App\Http\Controllers\TiendaController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\ContactoController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/barberia', [BarberiaController::class, 'index'])->name('barberia');

Route::get('/tatuajes', [TatuajesController::class, 'index'])->name('tatuajes');
Route::post('/tatuajes/solicitar', [TatuajesController::class, 'store'])
    ->middleware('throttle:8,1')
    ->name('tatuajes.store');

Route::get('/tienda', [TiendaController::class, 'index'])->name('tienda');
Route::get('/tienda/{product}', [TiendaController::class, 'show'])->name('tienda.show');

Route::get('/contacto', [ContactoController::class, 'index'])->name('contacto');

Route::get('/aviso-legal',  fn() => view('legal.aviso-legal'))->name('aviso-legal');
Route::get('/privacidad',   fn() => view('legal.privacidad'))->name('privacidad');
Route::get('/cookies',      fn() => view('legal.cookies'))->name('cookies');

Route::get('/sitemap.xml', function () {
    $products = \App\Models\Product::where('stock', '>', 0)->latest()->get(['id', 'updated_at']);
    $now = now()->toAtomString();
    $xml = '<?xml version="1.0" encoding="UTF-8"?>'
        . '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

    $static = [
        ['/', '1.0', 'weekly'],
        ['/barberia', '0.9', 'monthly'],
        ['/tatuajes', '0.9', 'monthly'],
        ['/tienda', '0.8', 'weekly'],
        ['/contacto', '0.7', 'monthly'],
    ];
    foreach ($static as [$path, $priority, $freq]) {
        $xml .= '<url>'
            . '<loc>' . url($path) . '</loc>'
            . '<lastmod>' . $now . '</lastmod>'
            . '<changefreq>' . $freq . '</changefreq>'
            . '<priority>' . $priority . '</priority>'
            . '</url>';
    }
    foreach ($products as $p) {
        $xml .= '<url>'
            . '<loc>' . route('tienda.show', $p->id) . '</loc>'
            . '<lastmod>' . $p->updated_at->toAtomString() . '</lastmod>'
            . '<changefreq>monthly</changefreq>'
            . '<priority>0.6</priority>'
            . '</url>';
    }
    $xml .= '</urlset>';
    return response($xml, 200, ['Content-Type' => 'application/xml']);
})->name('sitemap');

// Cart (AJAX)
Route::post('/carrito/agregar/{product}', [CarritoController::class, 'agregar'])
    ->middleware('throttle:30,1')
    ->name('carrito.agregar');
Route::post('/carrito/actualizar', [CarritoController::class, 'actualizar'])->name('carrito.actualizar');
Route::delete('/carrito/quitar', [CarritoController::class, 'quitar'])->name('carrito.quitar');
Route::post('/pedido', [CarritoController::class, 'checkout'])
    ->middleware('throttle:5,1')
    ->name('carrito.checkout');
