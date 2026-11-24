<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- ══ Google Consent Mode v2 — debe ir ANTES del script de GA4 ══ --}}
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('consent', 'default', {
            'analytics_storage':   'denied',
            'ad_storage':          'denied',
            'ad_user_data':        'denied',
            'ad_personalization':  'denied',
            'wait_for_update':     500
        });
        // Restaurar consentimiento previo sin esperar a Alpine
        (function(){
            var c = localStorage.getItem('leyenda_cookies');
            if (c === 'accepted') {
                gtag('consent', 'update', {
                    'analytics_storage':  'granted',
                    'ad_storage':         'denied',
                    'ad_user_data':       'denied',
                    'ad_personalization': 'denied'
                });
            }
        })();
    </script>
    {{-- ══ Google Analytics 4 — reemplaza G-544EE7BMLL por tu ID real ══ --}}
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-544EE7BMLL"></script>
    <script>
        gtag('js', new Date());
        gtag('config', 'G-544EE7BMLL', { 'send_page_view': true });
    </script>

    <title>@yield('title', 'Leyenda Barber & Tattoo — Barbería y Tatuajes en Madrid y Getafe')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}">
    <meta name="description" content="@yield('meta_description', 'Barbería premium y estudio de tatuajes en Madrid y Getafe. Cortes, degradados, realismo, blackwork y fine line. Reserva tu cita en Booksy.')">
    <meta name="keywords" content="barbería Getafe, barbería Madrid, tatuajes Getafe, estudio tatuajes Getafe, corte de pelo Getafe, degradado Madrid, barba, realismo, blackwork, fine line, ropa urbana Getafe, Leyenda Barber Tattoo">
    <meta name="geo.region" content="ES-MD">
    <meta name="geo.placename" content="Getafe, Madrid">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Open Graph --}}
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'Leyenda Barber & Tattoo — Madrid y Getafe')">
    <meta property="og:description" content="@yield('meta_description', 'Barbería premium y estudio de tatuajes en Madrid y Getafe.')">
    <meta property="og:locale" content="es_ES">
    <meta property="og:site_name" content="Leyenda Barber & Tattoo">
    <meta property="og:image" content="@yield('og_image', asset('/images/hero-bg.jpg'))">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">

    {{-- Twitter / X --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', 'Leyenda Barber & Tattoo — Madrid y Getafe')">
    <meta name="twitter:description" content="@yield('meta_description', 'Barbería premium y estudio de tatuajes en Madrid y Getafe.')">
    <meta name="twitter:image" content="@yield('og_image', asset('/images/hero-bg.jpg'))">

    {{-- JSON-LD: LocalBusiness --}}
    @php
        $ldPhone = \App\Models\SiteSetting::get('contact_phone', '+34 600 000 000');
        $ldAddr1 = \App\Models\SiteSetting::get('contact_address_line1', 'Getafe, Madrid');
        $ldAddr2 = \App\Models\SiteSetting::get('contact_address_line2', '28901 Getafe, España');
        $ldB2    = \App\Models\SiteSetting::branches()[1];
    @endphp
    <script type="application/ld+json">{!! json_encode([
      '@context' => 'https://schema.org',
      '@type'    => ['HairSalon', 'TattooParlor'],
      'name'     => 'Leyenda Barber & Tattoo',
      'description' => 'Barbería premium y estudio de tatuajes en Getafe y Madrid. Cortes, degradados, realismo, blackwork, fine line y ropa streetwear propia.',
      'url'      => url('/'),
      'logo'     => asset('/images/logo.png'),
      'image'    => asset('/images/hero-bg.jpg'),
      'telephone' => $ldPhone,
      'address'  => [
        '@type'           => 'PostalAddress',
        'streetAddress'   => $ldAddr1,
        'addressLocality' => 'Getafe',
        'addressRegion'   => 'Madrid',
        'addressCountry'  => 'ES',
        'postalCode'      => '28906',
      ],
      'geo' => ['@type' => 'GeoCoordinates', 'latitude' => 40.3044, 'longitude' => -3.7318],
      'openingHoursSpecification' => [
        ['@type' => 'OpeningHoursSpecification', 'dayOfWeek' => ['Monday','Tuesday','Wednesday','Thursday','Friday'], 'opens' => '10:00', 'closes' => '20:00'],
        ['@type' => 'OpeningHoursSpecification', 'dayOfWeek' => 'Saturday', 'opens' => '10:00', 'closes' => '18:00'],
      ],
      'priceRange' => '€€',
      'sameAs'    => ['https://www.instagram.com/leyenda_barberia/', 'https://www.instagram.com/leyenda_tattoo06/', 'https://www.instagram.com/leyenda_clothe06/', 'https://booksy.com/es-es/105117_leyenda-barberia_barberia_52975_getafe', 'https://booksy.com/es-es/197760_leyenda-barberia_barberia_52975_getafe'],
      'department' => [
        '@type'     => 'HairSalon',
        'name'      => 'Leyenda Barber & Tattoo — ' . $ldB2['name'],
        'telephone' => $ldB2['phone'],
        'address'   => [
          '@type'           => 'PostalAddress',
          'streetAddress'   => $ldB2['addr1'],
          'addressLocality' => 'Getafe',
          'addressRegion'   => 'Madrid',
          'addressCountry'  => 'ES',
          'postalCode'      => '28905',
        ],
      ],
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>

    {{-- Google Fonts (non-blocking) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@1,600;1,700&family=Inter:wght@300;400;500;600&display=swap" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@1,600;1,700&family=Inter:wght@300;400;500;600&display=swap"></noscript>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('cart', {
                open: false,
                checkout: false,
                items: @json(array_values(session()->get('cart', []))),

                get count() { return this.items.reduce((n, i) => n + i.quantity, 0); },
                get total() { return this.items.reduce((n, i) => n + i.price * i.quantity, 0).toFixed(2); },

                async add(productId, size) {
                    this.open = true;
                    const res = await fetch(`/carrito/agregar/${productId}`, {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
                        body: JSON.stringify({ size: size || null }),
                    });
                    const data = await res.json();
                    if (data.success) { this.items = data.cart; }
                },

                async remove(key) {
                    const res = await fetch('/carrito/quitar', {
                        method: 'DELETE',
                        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
                        body: JSON.stringify({ key }),
                    });
                    const data = await res.json();
                    if (data.success) this.items = data.cart;
                },

                async update(key, quantity) {
                    const res = await fetch('/carrito/actualizar', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
                        body: JSON.stringify({ key, quantity: parseInt(quantity) }),
                    });
                    const data = await res.json();
                    if (data.success) this.items = data.cart;
                },
            });
        });
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.3/dist/cdn.min.js"></script>
    @stack('head')
</head>
<body class="bg-[#0a0a0a] text-zinc-300 font-sans antialiased" x-data>

    {{-- ════════════════════════ NAVBAR ════════════════════════ --}}
    <header
        x-data="{ mobileOpen: false, scrolled: false }"
        x-on:scroll.window="scrolled = window.scrollY > 40"
        class="fixed top-0 inset-x-0 z-50 transition-all duration-300"
        :class="scrolled ? 'bg-black/96 backdrop-blur-md border-b border-zinc-900' : 'bg-transparent'"
    >
        <div class="max-w-7xl mx-auto px-4 sm:px-6 h-24 sm:h-28 flex items-center justify-between gap-4">

            {{-- Left: hamburger (mobile) + Logo --}}
            <div class="flex items-center gap-3">
                <button x-on:click="mobileOpen = !mobileOpen" class="lg:hidden text-zinc-400 hover:text-white transition-colors p-1" aria-label="Menú">
                    <svg x-show="!mobileOpen" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    <svg x-show="mobileOpen" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
                <a href="{{ route('home') }}" class="flex-shrink-0 logo-link" aria-label="Leyenda Barber & Tattoo — Inicio">
                    <img src="/images/logo.png"
                         alt="Leyenda Barber & Tattoo"
                         class="logo-img h-20 sm:h-24 w-auto object-contain"
                         loading="eager">
                </a>
            </div>

            {{-- Desktop Nav --}}
            @php
                $route = request()->routeIs('home') ? 'home' : (request()->routeIs('barberia') ? 'barberia' : (request()->routeIs('tatuajes*') ? 'tatuajes' : (request()->routeIs('tienda*') ? 'tienda' : (request()->routeIs('contacto') ? 'contacto' : ''))));
            @endphp
            <nav class="hidden lg:flex items-center gap-6 xl:gap-8">
                <a href="{{ route('home') }}" class="nav-link text-xs tracking-[0.18em] uppercase {{ $route === 'home' ? 'text-white active' : 'text-zinc-400 hover:text-white' }} transition-colors">Inicio</a>
                <a href="{{ route('barberia') }}" class="nav-link text-xs tracking-[0.18em] uppercase {{ $route === 'barberia' ? 'text-white active' : 'text-zinc-400 hover:text-white' }} transition-colors">Barbería</a>
                <a href="{{ route('tatuajes') }}" class="nav-link text-xs tracking-[0.18em] uppercase {{ $route === 'tatuajes' ? 'text-white active' : 'text-zinc-400 hover:text-white' }} transition-colors">Tatuajes</a>
                <a href="{{ route('tienda') }}" class="nav-link text-xs tracking-[0.18em] uppercase {{ $route === 'tienda' ? 'text-white active' : 'text-zinc-400 hover:text-white' }} transition-colors">Tienda</a>
                <a href="{{ route('contacto') }}" class="nav-link text-xs tracking-[0.18em] uppercase {{ $route === 'contacto' ? 'text-white active' : 'text-zinc-400 hover:text-white' }} transition-colors">Contacto</a>
            </nav>

            {{-- Right: carrito --}}
            <div class="flex items-center">
                <button x-on:click="$store.cart.open = true" class="relative flex items-center text-zinc-400 hover:text-white transition-colors p-1" aria-label="Carrito de compra">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                    <span x-show="$store.cart.count > 0" x-text="$store.cart.count" class="absolute -top-1 -right-1 w-4 h-4 rounded-full bg-red-800 text-white text-[10px] font-medium flex items-center justify-center leading-none"></span>
                </button>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div
            x-show="mobileOpen"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-1"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0 -translate-y-1"
            class="lg:hidden bg-black/98 border-b border-zinc-900 px-6 pb-6 pt-3"
            x-on:click.outside="mobileOpen = false"
        >
            <nav class="flex flex-col gap-4">
                <a href="{{ route('home') }}"     class="text-sm tracking-widest uppercase text-zinc-300 hover:text-white transition-colors py-1" x-on:click="mobileOpen=false">Inicio</a>
                <a href="{{ route('barberia') }}" class="text-sm tracking-widest uppercase text-zinc-300 hover:text-white transition-colors py-1" x-on:click="mobileOpen=false">Barbería</a>
                <a href="{{ route('tatuajes') }}" class="text-sm tracking-widest uppercase text-zinc-300 hover:text-white transition-colors py-1" x-on:click="mobileOpen=false">Tatuajes</a>
                <a href="{{ route('tienda') }}"   class="text-sm tracking-widest uppercase text-zinc-300 hover:text-white transition-colors py-1" x-on:click="mobileOpen=false">Tienda</a>
                <a href="{{ route('contacto') }}" class="text-sm tracking-widest uppercase text-zinc-300 hover:text-white transition-colors py-1" x-on:click="mobileOpen=false">Contacto</a>
            </nav>
        </div>
    </header>

    {{-- ════════════════════════ FLASH ════════════════════════ --}}
    @if(session('success') || session('error'))
    <div x-data="{ show: true }" x-show="show"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-end="opacity-0 -translate-y-2"
         class="fixed top-20 left-1/2 -translate-x-1/2 z-50 w-[calc(100%-2rem)] max-w-md px-0">
        <div class="flex items-center justify-between gap-4 px-4 sm:px-5 py-3 rounded border text-sm
            {{ session('success') ? 'bg-zinc-900 border-green-800 text-green-400' : 'bg-zinc-900 border-red-800 text-red-400' }}">
            <span>{{ session('success') ?? session('error') }}</span>
            <button x-on:click="show=false" class="opacity-60 hover:opacity-100 flex-shrink-0"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>
        </div>
    </div>
    @endif

    {{-- ════════════════════════ CONTENT ════════════════════════ --}}
    <main>@yield('content')</main>

    {{-- ════════════════════════ FOOTER ════════════════════════ --}}
    @php
        $ftWa    = \App\Models\SiteSetting::get('contact_whatsapp', '34600000000');
        $ftAddr1 = \App\Models\SiteSetting::get('contact_address_line1', 'Getafe, Madrid');
        $ftAddr2 = \App\Models\SiteSetting::get('contact_address_line2', '');
        $ftHwday = \App\Models\SiteSetting::get('contact_hours_weekday', '10:00 – 20:00');
        $ftHsat  = \App\Models\SiteSetting::get('contact_hours_saturday', '10:00 – 18:00');
        $ftHsun  = \App\Models\SiteSetting::get('contact_hours_sunday', 'Cerrado');
    @endphp
    <footer class="bg-zinc-950 border-t border-zinc-900 mt-20 sm:mt-24">
        <div class="h-px bg-gradient-to-r from-red-900/0 via-red-800/50 to-red-900/0"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 pt-14 pb-10">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10 lg:gap-12">

                {{-- MARCA --}}
                <div class="sm:col-span-2 lg:col-span-1">
                    <a href="{{ route('home') }}" aria-label="Leyenda Barber & Tattoo — Inicio">
                        <img src="/images/logo.png"
                             alt="Leyenda Barber & Tattoo"
                             class="h-20 w-auto object-contain mb-4"
                             loading="lazy">
                    </a>
                    <p class="text-zinc-300 text-sm leading-relaxed max-w-xs">Barbería premium y estudio de tatuajes en Getafe, Madrid. Arte y precisión en cada detalle.</p>
                </div>

                {{-- SECCIONES --}}
                <div>
                    <h4 class="text-[10px] tracking-[0.3em] uppercase text-zinc-300 mb-5">Secciones</h4>
                    <ul class="space-y-3">
                        <li><a href="{{ route('home') }}"     class="text-sm text-zinc-300 hover:text-white transition-colors">Inicio</a></li>
                        <li><a href="{{ route('barberia') }}" class="text-sm text-zinc-300 hover:text-white transition-colors">Barbería</a></li>
                        <li><a href="{{ route('tatuajes') }}" class="text-sm text-zinc-300 hover:text-white transition-colors">Tatuajes</a></li>
                        <li><a href="{{ route('tienda') }}"   class="text-sm text-zinc-300 hover:text-white transition-colors">Tienda</a></li>
                        <li><a href="{{ route('contacto') }}" class="text-sm text-zinc-300 hover:text-white transition-colors">Contacto</a></li>
                    </ul>
                </div>

                {{-- REDES SOCIALES --}}
                <div>
                    <h4 class="text-[10px] tracking-[0.3em] uppercase text-zinc-300 mb-5">Síguenos</h4>
                    <ul class="space-y-4">
                        <li>
                            <a href="https://www.instagram.com/leyenda_barberia/" target="_blank" rel="noopener"
                               class="flex items-center gap-3 group">
                                <span class="w-8 h-8 rounded-lg border border-zinc-800 group-hover:border-red-800 flex items-center justify-center transition-colors flex-shrink-0">
                                    <svg class="w-4 h-4 text-zinc-500 group-hover:text-red-600 transition-colors" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                                </span>
                                <div>
                                    <p class="text-sm text-zinc-300 group-hover:text-white transition-colors leading-none">@leyenda_barberia</p>
                                    <p class="text-[10px] text-zinc-400 mt-0.5 tracking-wide">Barbería</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.instagram.com/leyenda_tattoo06/" target="_blank" rel="noopener"
                               class="flex items-center gap-3 group">
                                <span class="w-8 h-8 rounded-lg border border-zinc-800 group-hover:border-red-800 flex items-center justify-center transition-colors flex-shrink-0">
                                    <svg class="w-4 h-4 text-zinc-500 group-hover:text-red-600 transition-colors" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                                </span>
                                <div>
                                    <p class="text-sm text-zinc-300 group-hover:text-white transition-colors leading-none">@leyenda_tattoo06</p>
                                    <p class="text-[10px] text-zinc-400 mt-0.5 tracking-wide">Tatuajes</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.instagram.com/leyenda_clothe06/" target="_blank" rel="noopener"
                               class="flex items-center gap-3 group">
                                <span class="w-8 h-8 rounded-lg border border-zinc-800 group-hover:border-red-800 flex items-center justify-center transition-colors flex-shrink-0">
                                    <svg class="w-4 h-4 text-zinc-500 group-hover:text-red-600 transition-colors" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                                </span>
                                <div>
                                    <p class="text-sm text-zinc-300 group-hover:text-white transition-colors leading-none">@leyenda_clothe06</p>
                                    <p class="text-[10px] text-zinc-400 mt-0.5 tracking-wide">Ropa</p>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>

                {{-- CONTACTO --}}
                <div>
                    <h4 class="text-[10px] tracking-[0.3em] uppercase text-zinc-300 mb-5">Contacto</h4>
                    <ul class="space-y-4">
                        <li>
                            <a href="https://wa.me/{{ $ftWa }}?text=Hola%2C%20he%20visto%20vuestra%20web%20y%20me%20gustar%C3%ADa%20pedir%20informaci%C3%B3n."
                               target="_blank" rel="noopener"
                               class="flex items-center gap-3 group">
                                <span class="w-8 h-8 rounded-lg border border-zinc-800 group-hover:border-green-800 flex items-center justify-center transition-colors flex-shrink-0">
                                    <svg class="w-4 h-4 text-zinc-500 group-hover:text-green-500 transition-colors" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                </span>
                                <p class="text-sm text-zinc-300 group-hover:text-white transition-colors">WhatsApp</p>
                            </a>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="w-8 h-8 rounded-lg border border-zinc-800 flex items-center justify-center flex-shrink-0 mt-0.5">
                                <svg class="w-4 h-4 text-zinc-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </span>
                            <div class="space-y-2.5">
                                @foreach(\App\Models\SiteSetting::branches() as $branch)
                                <div>
                                    <p class="text-sm text-zinc-300">{{ $branch['addr1'] }}</p>
                                    <p class="text-xs text-zinc-400 mt-0.5">{{ $branch['addr2'] }}</p>
                                </div>
                                @endforeach
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="w-8 h-8 rounded-lg border border-zinc-800 flex items-center justify-center flex-shrink-0 mt-0.5">
                                <svg class="w-4 h-4 text-zinc-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </span>
                            <div>
                                <p class="text-sm text-zinc-300">Lun – Vie · {{ $ftHwday }}</p>
                                @php $sunLabel = ($ftHsun && strtolower($ftHsun) !== 'cerrado') ? $ftHsun : 'Cerrado'; @endphp
                                <p class="text-xs text-zinc-400 mt-0.5">Sáb · {{ $ftHsat }} · Dom · {{ $sunLabel }}</p>
                            </div>
                        </li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="border-t border-zinc-900">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 py-4 flex flex-col sm:flex-row items-center justify-between gap-2">
                <div class="flex flex-col sm:flex-row items-center gap-1 sm:gap-3">
                    <span class="text-xs text-zinc-400">© {{ date('Y') }} Leyenda Barber &amp; Tattoo. Todos los derechos reservados.</span>
                    <span class="hidden sm:inline text-zinc-600">·</span>
                    <span class="text-xs text-zinc-400">Desarrollado por <a href="https://carlosgilpantoja.es" target="_blank" rel="noopener" class="text-zinc-300 hover:text-white transition-colors">Carlos Gil</a></span>
                </div>
                <div class="flex items-center gap-4">
                    <a href="{{ route('aviso-legal') }}" class="text-[10px] text-zinc-400 hover:text-white transition-colors tracking-widest uppercase">Aviso legal</a>
                    <a href="{{ route('privacidad') }}" class="text-[10px] text-zinc-400 hover:text-white transition-colors tracking-widest uppercase">Privacidad</a>
                    <a href="{{ route('cookies') }}" class="text-[10px] text-zinc-400 hover:text-white transition-colors tracking-widest uppercase">Cookies</a>
                    <button x-data
                            x-on:click="$dispatch('cookies-open')"
                            class="text-[10px] text-zinc-400 hover:text-white transition-colors tracking-widest uppercase">
                        Gestionar cookies
                    </button>
                </div>
            </div>
        </div>
    </footer>

    {{-- ════════════════════════ CART DRAWER ════════════════════════ --}}
    <div x-data>
        <div x-show="$store.cart.open" x-cloak
             x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
             x-on:click="$store.cart.open=false; $store.cart.checkout=false"
             class="fixed inset-0 z-40 bg-black/75 backdrop-blur-sm"></div>

        <div x-show="$store.cart.open" x-cloak
             x-transition:enter="transition ease-out duration-300" x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
             x-transition:leave="transition ease-in duration-250" x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full"
             class="fixed right-0 top-0 h-full w-full sm:max-w-sm z-50 bg-zinc-950 border-l border-zinc-800/80 flex flex-col shadow-2xl">

            {{-- Header --}}
            <div class="flex items-center justify-between px-5 py-4 border-b border-zinc-800/80 flex-shrink-0">
                <div>
                    <h2 class="font-heading text-lg sm:text-xl text-white tracking-wide" x-text="$store.cart.checkout ? 'FINALIZAR PEDIDO' : 'TU CARRITO'"></h2>
                    <span class="text-[10px] text-zinc-500 tracking-widest uppercase" x-text="`${$store.cart.count} artículo${$store.cart.count !== 1 ? 's' : ''}`"></span>
                </div>
                <button x-on:click="$store.cart.open=false; $store.cart.checkout=false" class="w-8 h-8 flex items-center justify-center rounded-full border border-zinc-800 text-zinc-500 hover:text-white hover:border-zinc-600 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            {{-- Body --}}
            <div class="flex-1 overflow-y-auto overscroll-contain">

                {{-- Items --}}
                <div x-show="!$store.cart.checkout">
                    <template x-if="$store.cart.items.length === 0">
                        <div class="flex flex-col items-center justify-center h-64 gap-4 text-center px-6">
                            <div class="w-16 h-16 rounded-full border border-zinc-800 flex items-center justify-center">
                                <svg class="w-7 h-7 text-zinc-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                            </div>
                            <div>
                                <p class="text-zinc-300 text-sm font-medium">Carrito vacío</p>
                                <p class="text-zinc-600 text-xs mt-0.5">Aún no has añadido nada</p>
                            </div>
                            <a href="{{ route('tienda') }}" x-on:click="$store.cart.open=false"
                               class="text-[10px] tracking-widest uppercase text-zinc-400 hover:text-white border border-zinc-700 hover:border-zinc-500 rounded px-4 py-2 transition-all">
                                Ver tienda →
                            </a>
                        </div>
                    </template>
                    <template x-for="item in $store.cart.items" :key="item.key">
                        <div class="flex gap-3 px-5 py-4 border-b border-zinc-900">
                            <div class="w-16 h-16 bg-zinc-900 rounded-lg overflow-hidden flex-shrink-0 border border-zinc-800">
                                <template x-if="item.image">
                                    <img :src="item.image && item.image.startsWith('http') ? item.image : `/storage/${item.image}`" :alt="item.name" class="w-full h-full object-cover" loading="lazy">
                                </template>
                                <template x-if="!item.image">
                                    <div class="w-full h-full flex items-center justify-center">
                                        <svg class="w-5 h-5 text-zinc-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                                    </div>
                                </template>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm text-white font-medium truncate leading-snug" x-text="item.name"></p>
                                <p class="text-[10px] text-zinc-500 tracking-widest uppercase mt-0.5" x-show="item.size" x-text="`Talla: ${item.size}`"></p>
                                <div class="flex items-center justify-between mt-2.5">
                                    <div class="flex items-center gap-0">
                                        <button x-on:click="$store.cart.update(item.key, item.quantity - 1)" :disabled="item.quantity <= 1"
                                            class="w-7 h-7 flex items-center justify-center border border-zinc-800 text-zinc-400 hover:border-zinc-600 hover:text-white transition-colors rounded-l disabled:opacity-30 text-sm">−</button>
                                        <span class="text-xs text-white w-8 text-center border-t border-b border-zinc-800 h-7 flex items-center justify-center" x-text="item.quantity"></span>
                                        <button x-on:click="$store.cart.update(item.key, item.quantity + 1)"
                                            class="w-7 h-7 flex items-center justify-center border border-zinc-800 text-zinc-400 hover:border-zinc-600 hover:text-white transition-colors rounded-r text-sm">+</button>
                                    </div>
                                    <span class="text-sm font-heading text-white" x-text="`${(item.price * item.quantity).toFixed(2)}€`"></span>
                                </div>
                            </div>
                            <button x-on:click="$store.cart.remove(item.key)" class="self-start text-zinc-700 hover:text-red-600 transition-colors mt-0.5 flex-shrink-0">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </div>
                    </template>
                </div>

                {{-- Checkout form --}}
                <div x-show="$store.cart.checkout" class="px-5 py-5">
                    <form action="{{ route('carrito.checkout') }}" method="POST" class="space-y-3.5">
                        @csrf
                        <div>
                            <label class="block text-[10px] tracking-widest uppercase text-zinc-400 mb-1.5">Nombre completo *</label>
                            <input type="text" name="customer_name" required value="{{ old('customer_name') }}" placeholder="Tu nombre"
                                class="w-full bg-zinc-900 border border-zinc-800 text-white text-sm px-4 py-2.5 rounded focus:outline-none focus:border-red-800 transition-colors placeholder-zinc-600">
                        </div>
                        <div>
                            <label class="block text-[10px] tracking-widest uppercase text-zinc-400 mb-1.5">Email *</label>
                            <input type="email" name="customer_email" required value="{{ old('customer_email') }}" placeholder="tu@email.com"
                                class="w-full bg-zinc-900 border border-zinc-800 text-white text-sm px-4 py-2.5 rounded focus:outline-none focus:border-red-800 transition-colors placeholder-zinc-600">
                        </div>
                        <div>
                            <label class="block text-[10px] tracking-widest uppercase text-zinc-400 mb-1.5">Teléfono *</label>
                            <input type="tel" name="customer_phone" required value="{{ old('customer_phone') }}" placeholder="+34 600 000 000"
                                class="w-full bg-zinc-900 border border-zinc-800 text-white text-sm px-4 py-2.5 rounded focus:outline-none focus:border-red-800 transition-colors placeholder-zinc-600">
                        </div>
                        <div>
                            <label class="block text-[10px] tracking-widest uppercase text-zinc-400 mb-1.5">Recoger en *</label>
                            <div class="space-y-2">
                                @foreach(\App\Models\SiteSetting::branches() as $i => $branch)
                                <label class="flex items-start gap-2.5 bg-zinc-900/80 border border-zinc-800 has-[:checked]:border-red-800 has-[:checked]:bg-red-900/10 rounded-lg px-3 py-2.5 cursor-pointer transition-colors">
                                    <input type="radio" name="pickup_branch" value="{{ $branch['label'] }}" required
                                           {{ old('pickup_branch', $i === session('pickup_branch', 1) - 1 ? $branch['label'] : null) === $branch['label'] ? 'checked' : '' }}
                                           class="mt-0.5 accent-red-700 flex-shrink-0">
                                    <span class="text-xs leading-relaxed">
                                        <span class="block text-white font-medium">{{ $branch['name'] }}</span>
                                        <span class="block text-zinc-500">{{ $branch['addr1'] }}</span>
                                    </span>
                                </label>
                                @endforeach
                            </div>
                            <p class="text-zinc-500 text-[11px] mt-1.5">Recogida en tienda. Te contactamos para coordinar.</p>
                        </div>
                        <div>
                            <label class="block text-[10px] tracking-widest uppercase text-zinc-400 mb-1.5">Notas <span class="text-zinc-600 normal-case tracking-normal">(opcional)</span></label>
                            <textarea name="notes" rows="2" placeholder="Hora de recogida, notas..."
                                class="w-full bg-zinc-900 border border-zinc-800 text-white text-sm px-4 py-2.5 rounded focus:outline-none focus:border-red-800 transition-colors placeholder-zinc-600 resize-none">{{ old('notes') }}</textarea>
                        </div>
                        <div class="border-t border-zinc-800 pt-3 space-y-1">
                            <template x-for="item in $store.cart.items" :key="item.key">
                                <div class="flex justify-between text-xs py-0.5">
                                    <span class="text-zinc-500" x-text="`${item.name}${item.size ? ' ('+item.size+')' : ''} × ${item.quantity}`"></span>
                                    <span class="text-zinc-300" x-text="`${(item.price * item.quantity).toFixed(2)}€`"></span>
                                </div>
                            </template>
                            <div class="flex justify-between mt-2 pt-2 border-t border-zinc-800">
                                <span class="text-white text-sm font-medium">Total</span>
                                <span class="text-white font-heading text-lg" x-text="`${$store.cart.total}€`"></span>
                            </div>
                        </div>
                        <button type="submit" class="w-full bg-red-800 hover:bg-red-700 text-white text-xs tracking-widest uppercase py-3.5 transition-colors rounded btn-press">Confirmar pedido</button>
                    </form>
                    <button x-on:click="$store.cart.checkout=false" class="mt-3 w-full text-center text-xs text-zinc-600 hover:text-zinc-400 transition-colors">← Volver al carrito</button>
                </div>
            </div>

            {{-- Footer --}}
            <div x-show="!$store.cart.checkout && $store.cart.items.length > 0" class="px-5 py-4 border-t border-zinc-800/80 flex-shrink-0 bg-zinc-950">
                <div class="flex justify-between items-baseline mb-4">
                    <span class="text-xs text-zinc-500 tracking-widest uppercase">Total estimado</span>
                    <span class="font-heading text-2xl text-white" x-text="`${$store.cart.total}€`"></span>
                </div>
                <button x-on:click="$store.cart.checkout=true" class="w-full bg-red-800 hover:bg-red-700 text-white text-xs tracking-widest uppercase py-3.5 transition-colors rounded btn-press">
                    Finalizar pedido
                </button>
                <p class="text-[10px] text-zinc-600 text-center mt-2 tracking-wide">Recogida en tienda · 2 sucursales en Getafe</p>
            </div>
        </div>
    </div>

    {{-- ════════════════════════ COOKIE BANNER ════════════════════════ --}}
    <div x-data="{
            show: false,
            init() {
                var saved = localStorage.getItem('leyenda_cookies');
                if (!saved) this.show = true;
                this.$el.addEventListener('cookies-open', () => { this.show = true; });
            },
            accept() {
                localStorage.setItem('leyenda_cookies', 'accepted');
                gtag('consent', 'update', {
                    'analytics_storage':  'granted',
                    'ad_storage':         'denied',
                    'ad_user_data':       'denied',
                    'ad_personalization': 'denied'
                });
                this.show = false;
            },
            reject() {
                localStorage.setItem('leyenda_cookies', 'rejected');
                this.show = false;
            }
         }"
         x-show="show"
         x-transition:enter="transition ease-out duration-400"
         x-transition:enter-start="opacity-0 translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-250"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 translate-y-4"
         style="display:none"
         class="fixed bottom-0 inset-x-0 z-50 p-4 sm:p-5 sm:pb-6">
        <div class="max-w-3xl mx-auto bg-zinc-900/98 backdrop-blur-md border border-zinc-800 rounded-2xl shadow-2xl px-5 py-4 sm:px-6 sm:py-5 flex flex-col sm:flex-row sm:items-center gap-4 sm:gap-6">
            <div class="flex items-start gap-3 flex-1 min-w-0">
                <svg class="w-5 h-5 text-zinc-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                <div>
                    <p class="text-sm text-white font-medium mb-0.5">Usamos cookies analíticas</p>
                    <p class="text-xs text-zinc-500 leading-relaxed">Para medir visitas y mejorar la web. Nunca para publicidad. <a href="{{ route('cookies') }}" class="text-zinc-400 hover:text-white underline underline-offset-2 transition-colors">Más info</a></p>
                </div>
            </div>
            <div class="flex items-center gap-2.5 flex-shrink-0 sm:flex-row flex-row">
                <button x-on:click="reject()"
                        class="text-[11px] tracking-widest uppercase text-zinc-500 hover:text-zinc-300 transition-colors whitespace-nowrap border border-zinc-800 hover:border-zinc-600 px-4 py-2 rounded-lg">
                    Solo esenciales
                </button>
                <button x-on:click="accept()"
                        class="text-[11px] tracking-widest uppercase bg-white text-black hover:bg-zinc-200 transition-colors whitespace-nowrap px-5 py-2 rounded-lg font-medium">
                    Aceptar
                </button>
            </div>
        </div>
    </div>

    {{-- ════════════════════════ MODAL BOOKSY: ELEGIR SUCURSAL ════════════════════════ --}}
    <div x-data="{ open: false }"
         x-on:open-booksy.window="open = true"
         x-on:keydown.escape.window="open = false"
         x-show="open"
         x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-[60] bg-black/90 backdrop-blur-sm flex items-center justify-center p-4"
         x-on:click.self="open = false"
         style="display:none">
        <div class="relative w-full max-w-2xl bg-zinc-950 border border-zinc-800 rounded-xl shadow-2xl overflow-hidden" x-on:click.stop>
            <div class="h-px bg-gradient-to-r from-red-900/0 via-red-800/70 to-red-900/0"></div>
            <button type="button" x-on:click="open = false"
                class="absolute top-3 right-3 w-9 h-9 flex items-center justify-center rounded-full bg-zinc-800 hover:bg-zinc-700 border border-zinc-700 text-white transition-all"
                aria-label="Cerrar">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
            <div class="p-6 sm:p-8">
                <span class="text-[10px] tracking-[0.5em] uppercase text-red-800">Reserva Online · Booksy</span>
                <h3 class="font-heading text-3xl sm:text-4xl text-white leading-none mt-2">ELIGE TU SUCURSAL</h3>
                <p class="text-zinc-400 text-sm mt-3">Tenemos dos barberías en Getafe. Elige dónde quieres tu cita.</p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mt-6">
                    @foreach(\App\Models\SiteSetting::branches() as $i => $branch)
                    <a href="{{ $branch['booksy'] }}" target="_blank" rel="noopener" x-on:click="open = false"
                       class="group relative block bg-red-900/10 border border-red-900/30 hover:bg-red-900/20 hover:border-red-800/60 rounded-xl p-5 transition-all duration-300 btn-press">
                        <span class="text-[9px] tracking-[0.4em] uppercase text-zinc-500">Sucursal 0{{ $i + 1 }}</span>
                        <h4 class="font-heading text-2xl text-white leading-tight mt-1">{{ $branch['name'] }}</h4>
                        <p class="text-zinc-400 text-xs mt-2 leading-relaxed">{{ $branch['addr1'] }}<br>{{ $branch['addr2'] }}</p>
                        <span class="mt-4 inline-flex items-center gap-1.5 text-[10px] tracking-widest uppercase text-red-500 group-hover:text-red-400 font-medium transition-all group-hover:gap-3">
                            Reservar aquí
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </span>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- ════════════════════════ WHATSAPP FLOAT ════════════════════════ --}}
    @php $floatWa = \App\Models\SiteSetting::get('contact_whatsapp', '34600000000'); @endphp
    <div x-data="{
            show: false,
            init() {
                setTimeout(() => { this.show = true; }, 3500);
                setTimeout(() => { this.show = false; }, 9500);
                setInterval(() => {
                    setTimeout(() => { this.show = true; }, 500);
                    setTimeout(() => { this.show = false; }, 6500);
                }, 40000);
            }
         }"
         class="fixed bottom-5 right-5 z-40 flex flex-col items-end gap-2">

        {{-- Burbuja --}}
        <div x-show="show"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-2 scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
             x-transition:leave-end="opacity-0 translate-y-1 scale-95"
             style="display:none"
             class="relative bg-zinc-900/95 backdrop-blur-sm border border-zinc-800 rounded-xl rounded-br-none px-3.5 py-2.5 shadow-xl mr-1">
            <p class="text-[11px] text-zinc-300 leading-snug whitespace-nowrap">¿Dudas? Escríbenos por WhatsApp</p>
            <button @click="show=false" class="absolute -top-1.5 -right-1.5 w-4 h-4 bg-zinc-700 hover:bg-zinc-600 rounded-full flex items-center justify-center transition-colors">
                <svg class="w-2 h-2 text-zinc-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        {{-- Botón --}}
        <a href="https://wa.me/{{ $floatWa }}?text=Hola%2C%20he%20visto%20vuestra%20web%20y%20me%20gustar%C3%ADa%20pedir%20informaci%C3%B3n."
           target="_blank" rel="noopener"
           aria-label="Contactar por WhatsApp"
           class="rounded-full flex items-center justify-center shadow-2xl hover:scale-110 active:scale-95 transition-transform duration-200"
           style="background-color:#25D366; width:50px; height:50px;">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
            </svg>
        </a>
    </div>

</body>
</html>
