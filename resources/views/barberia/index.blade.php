@extends('layouts.app')

@section('title', 'Barbería en Getafe y Madrid — Leyenda Barber | Cortes, Degradados y Barba')
@section('meta_description', 'Barbería profesional en Getafe y Madrid. Cortes modernos, degradados, arreglo de barba y afeitado a navaja. Reserva tu cita online en Booksy. Leyenda Barber & Tattoo.')

@section('content')
@php
    $img = fn($path) => $path ? (str_starts_with($path, 'http') ? $path : asset('storage/' . $path)) : null;
    $s   = fn(string $key, string $default = '') => \App\Models\SiteSetting::get($key, $default);
    $heroSetting = \App\Models\SiteSetting::get('barberia_hero_image');
    $heroUrl = $heroSetting ? asset('storage/' . $heroSetting) : '/images/barberia-hero.jpg';

    // Datos para JS — se pasan por script tag, nunca inline en atributos
    $branches    = \App\Models\SiteSetting::branches();
    $barbersData = $barbers->map(fn($b) => [
        'name'        => $b->name,
        'role'        => $b->role ?? '',
        'branch'      => $branches[$b->branch - 1]['name'] ?? 'Ambas sucursales',
        'booksy'      => $branches[$b->branch - 1]['booksy'] ?? null,
        'image'       => $img($b->image),
        'description' => $b->description ?? '',
        'gallery'     => $b->gallery
            ->filter(fn($g) => $img($g->image))
            ->map(fn($g) => ['img' => $img($g->image), 'title' => $g->title ?? ''])
            ->values(),
    ])->values();

    // Solo fotos con imagen real — el índice PHP = índice JS
    $validGallery = $gallery->filter(fn($p) => $img($p->image))->values();
    $galleryData  = $validGallery->map(fn($p) => [
        'img'    => $img($p->image),
        'title'  => $p->title ?? '',
        'barber' => $p->barber?->name ?? '',
    ]);
@endphp

{{-- Datos para Alpine — en script tag, sin riesgo de romper HTML --}}
<script id="lb-barbers" type="application/json">@json($barbersData)</script>
<script id="lb-gallery" type="application/json">@json($galleryData)</script>

{{-- Wrapper Alpine --}}
<div
    x-data="{
        barbers: JSON.parse(document.getElementById('lb-barbers').textContent),
        galImages: JSON.parse(document.getElementById('lb-gallery').textContent),

        svcOpen: false,
        svcData: {},
        openSvc(d) { this.svcData = d; this.svcOpen = true; document.body.style.overflow = 'hidden'; },
        closeSvc() { this.svcOpen = false; document.body.style.overflow = ''; },

        barberOpen: false,
        activeBarber: null,
        openBarber(i) { this.activeBarber = this.barbers[i]; this.barberOpen = true; document.body.style.overflow = 'hidden'; },
        closeBarber() { this.barberOpen = false; document.body.style.overflow = ''; },

        galOpen: false,
        galIdx: 0,
        openGal(i) { this.galIdx = i; this.galOpen = true; document.body.style.overflow = 'hidden'; },
        closeGal() { this.galOpen = false; document.body.style.overflow = ''; },
        prevGal() { this.galIdx = this.galIdx > 0 ? this.galIdx - 1 : this.galImages.length - 1; },
        nextGal() { this.galIdx = this.galIdx < this.galImages.length - 1 ? this.galIdx + 1 : 0; },
        swipeX: 0,
        swipeStart(e) { this.swipeX = e.touches[0].clientX; },
        swipeEnd(e) {
            const d = this.swipeX - e.changedTouches[0].clientX;
            if (Math.abs(d) > 45) { d > 0 ? this.nextGal() : this.prevGal(); }
        }
    }"
    x-on:keydown.escape.window="closeSvc(); closeBarber(); closeGal()"
>

{{-- ═══ HERO ═══ --}}
<section class="relative min-h-[78vh] sm:min-h-[88vh] flex items-end overflow-hidden">
    <div class="absolute inset-0">
        <img src="{{ $heroUrl }}" alt="Barbería Leyenda Getafe — Cortes y Degradados" class="w-full h-full object-cover object-center" loading="eager" fetchpriority="high">
        <div class="absolute inset-0 bg-black/55"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/20 to-transparent"></div>
    </div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 pb-12 sm:pb-16 pt-32 w-full">
        <h1 class="font-heading text-[16vw] sm:text-[12vw] md:text-[9vw] leading-none text-white drop-shadow-2xl">BARBERÍA</h1>
        <span class="text-[10px] tracking-[0.5em] uppercase text-zinc-400 mt-3 block">Barbería · 2 Sucursales en Getafe</span>
        <div class="h-0.5 w-16 bg-red-800 mt-4"></div>
        <div class="flex flex-col sm:flex-row sm:items-end gap-4 sm:gap-8 mt-4">
            <p class="text-zinc-300 text-sm sm:text-base max-w-md leading-relaxed">{{ $s('barberia_hero_description', 'Cortes precisos, acabados impecables. Tu barbería de confianza en Getafe y Madrid.') }}</p>
            <a href="https://booksy.com/es-es/105117_leyenda-barberia_barberia_52975_getafe#ba_s=sr_1" target="_blank" rel="noopener" x-on:click.prevent="$dispatch('open-booksy')"
               class="flex-none inline-flex items-center gap-2 bg-red-800 hover:bg-red-700 text-white text-xs tracking-widest uppercase px-6 py-3.5 rounded transition-colors btn-press">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Reservar en Booksy
            </a>
        </div>
    </div>
</section>

{{-- ═══ INTRO SEO — estilo cita centrada ═══ --}}
<section class="bg-zinc-950 border-b border-zinc-900">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 py-12 sm:py-16 text-center" data-reveal>
        <div class="flex items-center justify-center gap-4 mb-6">
            <div class="h-px flex-1 max-w-[60px] bg-zinc-800"></div>
            <span class="text-[9px] tracking-[0.5em] uppercase text-zinc-400">Barbería · Getafe · Madrid</span>
            <div class="h-px flex-1 max-w-[60px] bg-zinc-800"></div>
        </div>
        <p class="font-heading text-2xl sm:text-3xl md:text-4xl text-white leading-snug">
            {{ $s('barberia_intro_heading', 'Cortes precisos. Degradados técnicos. Barba trabajada al detalle.') }}
        </p>
        <p class="text-zinc-500 text-sm leading-relaxed mt-5 max-w-xl mx-auto">
            {{ $s('barberia_intro_description', 'Tu barbería de referencia en Getafe y sur de Madrid. Peluquería masculina premium donde cada visita es una experiencia.') }}
        </p>
        <div class="flex flex-wrap items-center justify-center gap-2 mt-6">
            <span class="text-[10px] tracking-widest uppercase text-zinc-400 border border-zinc-800 rounded-full px-3 py-1">Corte de pelo</span>
            <span class="text-[10px] tracking-widest uppercase text-zinc-400 border border-zinc-800 rounded-full px-3 py-1">Degradados</span>
            <span class="text-[10px] tracking-widest uppercase text-zinc-400 border border-zinc-800 rounded-full px-3 py-1">Arreglo de barba</span>
            <span class="text-[10px] tracking-widest uppercase text-zinc-400 border border-zinc-800 rounded-full px-3 py-1">Afeitado a navaja</span>
        </div>
    </div>
</section>

{{-- ═══ SERVICIOS & TARIFAS ═══ --}}
@if($services->count() > 0)
<section id="servicios" class="max-w-7xl mx-auto px-4 sm:px-6 py-14 sm:py-20">
    <div class="mb-10 sm:mb-12" data-reveal>
        <span class="text-[10px] tracking-[0.5em] uppercase text-zinc-400">Precios · Getafe</span>
        <h2 class="section-title font-heading text-3xl sm:text-4xl md:text-5xl text-white mt-1">SERVICIOS &amp; TARIFAS</h2>
        <p class="text-zinc-500 text-sm mt-2">Pulsa en la imagen para verla en detalle.</p>
    </div>

    <div class="divide-y divide-zinc-900" data-reveal>
        @foreach($services as $service)
        @php
            $sImg = $img($service->image);
            $svcPayload = [
                'img'   => $sImg,
                'name'  => $service->name,
                'desc'  => $service->description ?? '',
                'price' => number_format($service->price, 0),
                'dur'   => $service->duration ?? '',
            ];
        @endphp
        <div class="service-row flex items-center gap-4 sm:gap-6 py-5 sm:py-6 px-2 sm:px-3">

            @if($sImg)
            <button
                type="button"
                class="flex-shrink-0 w-24 h-24 sm:w-32 sm:h-32 rounded-xl overflow-hidden bg-zinc-800 shadow-lg relative group focus:outline-none focus-visible:ring-2 focus-visible:ring-red-700"
                x-on:click="openSvc({{ json_encode($svcPayload, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) }})"
                aria-label="Ver {{ $service->name }}">
                <img src="{{ $sImg }}" alt="{{ $service->name }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" loading="lazy">
                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/35 transition-colors duration-300 flex items-center justify-center">
                    <svg class="w-5 h-5 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300 drop-shadow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/></svg>
                </div>
            </button>
            @else
            <div class="flex-shrink-0 w-24 h-24 sm:w-32 sm:h-32 rounded-xl bg-zinc-900 border border-zinc-800 flex items-center justify-center">
                <img src="/images/logo.png" alt="Leyenda Barber &amp; Tattoo" class="w-3/4 h-3/4 object-contain opacity-80" loading="lazy">
            </div>
            @endif

            <div class="flex-1 min-w-0">
                <h3 class="text-white font-medium text-sm sm:text-base leading-snug">{{ $service->name }}</h3>
                @if($service->description)
                <p class="text-zinc-500 text-xs sm:text-sm mt-1.5 leading-relaxed line-clamp-2">{{ $service->description }}</p>
                @endif
                @if($service->duration)
                <span class="inline-block mt-2 text-[10px] text-zinc-400 tracking-widest uppercase border border-zinc-800 rounded px-2 py-0.5">{{ $service->duration }} min</span>
                @endif
            </div>

            <span class="flex-shrink-0 font-heading text-3xl sm:text-4xl text-red-700 leading-none">{{ number_format($service->price, 0) }}€</span>
        </div>
        @endforeach
    </div>

    <div class="mt-10 text-center" data-reveal>
        <a href="https://booksy.com/es-es/105117_leyenda-barberia_barberia_52975_getafe#ba_s=sr_1" target="_blank" rel="noopener" x-on:click.prevent="$dispatch('open-booksy')"
           class="inline-flex items-center gap-2 bg-red-800 hover:bg-red-700 text-white text-xs tracking-widest uppercase px-7 py-3.5 rounded transition-colors btn-press">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            Reservar cita ahora
        </a>
    </div>
</section>
@endif

{{-- ═══ EQUIPO ═══ --}}
@if($barbers->count() > 0)
<section id="equipo" class="bg-zinc-950 border-t border-zinc-900 py-14 sm:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="mb-10 sm:mb-12" data-reveal>
            <span class="text-[10px] tracking-[0.5em] uppercase text-zinc-400">Barberos · Leyenda Getafe</span>
            <h2 class="section-title font-heading text-3xl sm:text-4xl md:text-5xl text-white mt-1">EL EQUIPO</h2>
            <p class="text-zinc-400 text-sm mt-2 max-w-lg leading-relaxed">Técnica, pasión y experiencia en cada corte. Pulsa en un barbero para conocer su perfil y ver su trabajo.</p>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-5" data-reveal>
            @foreach($barbers as $i => $barber)
            @php $bImg = $img($barber->image); @endphp
            <button
                type="button"
                class="group relative rounded-xl overflow-hidden bg-zinc-900 border border-zinc-800 hover:border-red-900/60 transition-all duration-300 focus:outline-none focus-visible:ring-2 focus-visible:ring-red-700 text-left"
                x-on:click="openBarber({{ $i }})"
                aria-label="Ver perfil de {{ $barber->name }}">

                <div class="aspect-[3/4] overflow-hidden bg-zinc-800 relative">
                    @if($bImg)
                        <img src="{{ $bImg }}" alt="{{ $barber->name }} — Barbero en Getafe"
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-zinc-800 to-zinc-900">
                            <svg class="w-12 h-12 text-zinc-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/10 to-transparent pointer-events-none"></div>
                    <div class="absolute top-3 right-3 w-8 h-8 rounded-full bg-black/50 border border-zinc-600 group-hover:border-red-700 flex items-center justify-center transition-all duration-300">
                        <svg class="w-3.5 h-3.5 text-zinc-300 group-hover:text-red-400 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                    <div class="absolute bottom-0 left-0 right-0 p-3 sm:p-4">
                        <h3 class="font-heading text-xl sm:text-2xl text-white leading-tight">{{ $barber->name }}</h3>
                        <span class="text-[10px] tracking-widest uppercase text-zinc-400 group-hover:text-red-400 transition-colors duration-300">{{ $barber->role }}</span>
                        <span class="flex items-center gap-1 mt-1 text-[9px] tracking-[0.25em] uppercase text-red-500/90">
                            <svg class="w-2.5 h-2.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            {{ $branches[$barber->branch - 1]['name'] ?? 'Ambas sucursales' }}
                        </span>
                    </div>
                </div>

                <div class="px-3 sm:px-4 py-2.5 flex items-center justify-between border-t border-zinc-800 group-hover:border-red-900/40 transition-colors duration-300">
                    <span class="text-[10px] tracking-widest uppercase text-zinc-500 group-hover:text-zinc-300 transition-colors">Ver perfil</span>
                    <svg class="w-3.5 h-3.5 text-zinc-400 group-hover:text-red-600 group-hover:translate-x-0.5 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </div>
            </button>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ═══ GALERÍA ═══ --}}
@if($validGallery->count() > 0)
<section class="py-14 sm:py-20"
         x-data="{ scroll(dir){ $refs.galCarousel.scrollBy({ left: dir * 260, behavior: 'smooth' }) } }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="flex items-end justify-between mb-8 sm:mb-10" data-reveal>
            <div>
                <span class="text-[10px] tracking-[0.5em] uppercase text-zinc-400">Trabajos recientes</span>
                <h2 class="section-title font-heading text-3xl sm:text-4xl md:text-5xl text-white mt-1">GALERÍA</h2>
                <p class="text-zinc-500 text-sm mt-1">Toca una imagen para ampliarla.</p>
            </div>
            {{-- Flechas --}}
            <div class="flex gap-2">
                <button type="button" x-on:click="scroll(-1)"
                    class="w-9 h-9 flex items-center justify-center rounded-full border border-zinc-700 hover:border-zinc-500 text-zinc-400 hover:text-white transition-all"
                    aria-label="Anterior">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <button type="button" x-on:click="scroll(1)"
                    class="w-9 h-9 flex items-center justify-center rounded-full border border-zinc-700 hover:border-zinc-500 text-zinc-400 hover:text-white transition-all"
                    aria-label="Siguiente">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Carrusel full-bleed --}}
    <div class="relative" data-reveal>
        <div class="flex gap-2 sm:gap-3 overflow-x-auto pl-4 sm:pl-[max(1.5rem,calc((100vw-80rem)/2+1.5rem))] pr-4 pb-2"
             x-ref="galCarousel"
             style="scrollbar-width:none;-webkit-overflow-scrolling:touch;scroll-snap-type:x mandatory">
            @foreach($validGallery as $i => $photo)
            @php $gImg = $img($photo->image); @endphp
            <button
                type="button"
                class="flex-none relative overflow-hidden rounded-xl group focus:outline-none focus-visible:ring-2 focus-visible:ring-red-700"
                style="width:220px;scroll-snap-align:start"
                x-on:click="openGal({{ $i }})"
                aria-label="{{ $photo->title ?: 'Ver foto de barbería' }}">
                <div class="w-full overflow-hidden rounded-xl" style="height:280px">
                    <img src="{{ $gImg }}"
                         alt="{{ $photo->title ?: 'Corte — Barbería Leyenda Getafe' }}"
                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                         loading="lazy">
                </div>
                <div class="absolute inset-0 rounded-xl bg-black/0 group-hover:bg-black/50 transition-colors duration-300 flex items-end pointer-events-none">
                    <div class="p-3 w-full translate-y-2 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300">
                        @if($photo->title)<p class="text-sm font-medium text-white leading-tight truncate">{{ $photo->title }}</p>@endif
                        @if($photo->barber)<p class="text-[10px] text-zinc-300 tracking-widest uppercase mt-0.5">{{ $photo->barber->name }}</p>@endif
                    </div>
                </div>
            </button>
            @endforeach
        </div>
    </div>

    <p class="text-center text-[10px] text-zinc-700 tracking-widest uppercase mt-4 sm:hidden px-4">Desliza para ver más · Toca para ampliar</p>
</section>
@endif

{{-- ═══ CTA ═══ --}}
<section class="relative overflow-hidden bg-black border-t border-zinc-900">
    <div class="absolute inset-0 bg-gradient-to-br from-red-950/40 via-black to-black pointer-events-none"></div>
    <div class="absolute inset-0 opacity-[0.04]" style="background-image:linear-gradient(rgba(255,255,255,.12) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,.12) 1px,transparent 1px);background-size:40px 40px"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 py-16 sm:py-24 flex flex-col sm:flex-row items-center justify-between gap-8 sm:gap-12" data-reveal>
        <div>
            <span class="text-[10px] tracking-[0.5em] uppercase text-red-800">Reserva Online · 2 Sucursales en Getafe</span>
            <h2 class="font-heading text-4xl sm:text-5xl md:text-6xl lg:text-7xl text-white leading-none mt-2">¿CUÁNDO ES<br>TU PRÓXIMO<br>CORTE?</h2>
            <p class="text-zinc-400 text-sm mt-4 max-w-sm leading-relaxed">Sin esperas, sin llamadas. Elige tu barbero y tu hora en segundos.</p>
        </div>
        <div class="flex-none flex flex-col items-stretch sm:items-end gap-3 w-full sm:w-auto">
            @include('partials.booksy-branches')
            <span class="text-[10px] tracking-widest uppercase text-zinc-400 text-center sm:text-right">Gratis · Sin registro previo</span>
        </div>
    </div>
    <div class="absolute top-0 left-0 w-1 h-full bg-red-800 opacity-40"></div>
</section>

{{-- ══════════════════════════════════════
     MODALES
══════════════════════════════════════ --}}

{{-- Servicio --}}
<div x-show="svcOpen"
     x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-50 bg-black/90 backdrop-blur-sm flex items-center justify-center p-4 sm:p-8"
     x-on:click.self="closeSvc()" style="display:none">
    <button type="button" x-on:click="closeSvc()"
        class="absolute top-4 right-4 w-10 h-10 flex items-center justify-center rounded-full bg-zinc-800 hover:bg-zinc-700 border border-zinc-700 text-white transition-all"
        aria-label="Cerrar">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
    </button>
    <div class="max-w-lg w-full bg-zinc-950 border border-zinc-800 rounded-xl overflow-hidden shadow-2xl" x-on:click.stop>
        <div class="aspect-video sm:aspect-[4/3] bg-zinc-900 overflow-hidden" x-show="svcData.img">
            <img :src="svcData.img" :alt="svcData.name" class="w-full h-full object-cover">
        </div>
        <div class="p-5 sm:p-6">
            <h3 class="font-heading text-2xl sm:text-3xl text-white" x-text="svcData.name"></h3>
            <div class="flex items-center gap-3 mt-2">
                <span class="font-heading text-2xl text-red-600" x-text="svcData.price + '€'"></span>
                <span class="text-xs text-zinc-400 tracking-widest uppercase" x-show="svcData.dur" x-text="svcData.dur + ' min'"></span>
            </div>
            <p class="text-zinc-400 text-sm leading-relaxed mt-3" x-show="svcData.desc" x-text="svcData.desc"></p>
            <a href="https://booksy.com/es-es/105117_leyenda-barberia_barberia_52975_getafe#ba_s=sr_1" target="_blank" rel="noopener" x-on:click.prevent="$dispatch('open-booksy')"
               class="mt-5 flex items-center justify-center gap-2 bg-red-800 hover:bg-red-700 text-white text-xs tracking-widest uppercase px-5 py-3 rounded transition-colors w-full btn-press">
                Reservar este servicio
            </a>
        </div>
    </div>
</div>

{{-- Barbero --}}
<div x-show="barberOpen"
     x-transition:enter="transition ease-out duration-250" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-50 bg-black/92 backdrop-blur-sm flex items-center justify-center p-3 sm:p-6"
     x-on:click.self="closeBarber()" style="display:none">

    <button type="button" x-on:click="closeBarber()"
        class="fixed top-3 right-3 z-10 w-9 h-9 flex items-center justify-center rounded-full bg-zinc-800 hover:bg-zinc-700 border border-zinc-700 text-white transition-all"
        aria-label="Cerrar perfil">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
    </button>

    <template x-if="activeBarber">
        <div class="w-full max-w-xl max-h-[88vh] overflow-y-auto bg-zinc-950 border border-zinc-800 rounded-xl shadow-2xl"
             x-on:click.stop
             style="scrollbar-width:none">

            {{-- Cabecera: foto pequeña + info lado a lado --}}
            <div class="flex gap-0 items-stretch">
                {{-- Foto fija --}}
                <div class="w-32 sm:w-44 flex-shrink-0 bg-zinc-900 self-stretch">
                    <template x-if="activeBarber.image">
                        <img :src="activeBarber.image" :alt="activeBarber.name"
                             class="w-full h-full object-cover object-top" style="min-height:160px">
                    </template>
                    <template x-if="!activeBarber.image">
                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-zinc-800 to-zinc-900" style="min-height:160px">
                            <svg class="w-10 h-10 text-zinc-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </div>
                    </template>
                </div>
                {{-- Info --}}
                <div class="flex-1 p-4 sm:p-5 flex flex-col justify-between min-w-0">
                    <div>
                        <span class="text-[9px] tracking-[0.4em] uppercase text-red-700" x-text="'Barbero · ' + activeBarber.branch"></span>
                        <h3 class="font-heading text-2xl sm:text-3xl text-white leading-tight mt-0.5" x-text="activeBarber.name"></h3>
                        <p class="text-[10px] tracking-widest uppercase text-zinc-500 mt-0.5" x-text="activeBarber.role"></p>
                        <div class="h-px w-8 bg-red-800 mt-3 mb-3"></div>
                        <p class="text-zinc-400 text-xs sm:text-sm leading-relaxed line-clamp-4" x-show="activeBarber.description" x-text="activeBarber.description"></p>
                        <p class="text-zinc-400 text-xs italic" x-show="!activeBarber.description">Sin descripción.</p>
                    </div>
                    <a :href="activeBarber.booksy || '#'" target="_blank" rel="noopener"
                       x-on:click="if (!activeBarber.booksy) { $event.preventDefault(); $dispatch('open-booksy') }"
                       class="mt-4 inline-flex items-center justify-center gap-1.5 bg-red-800 hover:bg-red-700 text-white text-[10px] tracking-widest uppercase px-4 py-2.5 rounded transition-colors btn-press">
                        <svg class="w-3 h-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        Reservar cita
                    </a>
                </div>
            </div>

            {{-- Carrusel de trabajos --}}
            <template x-if="activeBarber.gallery && activeBarber.gallery.length > 0">
                <div class="border-t border-zinc-800"
                     x-data="{ scroll(dir){ $refs.bCarousel.scrollBy({ left: dir * 148, behavior: 'smooth' }) } }">
                    <div class="flex items-center justify-between px-4 pt-3 pb-2">
                        <p class="text-[9px] tracking-[0.4em] uppercase text-zinc-400">Trabajos recientes</p>
                        <div class="flex gap-1">
                            <button type="button" x-on:click="scroll(-1)"
                                class="w-6 h-6 flex items-center justify-center rounded-full border border-zinc-700 hover:border-zinc-500 text-zinc-500 hover:text-white transition-all">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                            </button>
                            <button type="button" x-on:click="scroll(1)"
                                class="w-6 h-6 flex items-center justify-center rounded-full border border-zinc-700 hover:border-zinc-500 text-zinc-500 hover:text-white transition-all">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </button>
                        </div>
                    </div>
                    <div class="flex gap-2 overflow-x-auto pb-4 px-4"
                         x-ref="bCarousel"
                         style="scrollbar-width:none;-webkit-overflow-scrolling:touch;scroll-snap-type:x mandatory">
                        <template x-for="(photo, idx) in activeBarber.gallery" :key="idx">
                            <div class="flex-none w-32 h-32 sm:w-36 sm:h-36 rounded-lg overflow-hidden bg-zinc-800"
                                 style="scroll-snap-align:start">
                                <img :src="photo.img" :alt="photo.title || activeBarber.name"
                                     class="w-full h-full object-cover" loading="lazy">
                            </div>
                        </template>
                    </div>
                </div>
            </template>
        </div>
    </template>
</div>

{{-- Galería lightbox --}}
<div x-show="galOpen"
     x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-50 bg-black/97 flex items-center justify-center"
     x-on:touchstart="swipeStart($event)"
     x-on:touchend="swipeEnd($event)"
     style="display:none">

    <button type="button" x-on:click="closeGal()"
        class="absolute top-4 right-4 z-10 w-10 h-10 flex items-center justify-center rounded-full bg-zinc-800/90 hover:bg-zinc-700 border border-zinc-700 text-white transition-all"
        aria-label="Cerrar galería">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
    </button>

    <div class="absolute top-4 left-1/2 -translate-x-1/2 text-xs text-zinc-500 tracking-widest" x-text="`${galIdx + 1} / ${galImages.length}`"></div>

    <button type="button" x-on:click="prevGal()"
        class="absolute left-3 sm:left-5 top-1/2 -translate-y-1/2 z-10 w-10 h-10 sm:w-12 sm:h-12 flex items-center justify-center rounded-full bg-zinc-800/80 hover:bg-zinc-700 border border-zinc-700 text-white transition-all"
        aria-label="Anterior">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
    </button>

    <button type="button" x-on:click="nextGal()"
        class="absolute right-3 sm:right-5 top-1/2 -translate-y-1/2 z-10 w-10 h-10 sm:w-12 sm:h-12 flex items-center justify-center rounded-full bg-zinc-800/80 hover:bg-zinc-700 border border-zinc-700 text-white transition-all"
        aria-label="Siguiente">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    </button>

    <div class="w-full h-full flex flex-col items-center justify-center px-16 sm:px-20 py-14">
        <template x-if="galImages.length > 0 && galImages[galIdx]">
            <div class="flex flex-col items-center gap-3 w-full">
                <img :src="galImages[galIdx].img"
                     :alt="galImages[galIdx].title || 'Barbería Leyenda Getafe'"
                     class="max-h-[78vh] max-w-full object-contain rounded select-none"
                     draggable="false"
                     loading="lazy">
                <div class="text-center" x-show="galImages[galIdx].title || galImages[galIdx].barber">
                    <p class="text-white text-sm font-medium" x-show="galImages[galIdx].title" x-text="galImages[galIdx].title"></p>
                    <p class="text-zinc-500 text-xs tracking-widest uppercase mt-0.5" x-show="galImages[galIdx].barber" x-text="galImages[galIdx].barber"></p>
                </div>
            </div>
        </template>
    </div>
</div>


{{-- ===== FAQ BARBERÍA ===== --}}
<section class="py-20 px-4 border-t border-zinc-900" itemscope itemtype="https://schema.org/FAQPage">
    <div class="max-w-3xl mx-auto">
        <div class="text-center mb-12">
            <span class="text-[10px] tracking-[0.5em] uppercase text-red-800 block mb-3">Preguntas frecuentes</span>
            <h2 class="text-2xl sm:text-3xl font-bold text-white tracking-tight">FAQ — Barbería en Getafe</h2>
            <p class="text-zinc-500 text-sm mt-3">Todo lo que necesitas saber antes de tu visita</p>
        </div>
        <div class="space-y-3">
            @foreach($faqs as $faq)
            <div x-data="{ open: false }" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question"
                 class="border border-zinc-800 rounded-lg overflow-hidden bg-zinc-950/50">
                <button @click="open = !open" class="w-full flex items-center justify-between gap-4 px-6 py-4 text-left hover:bg-zinc-900/60 transition-colors">
                    <h3 itemprop="name" class="text-sm font-medium text-white tracking-wide">{{ $faq->question }}</h3>
                    <svg :class="{ 'rotate-180': open }" class="w-4 h-4 text-red-700 flex-shrink-0 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-1"
                     itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" class="px-6 pb-5 border-t border-zinc-800/50">
                    <p itemprop="text" class="text-zinc-400 text-sm leading-relaxed pt-4">{{ $faq->answer }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

</div>{{-- /alpine wrapper --}}
@endsection
