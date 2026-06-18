@extends('layouts.app')

@section('title', $product->name . ' — Leyenda Drop | Getafe')
@section('meta_description', $product->description ? Str::limit($product->description, 155) : 'Compra ' . $product->name . ' en la tienda oficial de Leyenda Barber & Tattoo · Getafe.')

@section('content')
@php
    $img     = fn($path) => $path ? (str_starts_with($path, 'http') ? $path : asset('storage/' . $path)) : null;
    $rawImages = $product->images;
    $images    = is_array($rawImages) ? $rawImages : [];
    $imgUrls   = array_values(array_filter(array_map(fn($p) => $img($p), $images)));
    $rawSizes = $product->size_options;
    $sizes    = is_array($rawSizes) ? $rawSizes : [];
    // Compatibilidad: si viene como lista indexada antigua, convertir a mapa con 0 stock
    if (!empty($sizes) && array_is_list($sizes)) {
        $sizes = array_fill_keys($sizes, 0);
    }
    $hasNoSize = empty($sizes);
    $pdData    = ['id' => $product->id, 'images' => $imgUrls, 'sizes' => $sizes];
@endphp

<script id="pd-data" type="application/json">@json($pdData)</script>

<div class="pt-20 sm:pt-24"
     x-data="{
         pd: JSON.parse(document.getElementById('pd-data').textContent),
         imgIdx: 0,
         selectedSize: null,
         added: false,
         zoomOpen: false,
         guideOpen: false,

         prev() { this.imgIdx = this.imgIdx > 0 ? this.imgIdx - 1 : this.pd.images.length - 1; },
         next() { this.imgIdx = this.imgIdx < this.pd.images.length - 1 ? this.imgIdx + 1 : 0; },

         swipeX: 0,
         swipeStart(e) { this.swipeX = e.touches[0].clientX; },
         swipeEnd(e) {
             const d = this.swipeX - e.changedTouches[0].clientX;
             if (Math.abs(d) > 45) d > 0 ? this.next() : this.prev();
         },

         addToCart() {
             this.$store.cart.add(this.pd.id, this.selectedSize);
             this.added = true;
             setTimeout(() => this.added = false, 2200);
         }
     }"
     x-on:keydown.escape.window="zoomOpen = false; guideOpen = false"
     x-on:keydown.arrowleft.window="zoomOpen && prev()"
     x-on:keydown.arrowright.window="zoomOpen && next()"
>

{{-- ═══ PRODUCT DETAIL ═══ --}}
<section class="max-w-6xl mx-auto px-4 sm:px-6 py-10 sm:py-16">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 sm:gap-14">

        {{-- ── GALERÍA ── --}}
        <div>
            {{-- Imagen principal --}}
            <div class="relative aspect-square bg-zinc-900 rounded-xl overflow-hidden border border-zinc-800"
                 x-on:touchstart="swipeStart($event)"
                 x-on:touchend="swipeEnd($event)">

                @if(count($imgUrls) > 0)
                    @foreach($imgUrls as $pi => $pUrl)
                    <img src="{{ $pUrl }}" alt="{{ $product->name }}"
                         class="absolute inset-0 w-full h-full object-cover transition-opacity duration-300 cursor-zoom-in" style="will-change:opacity"
                         :class="imgIdx === {{ $pi }} ? 'opacity-100' : 'opacity-0'"
                         x-on:click="zoomOpen = true"
                         loading="{{ $pi === 0 ? 'eager' : 'lazy' }}"
                         draggable="false">
                    @endforeach
                @else
                <div class="w-full h-full flex items-center justify-center">
                    <svg class="w-16 h-16 text-zinc-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                </div>
                @endif

                {{-- Flechas navegación --}}
                @if(count($imgUrls) > 1)
                <button type="button" x-on:click="prev()"
                    class="absolute left-2 top-1/2 -translate-y-1/2 w-9 h-9 flex items-center justify-center rounded-full bg-black/60 hover:bg-black/90 border border-zinc-700 text-white transition-all"
                    aria-label="Imagen anterior">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <button type="button" x-on:click="next()"
                    class="absolute right-2 top-1/2 -translate-y-1/2 w-9 h-9 flex items-center justify-center rounded-full bg-black/60 hover:bg-black/90 border border-zinc-700 text-white transition-all"
                    aria-label="Imagen siguiente">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </button>
                {{-- Dots --}}
                <div class="absolute bottom-3 left-0 right-0 flex justify-center gap-1.5">
                    @foreach($imgUrls as $pi => $pUrl)
                    <button type="button" x-on:click="imgIdx = {{ $pi }}"
                        :class="imgIdx === {{ $pi }} ? 'bg-white w-4' : 'bg-zinc-600 w-1.5'"
                        class="h-1.5 rounded-full transition-all duration-300"
                        aria-label="Foto {{ $pi + 1 }}"></button>
                    @endforeach
                </div>
                @endif

                {{-- Zoom hint --}}
                @if(count($imgUrls) > 0)
                <div class="absolute bottom-3 right-3 w-8 h-8 flex items-center justify-center rounded-full bg-black/50 border border-zinc-700 text-zinc-400 pointer-events-none">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/></svg>
                </div>
                @endif

                @if($product->is_new)
                <div class="absolute top-4 left-4 bg-white text-black text-[9px] tracking-[0.2em] uppercase font-bold px-2 py-0.5">NEW</div>
                @endif
            </div>

            {{-- Thumbnails --}}
            @if(count($imgUrls) > 1)
            <div class="flex gap-2 mt-3 overflow-x-auto pb-1" style="scrollbar-width:none">
                @foreach($imgUrls as $pi => $pUrl)
                <button type="button" x-on:click="imgIdx = {{ $pi }}"
                    :class="imgIdx === {{ $pi }} ? 'border-white' : 'border-zinc-800 hover:border-zinc-600'"
                    class="flex-shrink-0 w-16 h-16 sm:w-18 sm:h-18 rounded-lg overflow-hidden border-2 transition-colors duration-200"
                    aria-label="Ver foto {{ $pi + 1 }}">
                    <img src="{{ $pUrl }}" alt="{{ $product->name }}" class="w-full h-full object-cover" loading="lazy">
                </button>
                @endforeach
            </div>
            @endif
        </div>

        {{-- ── INFO ── --}}
        <div class="flex flex-col">
            <nav class="flex items-center gap-2 text-xs text-zinc-600 mb-5" aria-label="Breadcrumb">
                <a href="{{ route('tienda') }}" class="hover:text-zinc-400 transition-colors">Tienda</a>
                <span>/</span>
                <span class="text-zinc-500 truncate">{{ $product->name }}</span>
            </nav>

            <h1 class="font-heading text-3xl sm:text-4xl md:text-5xl text-white leading-tight">{{ strtoupper($product->name) }}</h1>

            <div class="flex items-center gap-4 mt-3 sm:mt-4">
                <span class="font-heading text-3xl sm:text-4xl text-red-700 leading-none">{{ number_format($product->price, 0) }}€</span>
                @if($product->stock > 0)
                    @if($product->stock <= 5)
                    <span class="text-xs tracking-widest uppercase text-amber-600 border border-amber-900/50 rounded px-2 py-0.5">Solo {{ $product->stock }} uds.</span>
                    @else
                    <span class="text-xs tracking-widest uppercase text-green-600 border border-green-900/50 rounded px-2 py-0.5">En stock</span>
                    @endif
                @else
                <span class="text-xs tracking-widest uppercase text-zinc-600 border border-zinc-800 rounded px-2 py-0.5">Agotado</span>
                @endif
            </div>

            @if($product->description)
            <p class="text-zinc-400 text-sm leading-relaxed mt-5 border-t border-zinc-800/60 pt-5">{{ $product->description }}</p>
            @endif

            {{-- TALLAS --}}
            @if(!$hasNoSize)
            <div class="mt-5 sm:mt-6">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs tracking-widest uppercase text-zinc-400">Talla</span>
                    <button type="button" x-on:click="guideOpen = true"
                        class="text-[10px] tracking-widest uppercase text-zinc-500 hover:text-white transition-colors underline underline-offset-2">
                        Guía de tallas →
                    </button>
                </div>
                <div class="flex flex-wrap gap-2">
                    <template x-for="[size, qty] in Object.entries(pd.sizes)" :key="size">
                        <button type="button"
                            :disabled="qty <= 0"
                            x-on:click="qty > 0 && (selectedSize = selectedSize === size ? null : size)"
                            :class="qty <= 0
                                ? 'border-zinc-800 text-zinc-700 cursor-not-allowed line-through'
                                : selectedSize === size
                                    ? 'border-white bg-white text-black font-semibold'
                                    : 'border-zinc-700 text-zinc-400 hover:border-zinc-400 hover:text-white'"
                            class="border px-4 py-2 text-xs tracking-widest uppercase transition-all duration-150 rounded min-w-[44px] text-center"
                            x-text="qty <= 0 ? size + ' — agotado' : size">
                        </button>
                    </template>
                </div>
                <p class="text-[10px] text-zinc-600 mt-2" x-show="Object.keys(pd.sizes).length > 0 && !selectedSize">Selecciona una talla para continuar</p>
            </div>
            @endif

            {{-- ADD TO CART --}}
            @if($product->stock > 0)
            <button
                x-on:click="addToCart()"
                :disabled="{{ !$hasNoSize ? 'Object.keys(pd.sizes).length > 0 && !selectedSize' : 'false' }}"
                :class="added
                    ? 'bg-green-800 border-green-800 text-white cursor-default'
                    : 'bg-red-800 hover:bg-red-700 border-red-800 hover:border-red-700 text-white disabled:opacity-40 disabled:cursor-not-allowed'"
                class="mt-6 w-full border text-sm tracking-widest uppercase py-3.5 sm:py-4 transition-all duration-200 rounded btn-press">
                <span x-show="!added">
                    @if(!$hasNoSize)
                    <span x-show="Object.keys(pd.sizes).length > 0 && !selectedSize">Selecciona una talla</span>
                    <span x-show="Object.keys(pd.sizes).length === 0 || selectedSize">Añadir al carrito</span>
                    @else
                    Añadir al carrito
                    @endif
                </span>
                <span x-show="added">✓ Añadido al carrito</span>
            </button>
            @else
            <button disabled class="mt-6 w-full border border-zinc-800 text-zinc-600 text-sm tracking-widest uppercase py-3.5 rounded cursor-not-allowed">
                Agotado
            </button>
            @endif

            {{-- RECOGIDA EN TIENDA --}}
            <div class="mt-5 border border-zinc-800 rounded-xl p-4 flex gap-3 items-start bg-zinc-950">
                <div class="w-8 h-8 rounded-full border border-zinc-700 flex items-center justify-center flex-shrink-0 mt-0.5">
                    <svg class="w-4 h-4 text-red-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <div>
                    <p class="text-white text-xs font-medium tracking-wide">Producto de recogida en tienda</p>
                    <p class="text-zinc-500 text-xs leading-relaxed mt-0.5">Este artículo no tiene envío a domicilio. Pasarás a recogerlo en nuestra tienda de Getafe. Te contactaremos para confirmar.</p>
                </div>
            </div>

            <p class="text-[10px] text-zinc-600 mt-3 text-center tracking-wide">Gestión manual · Confirmación por email o WhatsApp</p>
        </div>
    </div>
</section>

{{-- ═══ RELACIONADOS ═══ --}}
@if($related->count() > 0)
<section class="bg-zinc-950 border-t border-zinc-900 py-14 sm:py-20">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <div class="mb-8" data-reveal>
            <span class="text-[9px] tracking-[0.5em] uppercase text-zinc-600">Seguir comprando</span>
            <h2 class="font-heading text-2xl sm:text-3xl text-white mt-1">TAMBIÉN TE PUEDE GUSTAR</h2>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 sm:gap-5" data-reveal>
            @foreach($related as $rel)
            @php
                $rRaw     = $rel->images;
                $rImages  = is_array($rRaw) ? $rRaw : [];
                $rImgUrls = array_values(array_filter(array_map(fn($p) => $img($p), $rImages)));
                $rImg     = $rImgUrls[0] ?? null;
            @endphp
            <div class="group">
                <a href="{{ route('tienda.show', $rel) }}" class="block mb-2.5">
                    <div class="aspect-[3/4] bg-zinc-900 rounded-xl overflow-hidden border border-zinc-800 group-hover:border-zinc-600 transition-all duration-300 relative">
                        @if($rImg)
                        <img src="{{ $rImg }}" alt="{{ $rel->name }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy">
                        @else
                        <div class="w-full h-full flex items-center justify-center"><svg class="w-8 h-8 text-zinc-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg></div>
                        @endif
                        @if($rel->is_new)
                        <div class="absolute top-3 left-3 bg-white text-black text-[9px] tracking-[0.2em] uppercase font-bold px-2 py-0.5">NEW</div>
                        @endif
                    </div>
                </a>
                <a href="{{ route('tienda.show', $rel) }}" class="block">
                    <h3 class="text-xs sm:text-sm font-medium text-white group-hover:text-zinc-300 transition-colors leading-snug truncate tracking-wide">{{ strtoupper($rel->name) }}</h3>
                </a>
                <p class="font-heading text-base sm:text-lg text-red-700 mt-0.5 leading-none">{{ number_format($rel->price, 0) }}€</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ══════════════════════
     MODALES
══════════════════════ --}}

{{-- Zoom / lightbox imagen --}}
<div x-show="zoomOpen"
     x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-50 bg-black/97 flex items-center justify-center"
     x-on:click.self="zoomOpen = false"
     x-on:touchstart="swipeStart($event)"
     x-on:touchend="swipeEnd($event)"
     style="display:none">

    <button type="button" x-on:click="zoomOpen = false"
        class="absolute top-4 right-4 z-10 w-10 h-10 flex items-center justify-center rounded-full bg-zinc-800/90 hover:bg-zinc-700 border border-zinc-700 text-white transition-all"
        aria-label="Cerrar zoom">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
    </button>

    @if(count($imgUrls) > 1)
    <div class="absolute top-4 left-1/2 -translate-x-1/2 text-xs text-zinc-500 tracking-widest" x-text="`${imgIdx + 1} / ${pd.images.length}`"></div>
    <button type="button" x-on:click="prev()"
        class="absolute left-3 sm:left-5 top-1/2 -translate-y-1/2 z-10 w-10 h-10 sm:w-12 sm:h-12 flex items-center justify-center rounded-full bg-zinc-800/80 hover:bg-zinc-700 border border-zinc-700 text-white transition-all">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
    </button>
    <button type="button" x-on:click="next()"
        class="absolute right-3 sm:right-5 top-1/2 -translate-y-1/2 z-10 w-10 h-10 sm:w-12 sm:h-12 flex items-center justify-center rounded-full bg-zinc-800/80 hover:bg-zinc-700 border border-zinc-700 text-white transition-all">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    </button>
    @endif

    <div class="w-full h-full flex items-center justify-center px-14 sm:px-20 py-16">
        @foreach($imgUrls as $pi => $pUrl)
        <img src="{{ $pUrl }}" alt="{{ $product->name }}"
             class="max-h-[85vh] max-w-full object-contain rounded select-none absolute transition-opacity duration-300"
             :class="imgIdx === {{ $pi }} ? 'opacity-100' : 'opacity-0 pointer-events-none'"
             draggable="false" loading="lazy">
        @endforeach
    </div>
</div>

{{-- Guía de tallas --}}
<div x-show="guideOpen"
     x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-50 bg-black/85 backdrop-blur-sm flex items-center justify-center p-4 sm:p-8"
     x-on:click.self="guideOpen = false"
     style="display:none">
    <div class="w-full max-w-md bg-zinc-950 border border-zinc-800 rounded-xl shadow-2xl overflow-hidden" x-on:click.stop>
        <div class="flex items-center justify-between px-5 py-4 border-b border-zinc-800">
            <h3 class="font-heading text-xl text-white">GUÍA DE TALLAS</h3>
            <button type="button" x-on:click="guideOpen = false" class="text-zinc-500 hover:text-white transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <div class="p-5 sm:p-6">
            @if($product->size_guide)
                <div class="text-zinc-300 text-xs leading-relaxed whitespace-pre-line">{{ $product->size_guide }}</div>
            @else
                <p class="text-zinc-500 text-xs leading-relaxed mb-4">Medidas aproximadas en centímetros. Para mejor ajuste, elige una talla mayor si estás entre dos.</p>
                <table class="w-full text-xs border-collapse">
                    <thead>
                        <tr class="border-b border-zinc-800">
                            <th class="text-left text-zinc-400 py-2 pr-3 tracking-widest uppercase font-normal">Talla</th>
                            <th class="text-left text-zinc-400 py-2 pr-3 tracking-widest uppercase font-normal">Pecho</th>
                            <th class="text-left text-zinc-400 py-2 tracking-widest uppercase font-normal">Largo</th>
                        </tr>
                    </thead>
                    <tbody class="text-zinc-300">
                        <tr class="border-b border-zinc-900"><td class="py-2.5 pr-3 font-medium text-white">S</td><td class="pr-3">92 – 96</td><td>69</td></tr>
                        <tr class="border-b border-zinc-900"><td class="py-2.5 pr-3 font-medium text-white">M</td><td class="pr-3">96 – 100</td><td>71</td></tr>
                        <tr class="border-b border-zinc-900"><td class="py-2.5 pr-3 font-medium text-white">L</td><td class="pr-3">100 – 106</td><td>73</td></tr>
                        <tr class="border-b border-zinc-900"><td class="py-2.5 pr-3 font-medium text-white">XL</td><td class="pr-3">106 – 112</td><td>75</td></tr>
                        <tr><td class="py-2.5 pr-3 font-medium text-white">XXL</td><td class="pr-3">112 – 120</td><td>77</td></tr>
                    </tbody>
                </table>
                <p class="text-zinc-600 text-[10px] mt-4">* Medidas orientativas. Pueden variar según el modelo.</p>
            @endif
        </div>
    </div>
</div>

</div>{{-- /alpine wrapper --}}

@push('head')
@php
$jsonLd = [
    '@context' => 'https://schema.org/',
    '@type' => 'Product',
    'name' => $product->name,
    'description' => $product->description ?? '',
    'image' => array_values($imgUrls),
    'offers' => [
        '@type' => 'Offer',
        'priceCurrency' => 'EUR',
        'price' => number_format($product->price, 2, '.', ''),
        'availability' => $product->stock > 0 ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock',
        'seller' => ['@type' => 'LocalBusiness', 'name' => 'Leyenda Barber & Tattoo'],
    ],
];
@endphp
<script type="application/ld+json">@json($jsonLd)</script>
@endpush

@endsection
