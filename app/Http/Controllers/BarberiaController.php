<?php

namespace App\Http\Controllers;

use App\Models\Barber;
use App\Models\BarberGallery;
use App\Models\Faq;
use App\Models\Service;

class BarberiaController extends Controller
{
    public function index()
    {
        $barbers  = Barber::where('active', true)->with('gallery')->get();
        $services = Service::all();
        $gallery  = BarberGallery::with('barber')->latest()->take(24)->get();
        $faqs     = Faq::forSection('barberia');

        return view('barberia.index', compact('barbers', 'services', 'gallery', 'faqs'));
    }
}
