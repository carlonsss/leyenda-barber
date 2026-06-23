@extends('layouts.app')

@section('title', 'Leyenda Barber & Tattoo | Barbería y Tatuajes en Getafe y Madrid')
@section('meta_description', 'Barbería premium, estudio de tatuajes y ropa propia en Getafe y Madrid. Cortes, degradados, realismo, blackwork y fine line. Reserva tu cita online.')

@section('content')
@php
    $img = fn($path) => $path ? (str_starts_with($path, 'http') ? $path : asset('storage/' . $path)) : null;
    $s   = fn(string $key, string $default = '') => \App\Models\SiteSetting::get($key, $default);

    $heroImg = $s('home_hero_image') ? asset('storage/' . $s('home_hero_image')) : '/images/hero-bg.jpg';
@endphp

{{-- ═══ HERO ═══ --}}
<section class="relative min-h-[92vh] flex items-center justify-center overflow-hidden">
    {{-- Background --}}
    <div class="absolute inset-0">
        <img src="{{ $heroImg }}" alt="Leyenda Barber & Tattoo — Barbería y Tatuajes en Getafe y Madrid" class="w-full h-full object-cover object-center" loading="eager" fetchpriority="high">
        <div class="absolute inset-0 bg-black/50"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-black/40 via-transparent to-black/80"></div>
    </div>

    {{-- Título principal --}}
    <div class="relative z-10 flex flex-col items-center text-center px-4">
        <h1 class="font-heading text-[15vw] sm:text-[12vw] md:text-[9.5vw] lg:text-[8vw] leading-none text-white select-none drop-shadow-2xl">LEYENDA</h1>
        <div class="flex items-center gap-3 sm:gap-4 mt-3">
            <div class="h-px w-8 sm:w-12 bg-red-700"></div>
            <span class="text-[9px] sm:text-[10px] tracking-[0.35em] uppercase text-zinc-400">Barber &amp; Tattoo · Getafe</span>
            <div class="h-px w-8 sm:w-12 bg-red-700"></div>
        </div>
        <p class="text-zinc-300 text-base sm:text-lg font-light tracking-wide mt-4 max-w-sm" style="font-family:var(--font-sans)">Arte, precisión y estilo bajo un mismo techo</p>
    </div>
</section>

{{-- ═══ BRAND — MÁS QUE UNA BARBERÍA (SEO) ═══ --}}
<section class="bg-zinc-900 border-y border-zinc-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-16 sm:py-20">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 md:gap-16 items-center">
            <div data-reveal>
                <span class="text-[10px] tracking-[0.5em] uppercase text-zinc-400">Barbería · Tatuajes · Ropa · Getafe</span>
                <h2 class="font-heading text-4xl sm:text-5xl md:text-6xl text-white mt-2 leading-tight">{!! nl2br(e($s('home_brand_title', "MÁS QUE\nUNA BARBERÍA"))) !!}</h2>
                <div class="h-0.5 w-12 bg-red-800 mt-5 mb-6" data-line></div>
                @if($s('home_brand_description'))
                <p class="text-zinc-300 text-sm sm:text-base leading-relaxed">{{ $s('home_brand_description') }}</p>
                @endif
                @if($s('home_brand_description2'))
                <p class="text-zinc-400 text-sm leading-relaxed mt-4">{{ $s('home_brand_description2') }}</p>
                @endif

                {{-- Estadísticas --}}
                <div class="flex flex-wrap gap-4 sm:gap-6 mt-8">
                    <div class="text-center">
                        <span class="font-heading text-3xl sm:text-4xl text-red-700" data-counter="{{ $s('home_stats_clients', '+500') }}">{{ $s('home_stats_clients', '+500') }}</span>
                        <p class="text-xs tracking-widest uppercase text-zinc-400 mt-0.5">Clientes</p>
                    </div>
                    <div class="w-px bg-zinc-800 self-stretch hidden sm:block"></div>
                    <div class="text-center">
                        <span class="font-heading text-3xl sm:text-4xl text-red-700" data-counter="{{ $s('home_stats_artists', '4') }}">{{ $s('home_stats_artists', '4') }}</span>
                        <p class="text-xs tracking-widest uppercase text-zinc-400 mt-0.5">Artistas</p>
                    </div>
                    <div class="w-px bg-zinc-800 self-stretch hidden sm:block"></div>
                    <div class="text-center">
                        <span class="font-heading text-3xl sm:text-4xl text-red-700" data-counter="{{ $s('home_stats_experience', '+10') }}">{{ $s('home_stats_experience', '+10') }}</span>
                        <p class="text-xs tracking-widest uppercase text-zinc-400 mt-0.5">Años exp.</p>
                    </div>
                </div>

                {{-- Links rápidos SEO-friendly --}}
                <div class="flex flex-wrap gap-2 mt-7">
                    <a href="{{ route('barberia') }}" class="text-xs tracking-widest uppercase text-zinc-500 hover:text-red-600 border border-zinc-800 hover:border-red-900 px-3 py-1.5 rounded transition-all duration-200">Barbería en Getafe</a>
                    <a href="{{ route('tatuajes') }}" class="text-xs tracking-widest uppercase text-zinc-500 hover:text-amber-600 border border-zinc-800 hover:border-amber-900 px-3 py-1.5 rounded transition-all duration-200">Estudio de Tatuajes</a>
                    <a href="{{ route('tienda') }}" class="text-xs tracking-widest uppercase text-zinc-500 hover:text-white border border-zinc-800 hover:border-zinc-600 px-3 py-1.5 rounded transition-all duration-200">Ropa Leyenda</a>
                </div>
            </div>

            @php
                $brandImg = $s('home_brand_photo1') ? $img($s('home_brand_photo1')) : $img($services->first()?->image);
            @endphp
            <div class="relative" data-reveal>
                <div class="aspect-[3/4] max-h-[480px] w-full bg-zinc-800 rounded-xl overflow-hidden shadow-2xl">
                    @if($brandImg)
                        <img src="{{ $brandImg }}" alt="Leyenda Barber & Tattoo — Getafe" class="w-full h-full object-cover" loading="lazy">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-zinc-700 to-zinc-900 flex items-end p-6">
                            <span class="font-heading text-3xl text-white/30">LEYENDA</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══ TRES PANELES ═══ --}}
<div class="grid grid-cols-1 sm:grid-cols-3 border-t border-zinc-900">

    {{-- Panel Barbería --}}
    <div class="group relative overflow-hidden border-b sm:border-b-0 sm:border-r border-zinc-900" style="min-height:50vh">
        <div class="absolute inset-0 bg-zinc-900/90 group-hover:bg-zinc-900/70 transition-colors duration-500"></div>
        <div class="absolute inset-0 opacity-[0.04]" style="background-image:linear-gradient(rgba(255,255,255,.12) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,.12) 1px,transparent 1px);background-size:40px 40px"></div>
        <div class="relative z-10 h-full flex flex-col justify-end p-6 sm:p-8 md:p-10">
            <span class="text-[9px] tracking-[0.4em] uppercase text-zinc-500 mb-2">01</span>
            <h2 class="font-heading text-4xl sm:text-4xl md:text-5xl lg:text-6xl text-white leading-none drop-shadow-lg">BARBERÍA</h2>
            <p class="text-sm text-zinc-400 mt-2 mb-5 max-w-xs leading-relaxed">Cortes precisos, degradados y arreglo de barba en Getafe.</p>
            <div class="flex flex-wrap items-center gap-3">
                <a href="https://booksy.com/es-es/105117_leyenda-barberia_barberia_52975_getafe#ba_s=sr_1" target="_blank" rel="noopener"
                   class="flex items-center gap-2 bg-red-800 hover:bg-red-700 text-white text-xs tracking-widest uppercase px-4 py-2.5 rounded transition-colors duration-200 font-medium btn-press">
                    Reservar cita
                </a>
                <a href="{{ route('barberia') }}" class="flex items-center gap-2 text-zinc-400 hover:text-white text-xs tracking-widest uppercase transition-all duration-300 hover:gap-4">
                    <span>Ver servicios</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 h-0.5 bg-red-800 w-0 group-hover:w-full transition-all duration-500"></div>
    </div>

    {{-- Panel Tatuajes --}}
    <div class="group relative overflow-hidden border-b sm:border-b-0 sm:border-r border-zinc-900" style="min-height:50vh">
        <div class="absolute inset-0 bg-black/90 group-hover:bg-black/70 transition-colors duration-500"></div>
        <div class="absolute inset-0 opacity-[0.04]" style="background-image:radial-gradient(circle,rgba(255,255,255,.15) 1px,transparent 1px);background-size:32px 32px"></div>
        <div class="relative z-10 h-full flex flex-col justify-end p-6 sm:p-8 md:p-10">
            <span class="text-[9px] tracking-[0.4em] uppercase text-zinc-500 mb-2">02</span>
            <h2 class="font-heading text-4xl sm:text-4xl md:text-5xl lg:text-6xl text-white leading-none drop-shadow-lg">TATUAJES</h2>
            <p class="text-sm text-zinc-400 mt-2 mb-5 max-w-xs leading-relaxed">Arte permanente y diseño personalizado. Tu idea, nuestra firma.</p>
            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('tatuajes') }}#solicitar"
                   class="flex items-center gap-2 bg-amber-700 hover:bg-amber-600 text-white text-xs tracking-widest uppercase px-4 py-2.5 rounded transition-colors duration-200 font-medium btn-press">
                    Enviar propuesta
                </a>
                <a href="{{ route('tatuajes') }}" class="flex items-center gap-2 text-zinc-400 hover:text-white text-xs tracking-widest uppercase transition-all duration-300 hover:gap-4">
                    <span>Ver galería</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 h-0.5 bg-amber-600 w-0 group-hover:w-full transition-all duration-500"></div>
    </div>

    {{-- Panel Ropa --}}
    <div class="group relative overflow-hidden" style="min-height:50vh">
        <div class="absolute inset-0 bg-zinc-950/90 group-hover:bg-zinc-950/70 transition-colors duration-500"></div>
        <div class="absolute inset-0 opacity-[0.04]" style="background-image:linear-gradient(45deg,rgba(255,255,255,.08) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.08) 50%,rgba(255,255,255,.08) 75%,transparent 75%);background-size:20px 20px"></div>
        <div class="relative z-10 h-full flex flex-col justify-end p-6 sm:p-8 md:p-10">
            <span class="text-[9px] tracking-[0.4em] uppercase text-zinc-500 mb-2">03</span>
            <h2 class="font-heading text-4xl sm:text-4xl md:text-5xl lg:text-6xl text-white leading-none drop-shadow-lg">ROPA</h2>
            <p class="text-sm text-zinc-400 mt-2 mb-5 max-w-xs leading-relaxed">Colección propia Leyenda. Estilo urbano con identidad propia.</p>
            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('tienda') }}"
                   class="flex items-center gap-2 bg-zinc-700 hover:bg-zinc-600 text-white text-xs tracking-widest uppercase px-4 py-2.5 rounded transition-colors duration-200 font-medium btn-press">
                    Ver colección
                </a>
                <a href="{{ route('tienda') }}" class="flex items-center gap-2 text-zinc-400 hover:text-white text-xs tracking-widest uppercase transition-all duration-300 hover:gap-4">
                    <span>Explorar tienda</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 h-0.5 bg-zinc-500 w-0 group-hover:w-full transition-all duration-500"></div>
    </div>
</div>

{{-- ═══ SERVICIOS DESTACADOS ═══ --}}
@if($services->count() > 0)
<section class="bg-black border-b border-zinc-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-12 sm:py-16">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8 sm:mb-10" data-reveal>
            <div>
                <span class="text-[10px] tracking-[0.5em] uppercase text-zinc-400">Barbería · Getafe</span>
                <h2 class="font-heading text-4xl sm:text-5xl text-white mt-1 leading-none">SERVICIOS DESTACADOS</h2>
            </div>
            <a href="{{ route('barberia') }}" class="flex items-center gap-2 text-xs tracking-widest uppercase text-zinc-400 hover:text-red-600 transition-colors self-start sm:self-auto">
                Ver todos los servicios
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
        <div class="flex gap-4 overflow-x-auto pb-2 sm:grid sm:grid-cols-4 sm:overflow-visible sm:pb-0 snap-x snap-mandatory scrollbar-hide" data-reveal>
            @foreach($services as $service)
            @php $sImg = $img($service->image); @endphp
            <div class="flex flex-col gap-2.5 group flex-shrink-0 w-[70vw] sm:w-auto snap-start">
                <div class="aspect-square rounded overflow-hidden bg-zinc-900 border border-zinc-800 group-hover:border-red-900/50 transition-all duration-300">
                    @if($sImg)
                        <img src="{{ $sImg }}" alt="{{ $service->name }} — Barbería Leyenda Getafe" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-zinc-800 to-zinc-900">
                            <svg class="w-8 h-8 text-zinc-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M14.121 14.121L19 19m-7-7l7-7m-7 7l-2.879 2.879M12 12L9.121 9.121m0 5.758a3 3 0 10-4.243-4.243 3 3 0 004.243 4.243z"/></svg>
                        </div>
                    @endif
                </div>
                <div class="px-0.5">
                    <div class="flex items-start justify-between gap-1">
                        <span class="text-xs sm:text-sm font-medium text-white leading-tight">{{ $service->name }}</span>
                        <span class="text-sm text-red-600 font-heading flex-shrink-0">{{ number_format($service->price, 0) }}€</span>
                    </div>
                    @if($service->duration)
                    <span class="text-[10px] text-zinc-400">{{ $service->duration }} min</span>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-10">
            <a href="{{ route('barberia') }}" class="inline-flex items-center gap-2 border border-zinc-800 hover:border-red-800 text-zinc-500 hover:text-red-600 text-xs tracking-widest uppercase px-6 py-3 rounded transition-all duration-200">
                Ver todos los servicios y precios
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
    </div>
</section>
@endif

{{-- ═══ TATTOO STUDIO ═══ --}}
@if($works->count() > 0)
<section class="bg-zinc-950 border-t border-zinc-900 py-16 sm:py-24"
    x-data="{
        lightbox: false,
        activeImg: '',
        activeTitle: '',
        activeStyle: '',
        open(img, title, style) {
            this.activeImg = img;
            this.activeTitle = title;
            this.activeStyle = style;
            this.lightbox = true;
            document.body.style.overflow = 'hidden';
        },
        close() {
            this.lightbox = false;
            document.body.style.overflow = '';
        },
        scrollLeft() { this.$refs.tattooCarousel.scrollBy({ left: -280, behavior: 'smooth' }); },
        scrollRight() { this.$refs.tattooCarousel.scrollBy({ left: 280, behavior: 'smooth' }); }
    }"
    x-on:keydown.escape.window="close()">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">

        {{-- Header + Intro --}}
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10 sm:mb-14" data-reveal>
            <div class="max-w-xl">
                <span class="text-[10px] tracking-[0.5em] uppercase text-zinc-400">Estudio de tatuajes · Getafe</span>
                <h2 class="font-heading text-4xl sm:text-5xl md:text-6xl text-white mt-1 leading-none">TATTOO STUDIO</h2>
                <div class="h-0.5 w-10 bg-amber-700 mt-4 mb-4"></div>
                <p class="text-zinc-400 text-sm sm:text-base leading-relaxed">
                    Nuestro estudio de tatuajes en Getafe trabaja realismo, blackwork, fine line y diseño personalizado. Cada pieza es única, con los más altos estándares de higiene, técnica y arte.
                </p>
            </div>
            <a href="{{ route('tatuajes') }}" class="flex items-center gap-2 text-xs tracking-widest uppercase text-zinc-400 hover:text-amber-500 transition-colors self-start md:self-auto flex-shrink-0">
                Ver galería completa
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>

        {{-- Carrusel con lightbox --}}
        <div class="relative" data-reveal>
            <button type="button" x-on:click="scrollLeft()"
                class="absolute left-0 top-[40%] -translate-y-1/2 -translate-x-1 sm:-translate-x-4 z-10 w-9 h-9 sm:w-10 sm:h-10 flex items-center justify-center rounded-full bg-zinc-900 border border-zinc-700 hover:border-zinc-500 hover:bg-zinc-800 text-zinc-400 hover:text-white transition-all duration-200 shadow-xl"
                aria-label="Anterior">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </button>
            <button type="button" x-on:click="scrollRight()"
                class="absolute right-0 top-[40%] -translate-y-1/2 translate-x-1 sm:translate-x-4 z-10 w-9 h-9 sm:w-10 sm:h-10 flex items-center justify-center rounded-full bg-zinc-900 border border-zinc-700 hover:border-zinc-500 hover:bg-zinc-800 text-zinc-400 hover:text-white transition-all duration-200 shadow-xl"
                aria-label="Siguiente">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </button>

            <div class="product-scroll pb-2 px-1" x-ref="tattooCarousel" data-swipe-carousel>
                @foreach($works as $work)
                @php $wImg = $img($work->image); @endphp
                <div class="flex-none w-48 sm:w-56 md:w-64 group">
                    <button type="button"
                        class="block w-full"
                        @if($wImg) x-on:click="open('{{ $wImg }}', '{{ addslashes($work->title) }}', '{{ addslashes($work->style?->name ?? '') }}')" @endif
                        aria-label="Ver {{ $work->title }}">
                        <div class="aspect-[3/4] bg-zinc-900 rounded overflow-hidden mb-3 border border-zinc-800 group-hover:border-amber-800/50 transition-all duration-300 relative">
                            @if($wImg)
                                <img src="{{ $wImg }}" alt="{{ $work->title }} — Tatuaje Getafe Leyenda" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy">
                                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/40 transition-colors duration-300 flex items-center justify-center">
                                    <svg class="w-7 h-7 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                                </div>
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-zinc-800 to-zinc-900">
                                    <svg class="w-8 h-8 text-zinc-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </div>
                            @endif
                        </div>
                        <h3 class="text-sm font-medium text-white group-hover:text-zinc-300 transition-colors truncate text-left">{{ $work->title }}</h3>
                        @if($work->style)
                        <p class="text-xs text-amber-600 mt-0.5 tracking-widest uppercase">{{ $work->style->name }}</p>
                        @endif
                    </button>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Lightbox overlay --}}
    <div
        x-show="lightbox"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 bg-black/95 backdrop-blur-sm flex items-center justify-center p-4 sm:p-8"
        x-on:click.self="close()"
        style="display:none">

        {{-- Botón cerrar --}}
        <button
            type="button"
            x-on:click="close()"
            class="absolute top-4 right-4 sm:top-5 sm:right-5 z-10 w-10 h-10 flex items-center justify-center rounded-full bg-zinc-800/90 hover:bg-zinc-700 border border-zinc-700 text-white transition-all duration-200"
            aria-label="Cerrar galería">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>

        <div class="max-w-3xl w-full" x-on:click.stop>
            <img :src="activeImg" :alt="activeTitle" class="w-full max-h-[82vh] object-contain rounded" loading="lazy">
            <div class="mt-4 text-center" x-show="activeTitle">
                <p class="text-white font-medium text-sm tracking-wide" x-text="activeTitle"></p>
                <p class="text-amber-500 text-xs tracking-widest uppercase mt-1" x-show="activeStyle" x-text="activeStyle"></p>
            </div>
        </div>
    </div>
</section>
@endif

{{-- ═══ TIENDA / COLECCIÓN ═══ --}}
@if($products->count() > 0)
<section class="max-w-7xl mx-auto px-4 sm:px-6 py-16 sm:py-24"
    x-data="{
        scrollLeft() { this.$refs.carousel.scrollBy({ left: -280, behavior: 'smooth' }); },
        scrollRight() { this.$refs.carousel.scrollBy({ left: 280, behavior: 'smooth' }); }
    }">
    <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8 sm:mb-10" data-reveal>
        <div>
            <span class="text-[10px] tracking-[0.5em] uppercase text-zinc-400">Colección propia · Leyenda</span>
            <h2 class="section-title font-heading text-4xl sm:text-5xl md:text-6xl text-white mt-1">LA TIENDA</h2>
            <p class="text-zinc-500 text-sm mt-1">Estilo urbano con identidad propia.</p>
        </div>
        <a href="{{ route('tienda') }}" class="flex items-center gap-2 text-xs tracking-widest uppercase text-zinc-400 hover:text-white transition-colors self-start sm:self-auto">
            Ver colección completa
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
        </a>
    </div>

    <div class="relative" data-reveal>
        {{-- Flecha izquierda --}}
        <button
            type="button"
            x-on:click="scrollLeft()"
            class="absolute left-0 top-[40%] -translate-y-1/2 -translate-x-1 sm:-translate-x-4 z-10 w-9 h-9 sm:w-10 sm:h-10 flex items-center justify-center rounded-full bg-zinc-900 border border-zinc-700 hover:border-zinc-500 hover:bg-zinc-800 text-zinc-400 hover:text-white transition-all duration-200 shadow-xl"
            aria-label="Producto anterior">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </button>
        {{-- Flecha derecha --}}
        <button
            type="button"
            x-on:click="scrollRight()"
            class="absolute right-0 top-[40%] -translate-y-1/2 translate-x-1 sm:translate-x-4 z-10 w-9 h-9 sm:w-10 sm:h-10 flex items-center justify-center rounded-full bg-zinc-900 border border-zinc-700 hover:border-zinc-500 hover:bg-zinc-800 text-zinc-400 hover:text-white transition-all duration-200 shadow-xl"
            aria-label="Producto siguiente">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </button>

        <div class="product-scroll pb-2 px-1" x-ref="carousel" data-swipe-carousel>
            @foreach($products as $product)
            @php $pImages = $product->images ?? []; $pImg = $img($pImages[0] ?? null); @endphp
            <div class="flex-none w-48 sm:w-56 md:w-64 group">
                <a href="{{ route('tienda.show', $product) }}" class="block">
                    <div class="aspect-[3/4] bg-zinc-900 rounded overflow-hidden mb-3 border border-zinc-800 group-hover:border-zinc-600 transition-all duration-300">
                        @if($pImg)
                            <img src="{{ $pImg }}" alt="{{ $product->name }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-zinc-800 to-zinc-900">
                                <svg class="w-8 h-8 text-zinc-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                            </div>
                        @endif
                    </div>
                    <h3 class="text-sm font-medium text-white group-hover:text-zinc-300 transition-colors truncate">{{ $product->name }}</h3>
                    <p class="text-base text-red-600 mt-0.5 font-heading">{{ number_format($product->price, 2) }}€</p>
                </a>
                <button x-on:click="$store.cart.add({{ $product->id }}, null)"
                    class="mt-2 w-full border border-zinc-700 hover:border-red-800 hover:bg-red-800/10 text-zinc-400 hover:text-white text-xs tracking-widest uppercase py-2.5 transition-all duration-200 rounded">
                    Añadir al carrito
                </button>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ═══ CTA DOBLE ═══ --}}
<section class="grid grid-cols-1 sm:grid-cols-2">

    {{-- Barbería --}}
    <div class="relative aspect-square sm:aspect-auto sm:min-h-[420px] overflow-hidden bg-zinc-900 group">
        <div class="absolute inset-0 bg-gradient-to-br from-red-950/60 via-zinc-900 to-black"></div>
        <div class="absolute inset-0 opacity-[0.05]" style="background-image:linear-gradient(rgba(255,255,255,.1) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,.1) 1px,transparent 1px);background-size:40px 40px"></div>
        <div class="relative z-10 flex flex-col h-full justify-between p-8 sm:p-10 md:p-14" data-reveal>
            <span class="text-[9px] tracking-[0.5em] uppercase text-red-800">Barbería · Leyenda Getafe</span>
            <div>
                <h3 class="font-heading text-4xl sm:text-5xl md:text-6xl text-white leading-tight">¿LISTO PARA<br>TU PRÓXIMO<br>CORTE?</h3>
                <p class="text-zinc-400 text-sm mt-3 mb-7 max-w-xs">Reserva tu cita online en segundos, sin esperas ni llamadas.</p>
                <div class="flex flex-col gap-3">
                    <a href="https://booksy.com/es-es/105117_leyenda-barberia_barberia_52975_getafe#ba_s=sr_1" target="_blank" rel="noopener"
                       class="inline-flex items-center justify-center gap-2 bg-red-800 hover:bg-red-700 text-white text-xs tracking-widest uppercase px-6 py-3.5 rounded transition-colors w-full sm:w-auto btn-press">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        Reservar en Booksy
                    </a>
                    <a href="{{ route('barberia') }}" class="inline-flex items-center justify-center gap-2 border border-zinc-700 hover:border-zinc-500 text-zinc-400 hover:text-white text-xs tracking-widest uppercase px-6 py-3.5 rounded transition-colors w-full sm:w-auto btn-press">
                        Ver servicios y precios
                    </a>
                </div>
            </div>
        </div>
        <div class="absolute top-0 left-0 w-1 h-full bg-red-800 opacity-60"></div>
    </div>

    {{-- Tatuajes --}}
    <div class="relative aspect-square sm:aspect-auto sm:min-h-[420px] overflow-hidden bg-black group border-t sm:border-t-0 sm:border-l border-zinc-800">
        <div class="absolute inset-0 bg-gradient-to-br from-amber-950/40 via-zinc-950 to-black"></div>
        <div class="absolute inset-0 opacity-[0.05]" style="background-image:radial-gradient(circle,rgba(255,255,255,.15) 1px,transparent 1px);background-size:28px 28px"></div>
        <div class="relative z-10 flex flex-col h-full justify-between p-8 sm:p-10 md:p-14" data-reveal>
            <span class="text-[9px] tracking-[0.5em] uppercase text-amber-800">Tattoo Studio · Leyenda Getafe</span>
            <div>
                <h3 class="font-heading text-4xl sm:text-5xl md:text-6xl text-white leading-tight">¿LISTO PARA<br>TU PRÓXIMO<br>TATUAJE?</h3>
                <p class="text-zinc-400 text-sm mt-3 mb-7 max-w-xs">Cuéntanos tu idea y la hacemos realidad en menos de 48h.</p>
                <div class="flex flex-col gap-3">
                    <a href="{{ route('tatuajes') }}#solicitar"
                       class="inline-flex items-center justify-center gap-2 bg-amber-700 hover:bg-amber-600 text-white text-xs tracking-widest uppercase px-6 py-3.5 rounded transition-colors w-full sm:w-auto btn-press">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        Enviar propuesta
                    </a>
                    <a href="{{ route('tatuajes') }}" class="inline-flex items-center justify-center gap-2 border border-zinc-700 hover:border-amber-700/50 text-zinc-400 hover:text-amber-600 text-xs tracking-widest uppercase px-6 py-3.5 rounded transition-colors w-full sm:w-auto btn-press">
                        Ver galería de trabajos
                    </a>
                </div>
            </div>
        </div>
        <div class="absolute top-0 left-0 w-1 h-full bg-amber-700 opacity-60"></div>
    </div>
</section>

@endsection
