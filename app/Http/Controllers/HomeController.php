<?php

namespace App\Http\Controllers;

use App\Models\Barber;
use App\Models\Service;
use App\Models\TattooWork;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $barbers  = Barber::with('gallery')->where('active', true)->take(3)->get();
        $services = Service::take(4)->get();
        $works    = TattooWork::with('style')->latest()->take(8)->get();
        $products = Product::where('stock', '>', 0)->latest()->take(6)->get();

        return view('home.index', compact('barbers', 'services', 'works', 'products'));
    }
}
