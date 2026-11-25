@extends('layouts.app')

@section('title', 'Estudio de Tatuajes en Getafe y Madrid — Leyenda Tattoo | Realismo, Blackwork, Fine Line')
@section('meta_description', 'Estudio de tatuajes en Getafe y Madrid. Especialistas en realismo, blackwork, fine line y diseño personalizado. Pídenos cita por WhatsApp. Leyenda Barber & Tattoo.')

@section('content')
@php
    $img  = fn($path) => $path ? (str_starts_with($path, 'http') ? $path : asset('storage/' . $path)) : null;
    $s    = fn(string $key, string $default = '') => \App\Models\SiteSetting::get($key, $default);

    $heroSetting = \App\Models\SiteSetting::get('tatuajes_hero_image');
    $heroUrl     = $heroSetting ? asset('storage/' . $heroSetting) : '/images/tatuajes-hero.jpg';
    $branches    = \App\Models\SiteSetting::branches();
    $waText      = 'Hola%2C%20he%20visto%20vuestra%20web%20y%20me%20gustar%C3%ADa%20pedir%20informaci%C3%B3n%20sobre%20un%20tatuaje.';

    $worksData = $works->map(fn($w) => [
        'id'       => $w->id,
        'style_id' => $w->tattoo_style_id,
        'title'    => $w->title ?? '',
        'image'    => $img($w->image),
        'style'    => $w->style?->name ?? '',
    ])->filter(fn($w) => $w['image'])->values();
@endphp

<script id="lb-works" type="application/json">@json($worksData)</script>

{{-- ═══ WRAPPER Alpine ═══ --}}
<div
    x-data="{
        allWorks: JSON.parse(document.getElementById('lb-works').textContent),
        activeStyle: null,

        get filtered() {
            return this.activeStyle
                ? this.allWorks.filter(w => w.style_id === this.activeStyle)
                : this.allWorks;
        },

        setStyle(id) {
            this.activeStyle = this.activeStyle === id ? null : id;
            this.$nextTick(() => {
                if (this.$refs.portfolioCarousel) this.$refs.portfolioCarousel.scrollLeft = 0;
            });
        },

        scrollPortfolio(dir) {
            if (this.$refs.portfolioCarousel) this.$refs.portfolioCarousel.scrollBy({ left: dir * 260, behavior: 'smooth' });
        },

        lbOpen: false,
        lbIdx: 0,
        openLb(idx) { this.lbIdx = idx; this.lbOpen = true; document.body.style.overflow = 'hidden'; },
        closeLb() { this.lbOpen = false; document.body.style.overflow = ''; },
        prevLb() { this.lbIdx = this.lbIdx > 0 ? this.lbIdx - 1 : this.filtered.length - 1; },
        nextLb() { this.lbIdx = this.lbIdx < this.filtered.length - 1 ? this.lbIdx + 1 : 0; },
        swipeX: 0,
        swipeStart(e) { this.swipeX = e.touches[0].clientX; },
        swipeEnd(e) {
            const d = this.swipeX - e.changedTouches[0].clientX;
            if (Math.abs(d) > 45) { d > 0 ? this.nextLb() : this.prevLb(); }
        },

        artistOpen: false,
        openArtist(i) { this.artistOpen = i; document.body.style.overflow = 'hidden'; },
        closeArtist() { this.artistOpen = false; document.body.style.overflow = ''; }
    }"
    x-on:keydown.escape.window="closeLb(); closeArtist()"
>

{{-- ═══ HERO ═══ --}}
<section class="relative min-h-[78vh] sm:min-h-[88vh] flex items-end overflow-hidden">
    <div class="absolute inset-0">
        <img src="{{ $heroUrl }}" alt="Estudio de Tatuajes en Getafe — Leyenda Tattoo" class="w-full h-full object-cover object-center" loading="eager" fetchpriority="high">
        <div class="absolute inset-0 bg-black/60"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/20 to-transparent"></div>
    </div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 pb-12 sm:pb-16 pt-32 w-full">
        <h1 class="font-heading text-[16vw] sm:text-[12vw] md:text-[9vw] leading-none text-white drop-shadow-2xl">TATUAJES</h1>
        <span class="text-[10px] tracking-[0.5em] uppercase text-zinc-400 mt-3 block">Tattoo Studio · 2 Sucursales en Getafe</span>
        <div class="h-0.5 w-16 bg-amber-600 mt-4"></div>
        <div class="flex flex-col sm:flex-row sm:items-end gap-4 sm:gap-8 mt-4">
            <p class="text-zinc-300 text-sm sm:text-base max-w-md leading-relaxed">{{ $s('tatuajes_hero_description', 'Arte permanente. Diseño personalizado. Tu tatuaje, creado con precisión en nuestro estudio de Getafe.') }}</p>
            <a href="#solicitar"
               class="flex-none inline-flex items-center gap-2.5 text-white text-xs tracking-widest uppercase px-6 py-3.5 rounded transition-colors btn-press font-medium"
               style="background-color:#25D366">
                <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                Pedir cita por WhatsApp
            </a>
        </div>
    </div>
</section>

{{-- ═══ INTRO SEO ═══ --}}
<section class="bg-zinc-950 border-b border-zinc-900">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 py-12 sm:py-16 text-center" data-reveal>
        <div class="flex items-center justify-center gap-4 mb-6">
            <div class="h-px flex-1 max-w-[60px] bg-zinc-800"></div>
            <span class="text-[9px] tracking-[0.5em] uppercase text-zinc-400">Tattoo Studio · Getafe · Madrid</span>
            <div class="h-px flex-1 max-w-[60px] bg-zinc-800"></div>
        </div>
        <p class="font-heading text-2xl sm:text-3xl md:text-4xl text-white leading-snug">
            {{ $s('tatuajes_intro_heading', 'Realismo. Blackwork. Fine Line. Diseño personalizado en Getafe.') }}
        </p>
        <p class="text-zinc-500 text-sm leading-relaxed mt-5 max-w-xl mx-auto">
            {{ $s('tatuajes_intro_description', 'Nuestro estudio de tatuajes en Getafe trabaja con artistas especializados en diferentes estilos. Cada tatuaje es una pieza única, creada con los más altos estándares de higiene, técnica y arte permanente.') }}
        </p>
        <div class="flex flex-wrap items-center justify-center gap-2 mt-6">
            @foreach($styles->take(5) as $style)
            <span class="text-[10px] tracking-widest uppercase text-zinc-400 border border-zinc-800 rounded-full px-3 py-1">{{ $style->name }}</span>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══ ESTILOS ═══ --}}
@if($styles->count() > 0)
<section class="bg-zinc-900 border-b border-zinc-800 py-12 sm:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="mb-8 sm:mb-10" data-reveal>
            <span class="text-[10px] tracking-[0.5em] uppercase text-zinc-400">Especialidades</span>
            <h2 class="section-title font-heading text-3xl sm:text-4xl md:text-5xl text-white mt-1">ESTILOS</h2>
            <p class="text-zinc-500 text-sm mt-2">Selecciona un estilo para filtrar el portfolio.</p>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3 sm:gap-4" data-reveal>
            @foreach($styles as $style)
            @php $sImg = $img($style->image); @endphp
            <button
                type="button"
                class="relative overflow-hidden rounded-xl aspect-[3/4] sm:aspect-[4/5] group border transition-all duration-300 focus:outline-none focus-visible:ring-2 focus-visible:ring-amber-600 text-left"
                :class="activeStyle === {{ $style->id }} ? 'border-amber-600 ring-1 ring-amber-600/40' : 'border-zinc-800 hover:border-amber-700/50'"
                x-on:click="setStyle({{ $style->id }}); $nextTick(() => document.querySelector('#portfolio')?.scrollIntoView({behavior:'smooth', block:'start'}))"
                aria-label="Filtrar por {{ $style->name }}">
                @if($sImg)
                    <img src="{{ $sImg }}" alt="{{ $style->name }} — tatuajes Getafe" class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy">
                @else
                    <div class="absolute inset-0 bg-gradient-to-br from-zinc-800 to-zinc-900"></div>
                @endif
                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/30 to-transparent"></div>
                <div class="absolute inset-0 transition-all duration-300"
                     :class="activeStyle === {{ $style->id }} ? 'bg-amber-900/20' : ''"></div>
                <div class="absolute bottom-0 left-0 right-0 p-3">
                    <h3 class="font-heading text-base sm:text-xl text-white leading-tight">{{ $style->name }}</h3>
                    @if($style->works_count > 0)
                    <span class="text-[9px] text-zinc-500 tracking-widest uppercase">{{ $style->works_count }} trabajos</span>
                    @endif
                </div>
                <div class="absolute top-2.5 right-2.5 w-5 h-5 rounded-full border border-amber-600 bg-amber-600 flex items-center justify-center transition-all duration-200"
                     x-show="activeStyle === {{ $style->id }}">
                    <svg class="w-2.5 h-2.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                </div>
            </button>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ═══ PORTFOLIO — Carrusel ═══ --}}
@if($works->count() > 0)
<section id="portfolio" class="py-14 sm:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="flex items-end justify-between mb-8 sm:mb-10" data-reveal>
            <div>
                <span class="text-[10px] tracking-[0.5em] uppercase text-zinc-400"
                      x-text="activeStyle ? 'Estilo seleccionado' : 'Todos los estilos'"></span>
                <h2 class="section-title font-heading text-3xl sm:text-4xl md:text-5xl text-white mt-1">PORTFOLIO</h2>
                <p class="text-zinc-500 text-sm mt-1">
                    <span x-text="filtered.length"></span> trabajos · Toca para ampliar
                </p>
            </div>
            <div class="flex items-center gap-2">
                <button type="button" x-on:click="scrollPortfolio(-1)"
                    class="w-9 h-9 flex items-center justify-center rounded-full border border-zinc-700 hover:border-zinc-500 text-zinc-400 hover:text-white transition-all"
                    aria-label="Anterior">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <button type="button" x-on:click="scrollPortfolio(1)"
                    class="w-9 h-9 flex items-center justify-center rounded-full border border-zinc-700 hover:border-zinc-500 text-zinc-400 hover:text-white transition-all"
                    aria-label="Siguiente">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Carrusel full-bleed --}}
    <div class="relative" data-reveal>
        <template x-if="filtered.length === 0">
            <div class="max-w-7xl mx-auto px-4 sm:px-6">
                <div class="py-16 text-center border border-zinc-800 rounded-xl">
                    <p class="text-zinc-500 text-sm">Sin trabajos en este estilo todavía.</p>
                </div>
            </div>
        </template>

        <div class="flex gap-3 overflow-x-auto pl-4 sm:pl-[max(1.5rem,calc((100vw-80rem)/2+1.5rem))] pr-4 pb-2"
             x-ref="portfolioCarousel"
             x-show="filtered.length > 0"
             style="scrollbar-width:none;-webkit-overflow-scrolling:touch;scroll-snap-type:x mandatory">
            <template x-for="(work, idx) in filtered" :key="work.id">
                <button
                    type="button"
                    class="flex-none relative overflow-hidden rounded-xl group focus:outline-none focus-visible:ring-2 focus-visible:ring-amber-600"
                    style="width:240px;scroll-snap-align:start"
                    x-on:click="openLb(idx)"
                    :aria-label="work.title || 'Ver tatuaje'">
                    <div class="overflow-hidden rounded-xl" style="height:300px">
                        <img :src="work.image" :alt="work.title || 'Tatuaje — Getafe'"
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                             loading="lazy">
                    </div>
                    <div class="absolute inset-0 rounded-xl bg-black/0 group-hover:bg-black/55 transition-colors duration-300 flex items-end pointer-events-none">
                        <div class="p-3 w-full translate-y-2 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300">
                            <p class="text-sm font-medium text-white leading-tight truncate" x-text="work.title"></p>
                            <p class="text-xs text-amber-500 tracking-widest uppercase mt-0.5" x-text="work.style"></p>
                        </div>
                    </div>
                </button>
            </template>
        </div>
        <p class="text-center text-[10px] text-zinc-700 tracking-widest uppercase mt-4 px-4 sm:hidden">Desliza · Toca para ampliar</p>
    </div>
</section>
@endif

{{-- ═══ ARTISTAS ═══ --}}
@if($artists->count() > 0)
<section class="bg-zinc-950 border-t border-zinc-900 py-14 sm:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="mb-10" data-reveal>
            <span class="text-[10px] tracking-[0.5em] uppercase text-zinc-400">Tatuadores · 2 Sucursales en Getafe</span>
            <h2 class="section-title font-heading text-3xl sm:text-4xl md:text-5xl text-white mt-1">NUESTROS ARTISTAS</h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 sm:gap-6 max-w-3xl">
        @foreach($artists as $i => $artist)
        @php
            $artistName  = $artist->name;
            $artistStyle = $artist->style;
            $artistImg   = $img($artist->image);
        @endphp
        <button
            type="button"
            class="group w-full text-left border border-zinc-800 hover:border-amber-700/50 rounded-xl overflow-hidden transition-all duration-300 focus:outline-none focus-visible:ring-2 focus-visible:ring-amber-600"
            x-on:click="openArtist({{ $i }})"
            data-reveal
            aria-label="Ver perfil del artista">
            <div class="relative aspect-[4/3] overflow-hidden bg-zinc-900">
                @if($artistImg)
                    <img src="{{ $artistImg }}" alt="{{ $artistName }} — Tatuadores Getafe"
                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy">
                @else
                    <div class="w-full h-full bg-gradient-to-br from-zinc-800 to-zinc-950 flex items-center justify-center">
                        <svg class="w-16 h-16 text-zinc-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                @endif
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent pointer-events-none"></div>
                <div class="absolute top-3 right-3 w-8 h-8 rounded-full bg-black/50 border border-zinc-600 group-hover:border-amber-600 flex items-center justify-center transition-all duration-300">
                    <svg class="w-3.5 h-3.5 text-zinc-300 group-hover:text-amber-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                </div>
            </div>
            <div class="p-4 sm:p-5">
                <span class="text-[9px] tracking-[0.4em] uppercase text-amber-700">{{ isset($branches[$artist->branch - 1]) ? 'Sucursal · ' . $branches[$artist->branch - 1]['name'] : 'Ambas sucursales' }}</span>
                <h3 class="font-heading text-2xl text-white mt-0.5">{{ $artistName }}</h3>
                <p class="text-[10px] tracking-widest uppercase text-zinc-500 mt-0.5">{{ $artistStyle }}</p>
                <div class="flex items-center justify-between mt-3 pt-3 border-t border-zinc-800">
                    <span class="text-[10px] tracking-widest uppercase text-zinc-500 group-hover:text-zinc-300 transition-colors">Ver perfil completo</span>
                    <svg class="w-3.5 h-3.5 text-zinc-400 group-hover:text-amber-600 group-hover:translate-x-0.5 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </div>
            </div>
        </button>
        @endforeach
        </div>
    </div>
</section>
@endif

{{-- ═══ CONTACTO — WhatsApp primario + form secundario ═══ --}}
<section id="solicitar" class="bg-black border-t border-zinc-900 py-16 sm:py-24">
    <div class="max-w-2xl mx-auto px-4 sm:px-6">

        {{-- Cabecera --}}
        <div class="text-center mb-10" data-reveal>
            <span class="text-[10px] tracking-[0.5em] uppercase text-zinc-400">Tatuajes · Getafe</span>
            <h2 class="font-heading text-4xl sm:text-5xl md:text-6xl text-white mt-2">¿TIENES UN<br>PROYECTO?</h2>
            <div class="h-0.5 w-12 bg-amber-600 mx-auto mt-4 mb-5"></div>
            <p class="text-zinc-400 text-sm leading-relaxed max-w-sm mx-auto">Cuéntanos tu idea por WhatsApp. Es la forma más rápida de que te respondamos.</p>
        </div>

        {{-- WhatsApp — CTA principal --}}
        <div class="bg-zinc-950 border border-zinc-800 rounded-xl p-6 sm:p-8 text-center mb-6" data-reveal>
            <div class="w-14 h-14 rounded-full mx-auto mb-4 flex items-center justify-center" style="background-color:#25D366">
                <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
            </div>
            <h3 class="font-heading text-2xl text-white mb-1">Escríbenos por WhatsApp</h3>
            <p class="text-zinc-500 text-sm mb-5">Elige tu sucursal · Respuesta rápida · Sin esperas</p>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                @foreach($branches as $i => $branch)
                <a href="https://wa.me/{{ $branch['whatsapp_tattoo'] }}?text={{ $waText }}"
                   target="_blank" rel="noopener"
                   class="group flex flex-col items-center justify-center text-white px-4 py-4 rounded-xl transition-all duration-200 btn-press hover:brightness-110"
                   style="background-color:#25D366">
                    <span class="text-[9px] tracking-[0.35em] uppercase text-white/75">Sucursal 0{{ $i + 1 }}</span>
                    <span class="text-sm tracking-widest uppercase font-medium mt-0.5">{{ $branch['name'] }}</span>
                    <span class="text-[11px] text-white/80 mt-0.5">{{ $branch['addr1'] }}</span>
                </a>
                @endforeach
            </div>
        </div>

        {{-- Formulario — colapsado por defecto --}}
        <div x-data="{ formOpen: false }">
            <button
                type="button"
                x-on:click="formOpen = !formOpen"
                class="w-full flex items-center justify-between text-zinc-400 hover:text-white text-xs tracking-widest uppercase py-3 border-t border-zinc-900 transition-colors">
                <span>O envía una solicitud detallada</span>
                <svg class="w-4 h-4 transition-transform duration-300" :class="formOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
            </button>

            <div x-show="formOpen"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 -translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 style="display:none">

                @if(session('success'))
                <div class="mt-4 bg-zinc-900 border border-green-800 text-green-400 text-sm px-5 py-3 rounded">{{ session('success') }}</div>
                @endif

                <div class="bg-zinc-950 border border-zinc-800 rounded-xl p-5 sm:p-6 mt-3 space-y-4">
                    <div class="border-l-2 border-amber-700 pl-4">
                        <p class="text-xs tracking-widest uppercase text-amber-700 font-medium mb-1">Importante</p>
                        <p class="text-zinc-500 text-xs leading-relaxed">Todos los tatuajes son con cita previa. No hacemos walk-in. Las sesiones requieren depósito previo.</p>
                    </div>

                    <form action="{{ route('tatuajes.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs tracking-widest uppercase text-zinc-400 mb-1.5">Nombre *</label>
                                <input type="text" name="name" required value="{{ old('name') }}" placeholder="Tu nombre"
                                    class="w-full bg-zinc-900 border @error('name') border-red-700 @else border-zinc-800 @enderror text-white text-sm px-4 py-2.5 rounded focus:outline-none focus:border-amber-600 transition-colors placeholder-zinc-600">
                                @error('name')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-xs tracking-widest uppercase text-zinc-400 mb-1.5">Teléfono / WhatsApp *</label>
                                <input type="tel" name="phone" required value="{{ old('phone') }}" placeholder="+34 600 000 000"
                                    class="w-full bg-zinc-900 border @error('phone') border-red-700 @else border-zinc-800 @enderror text-white text-sm px-4 py-2.5 rounded focus:outline-none focus:border-amber-600 transition-colors placeholder-zinc-600">
                                @error('phone')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs tracking-widest uppercase text-zinc-400 mb-1.5">Email *</label>
                            <input type="email" name="email" required value="{{ old('email') }}" placeholder="tu@email.com"
                                class="w-full bg-zinc-900 border @error('email') border-red-700 @else border-zinc-800 @enderror text-white text-sm px-4 py-2.5 rounded focus:outline-none focus:border-amber-600 transition-colors placeholder-zinc-600">
                            @error('email')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-xs tracking-widest uppercase text-zinc-400 mb-1.5">Sucursal *</label>
                            <div class="relative">
                                <select name="branch" required
                                    class="w-full appearance-none bg-zinc-900 border @error('branch') border-red-700 @else border-zinc-800 @enderror text-white text-sm px-4 py-2.5 rounded focus:outline-none focus:border-amber-600 transition-colors pr-8">
                                    <option value="" disabled {{ old('branch') ? '' : 'selected' }}>¿En qué sucursal?</option>
                                    @foreach(\App\Models\SiteSetting::branches() as $branch)
                                    @php $branchLabel = $branch['label']; @endphp
                                    <option value="{{ $branchLabel }}" {{ old('branch') === $branchLabel ? 'selected' : '' }}>{{ $branchLabel }}</option>
                                    @endforeach
                                </select>
                                <svg class="absolute right-3 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-zinc-500 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </div>
                            @error('branch')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs tracking-widest uppercase text-zinc-400 mb-1.5">Estilo *</label>
                                <div class="relative">
                                    <select name="tattoo_style_id" required
                                        class="w-full appearance-none bg-zinc-900 border @error('tattoo_style_id') border-red-700 @else border-zinc-800 @enderror text-white text-sm px-4 py-2.5 rounded focus:outline-none focus:border-amber-600 transition-colors pr-8">
                                        <option value="" disabled {{ old('tattoo_style_id') ? '' : 'selected' }}>Seleccionar</option>
                                        @foreach($styles as $style)
                                        <option value="{{ $style->id }}" {{ old('tattoo_style_id') == $style->id ? 'selected' : '' }}>{{ $style->name }}</option>
                                        @endforeach
                                    </select>
                                    <svg class="absolute right-3 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-zinc-500 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                </div>
                                @error('tattoo_style_id')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-xs tracking-widest uppercase text-zinc-400 mb-1.5">Zona del cuerpo *</label>
                                <input type="text" name="body_area" required value="{{ old('body_area') }}" placeholder="Ej: antebrazo izquierdo"
                                    class="w-full bg-zinc-900 border @error('body_area') border-red-700 @else border-zinc-800 @enderror text-white text-sm px-4 py-2.5 rounded focus:outline-none focus:border-amber-600 transition-colors placeholder-zinc-600">
                                @error('body_area')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs tracking-widest uppercase text-zinc-400 mb-1.5">Descripción del diseño *</label>
                            <textarea name="idea" required rows="3" placeholder="Cuéntanos qué tienes en mente: tema, referencias, tamaño, colores..."
                                class="w-full bg-zinc-900 border border-zinc-800 text-white text-sm px-4 py-2.5 rounded focus:outline-none focus:border-amber-600 transition-colors placeholder-zinc-600 resize-none">{{ old('idea') }}</textarea>
                        </div>
                        <button type="submit"
                            class="w-full bg-amber-700 hover:bg-amber-600 text-white text-sm tracking-widest uppercase py-3 transition-colors rounded font-medium btn-press">
                            Enviar solicitud
                        </button>
                        <p class="text-center text-xs text-zinc-400">* Campos obligatorios · Respuesta en 24–48h</p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════
     MODALES
══════════════════════════════════ --}}

{{-- Lightbox portfolio --}}
<div x-show="lbOpen"
     x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-50 bg-black/97 flex items-center justify-center"
     x-on:touchstart="swipeStart($event)"
     x-on:touchend="swipeEnd($event)"
     style="display:none">

    <button type="button" x-on:click="closeLb()"
        class="absolute top-4 right-4 z-10 w-10 h-10 flex items-center justify-center rounded-full bg-zinc-800/90 hover:bg-zinc-700 border border-zinc-700 text-white transition-all"
        aria-label="Cerrar">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
    </button>

    <div class="absolute top-4 left-1/2 -translate-x-1/2 text-xs text-zinc-500 tracking-widest"
         x-text="`${lbIdx + 1} / ${filtered.length}`"></div>

    <button type="button" x-on:click="prevLb()"
        class="absolute left-3 sm:left-5 top-1/2 -translate-y-1/2 z-10 w-10 h-10 sm:w-12 sm:h-12 flex items-center justify-center rounded-full bg-zinc-800/80 hover:bg-zinc-700 border border-zinc-700 text-white transition-all"
        aria-label="Anterior">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
    </button>

    <button type="button" x-on:click="nextLb()"
        class="absolute right-3 sm:right-5 top-1/2 -translate-y-1/2 z-10 w-10 h-10 sm:w-12 sm:h-12 flex items-center justify-center rounded-full bg-zinc-800/80 hover:bg-zinc-700 border border-zinc-700 text-white transition-all"
        aria-label="Siguiente">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    </button>

    <div class="w-full h-full flex flex-col items-center justify-center px-16 sm:px-20 py-14">
        <template x-if="filtered.length > 0 && filtered[lbIdx]">
            <div class="flex flex-col items-center gap-3 w-full">
                <img :src="filtered[lbIdx].image"
                     :alt="filtered[lbIdx].title || 'Tatuaje Getafe'"
                     class="max-h-[80vh] max-w-full object-contain rounded select-none"
                     draggable="false" loading="lazy">
                <div class="text-center" x-show="filtered[lbIdx].title || filtered[lbIdx].style">
                    <p class="text-white text-sm font-medium" x-show="filtered[lbIdx].title" x-text="filtered[lbIdx].title"></p>
                    <p class="text-amber-500 text-xs tracking-widest uppercase mt-0.5" x-show="filtered[lbIdx].style" x-text="filtered[lbIdx].style"></p>
                </div>
            </div>
        </template>
    </div>
</div>

{{-- Modal artista --}}
@foreach($artists as $i => $artist)
@php
    $artistBranch = $branches[$artist->branch - 1] ?? null;
    $artistName   = $artist->name;
    $artistStyle  = $artist->style;
    $artistBio    = $artist->bio;
    $artistImg    = $img($artist->image);
    $whatsapp     = ($artistBranch ?? $branches[0])['whatsapp_tattoo'];
@endphp
<div x-show="artistOpen === {{ $i }}"
     x-transition:enter="transition ease-out duration-250" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-50 bg-black/92 backdrop-blur-sm flex items-center justify-center p-4 sm:p-6"
     x-on:click.self="closeArtist()" style="display:none">

    <button type="button" x-on:click="closeArtist()"
        class="fixed top-4 right-4 z-10 w-9 h-9 flex items-center justify-center rounded-full bg-zinc-800 hover:bg-zinc-700 border border-zinc-700 text-white transition-all"
        aria-label="Cerrar">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
    </button>

    <div class="w-full max-w-xl max-h-[88vh] overflow-y-auto bg-zinc-950 border border-zinc-800 rounded-xl shadow-2xl"
         x-on:click.stop style="scrollbar-width:none">
        <div class="flex gap-0 items-start">
            {{-- Foto --}}
            <div class="w-36 sm:w-48 flex-shrink-0 bg-zinc-900">
                @if($artistImg)
                    <img src="{{ $artistImg }}" alt="{{ $artistName }}"
                         class="w-full h-full object-cover object-top" style="min-height:180px;max-height:240px">
                @else
                    <div class="w-full flex items-center justify-center bg-gradient-to-br from-zinc-800 to-zinc-900" style="min-height:180px">
                        <svg class="w-12 h-12 text-zinc-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                @endif
            </div>
            {{-- Info --}}
            <div class="flex-1 p-4 sm:p-5 flex flex-col justify-between min-w-0">
                <div>
                    <span class="text-[9px] tracking-[0.4em] uppercase text-amber-700">{{ $artistBranch ? 'Tatuador · ' . $artistBranch['name'] : 'Tatuador · Ambas sucursales' }}</span>
                    <h3 class="font-heading text-2xl sm:text-3xl text-white leading-tight mt-0.5">{{ $artistName }}</h3>
                    <p class="text-[10px] tracking-widest uppercase text-zinc-500 mt-0.5">{{ $artistStyle }}</p>
                    <div class="h-px w-8 bg-amber-700 mt-3 mb-3"></div>
                    <p class="text-zinc-400 text-xs sm:text-sm leading-relaxed">{{ $artistBio }}</p>
                </div>
                <a href="https://wa.me/{{ $whatsapp }}?text=Hola%2C%20he%20visto%20vuestra%20web%20y%20me%20gustar%C3%ADa%20pedir%20informaci%C3%B3n%20sobre%20un%20tatuaje."
                   target="_blank" rel="noopener"
                   class="mt-4 inline-flex items-center justify-center gap-1.5 text-white text-[10px] tracking-widest uppercase px-4 py-2.5 rounded transition-colors btn-press"
                   style="background-color:#25D366">
                    <svg class="w-3.5 h-3.5 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    Pedir cita por WhatsApp
                </a>
            </div>
        </div>

        {{-- Últimos trabajos --}}
        @if($works->count() > 0)
        <div class="border-t border-zinc-800"
             x-data="{ scroll(dir){ $refs.artistCarousel.scrollBy({ left: dir * 148, behavior: 'smooth' }) } }">
            <div class="flex items-center justify-between px-4 pt-3 pb-2">
                <p class="text-[9px] tracking-[0.4em] uppercase text-zinc-400">Últimos trabajos</p>
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
                 x-ref="artistCarousel"
                 style="scrollbar-width:none;-webkit-overflow-scrolling:touch;scroll-snap-type:x mandatory">
                @foreach($works->take(12) as $work)
                @php $wImg = $img($work->image); @endphp
                @if($wImg)
                <div class="flex-none w-28 h-28 sm:w-32 sm:h-32 rounded-lg overflow-hidden bg-zinc-800 flex-shrink-0"
                     style="scroll-snap-align:start">
                    <img src="{{ $wImg }}" alt="{{ $work->title }}" class="w-full h-full object-cover" loading="lazy">
                </div>
                @endif
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endforeach


{{-- ===== FAQ TATUAJES ===== --}}
<section class="py-20 px-4 border-t border-zinc-900" itemscope itemtype="https://schema.org/FAQPage">
    <div class="max-w-3xl mx-auto">
        <div class="text-center mb-12">
            <span class="text-[10px] tracking-[0.5em] uppercase text-red-800 block mb-3">Preguntas frecuentes</span>
            <h2 class="text-2xl sm:text-3xl font-bold text-white tracking-tight">FAQ — Estudio de Tatuajes en Getafe</h2>
            <p class="text-zinc-500 text-sm mt-3">Resolvemos tus dudas antes de tu primera sesión</p>
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
