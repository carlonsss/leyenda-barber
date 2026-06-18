<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\TattooStyle;
use App\Models\TattooWork;
use App\Models\TattooRequest;
use Illuminate\Http\Request;

class TatuajesController extends Controller
{
    public function index()
    {
        $styles = TattooStyle::withCount('works')->get();
        $works  = TattooWork::with('style')->latest()->take(60)->get();
        $faqs   = Faq::forSection('tatuajes');

        return view('tatuajes.index', compact('styles', 'works', 'faqs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'             => 'required|string|max:255',
            'email'            => 'required|email|max:255',
            'phone'            => 'required|string|max:50',
            'tattoo_style_id'  => 'required|exists:tattoo_styles,id',
            'body_area'        => 'required|string|max:255',
            'budget'           => 'nullable|numeric|min:0',
            'idea'             => 'nullable|string|max:1000',
        ]);

        $req = new TattooRequest();
        $req->name            = $request->name;
        $req->email           = $request->email;
        $req->phone           = $request->phone;
        $req->tattoo_style_id = $request->tattoo_style_id;
        $req->body_area       = $request->body_area;
        $req->budget          = $request->budget;
        $req->idea            = $request->idea;
        $req->status          = 'pending';
        $req->save();

        return back()->with('success', '¡Solicitud enviada! Te contactaremos en menos de 48h.');
    }
}
