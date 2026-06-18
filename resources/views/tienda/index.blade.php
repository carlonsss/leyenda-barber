@extends('layouts.app')

@section('title', 'Leyenda Drop — Ropa Urbana Streetwear Getafe y Madrid')
@section('meta_description', 'Tienda oficial Leyenda Barber & Tattoo. Camisetas, hoodies, gorras y accesorios streetwear. Colecciones limitadas · Recogida en tienda · Getafe · Madrid.')

@section('content')
@php
    $img = fn($path) => $path ? (str_starts_with($path, 'http') ? $path : asset('storage/' . $path)) : null;
    $s   = fn(string $key, string $default = '') => \App\Models\SiteSetting::get($key, $default);
    $heroSetting   = \App\Models\SiteSetting::get('tienda_hero_image');
    $tiendaHeroUrl = $heroSetting ? asset('storage/' . $heroSetting) : '/images/barberia-hero.jpg';
@endphp

{{-- ═══ HERO ═══ --}}
<section class="relative min-h-[78vh] sm:min-h-[88vh] flex items-end overflow-hidden">
    <div class="absolute inset-0">
        <img src="{{ $tiendaHeroUrl }}"
             alt="Leyenda Drop — Ropa Urbana Streetwear Getafe"
             class="w-full h-full object-cover object-center"
             loading="eager" fetchpriority="high">
        <div class="absolute inset-0 bg-black/65"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/20 to-transparent"></div>
    </div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 pb-12 sm:pb-16 pt-32 w-full" data-reveal>
        <h1 class="font-heading text-[14vw] sm:text-[10.5vw] md:text-[8vw] leading-none text-white drop-shadow-2xl">LA TIENDA</h1>
        <div class="flex items-center gap-3 mt-3">
            <span class="text-[9px] tracking-[0.55em] uppercase text-zinc-500">Leyenda · Studio Collection</span>
            @if($newDrop->count() > 0)
            <span class="inline-block bg-white text-black text-[9px] tracking-[0.15em] uppercase font-bold px-2 py-0.5">NEW DROP</span>
            @endif
        </div>
        <div class="h-px w-14 bg-red-800 mt-4 sm:mt-5" data-line></div>
        <div class="flex flex-col sm:flex-row sm:items-end gap-4 sm:gap-10 mt-5">
            <p class="text-zinc-300 text-sm max-w-xs leading-relaxed">{{ $s('tienda_hero_description', 'Ropa y accesorios con identidad propia. Piezas para los que viven el estilo.') }}</p>
            <div class="flex-none inline-flex items-center gap-2 border border-zinc-700/60 rounded-lg px-4 py-2.5 bg-black/50 backdrop-blur-sm">
                <svg class="w-3.5 h-3.5 text-red-700 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                <span class="text-zinc-300 text-xs">{{ $s('tienda_recogida_badge', 'Recogida en tienda. No enviamos a domicilio.') }}</span>
            </div>
        </div>
    </div>
</section>

{{-- ═══ NUEVA COLECCIÓN ═══ --}}
@if($newDrop->count() > 0)
<section class="bg-zinc-950 border-b border-zinc-900 py-14 sm:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="flex items-end justify-between mb-8 sm:mb-10" data-reveal>
            <div>
                <div class="flex items-center gap-2.5 mb-2">
                    <div class="w-1 h-5 bg-red-800 rounded-full"></div>
                    <span class="text-[9px] tracking-[0.5em] uppercase text-zinc-400">Colección actual</span>
                    <span class="bg-white text-black text-[9px] tracking-[0.15em] uppercase font-bold px-2 py-0.5">NEW</span>
                </div>
                <h2 class="font-heading text-3xl sm:text-4xl md:text-5xl text-white leading-none">NUEVA COLECCIÓN</h2>
            </div>
            @if($newDrop->count() > 4)
            <a href="#todos" class="text-[10px] tracking-widest uppercase text-zinc-500 hover:text-white transition-colors hidden sm:block">Ver todos →</a>
            @endif
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-5" data-reveal>
            @foreach($newDrop->take(4) as $product)
            @php
                $pImgs    = is_array($product->images) ? $product->images : [];
                $pImgUrls = array_values(array_filter(array_map(fn($p) => $img($p), $pImgs)));
                $pCount   = count($pImgUrls);
                $pSizes   = is_array($product->size_options) ? $product->size_options : [];
                $hasSizes = count($pSizes) > 0;
            @endphp
            <div x-data="{
                    idx: 0, t: null,
                    on()  { @if($pCount > 1) this.t = setInterval(() => this.idx = (this.idx+1) % {{ $pCount }}, 2500) @endif },
                    off() { clearInterval(this.t); this.idx = 0; }
                 }"
                 @mouseenter="on()" @mouseleave="off()"
                 class="group">
                <a href="{{ route('tienda.show', $product) }}" class="block mb-3" aria-label="{{ $product->name }}">
                    <div class="aspect-[3/4] bg-zinc-900 rounded-xl overflow-hidden border border-zinc-800 group-hover:border-zinc-600 transition-colors duration-300 relative">
                        @foreach($pImgUrls as $pi => $pUrl)
                        <img src="{{ $pUrl }}" alt="{{ $product->name }}"
                             class="absolute inset-0 w-full h-full object-cover transition-opacity duration-700"
                             :class="idx === {{ $pi }} ? 'opacity-100' : 'opacity-0'"
                             loading="{{ $pi === 0 ? 'eager' : 'lazy' }}"
                             style="will-change:opacity">
                        @endforeach
                        @if($pCount === 0)
                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-zinc-800 to-zinc-900">
                            <svg class="w-10 h-10 text-zinc-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                        </div>
                        @endif
                        <div class="absolute top-3 left-3 bg-white text-black text-[9px] tracking-[0.2em] uppercase font-bold px-2 py-0.5 leading-tight">NEW</div>
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/25 transition-colors duration-300"></div>
                    </div>
                </a>
                <a href="{{ route('tienda.show', $product) }}" class="block">
                    <h3 class="text-sm font-medium text-white group-hover:text-zinc-300 transition-colors leading-snug tracking-wide">{{ strtoupper($product->name) }}</h3>
                </a>
                <div class="flex items-center justify-between mt-1 mb-2.5">
                    <span class="font-heading text-xl text-red-700 leading-none">{{ number_format($product->price, 0) }}€</span>
                    @if($product->stock <= 5)
                    <span class="text-[9px] text-amber-600 tracking-wide uppercase">{{ $product->stock }} uds.</span>
                    @endif
                </div>
                @if($hasSizes)
                <a href="{{ route('tienda.show', $product) }}"
                   class="block w-full border border-zinc-700 hover:border-white text-zinc-500 hover:text-white text-[10px] tracking-widest uppercase text-center py-2 transition-all duration-200 rounded-lg">
                    Elegir talla →
                </a>
                @else
                <button x-data="{ ok: false }"
                    x-on:click.stop="$store.cart.add({{ $product->id }}, null); ok=true; setTimeout(()=>ok=false,1800)"
                    :class="ok ? 'border-green-700 bg-green-900/30 text-green-400' : 'border-zinc-700 hover:border-white hover:text-white text-zinc-500'"
                    class="w-full border text-[10px] tracking-widest uppercase py-2 transition-all duration-200 rounded-lg">
                    <span x-show="!ok">Añadir al carrito</span>
                    <span x-show="ok" style="display:none">✓ Añadido</span>
                </button>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ═══ MÁS VENDIDOS ═══ --}}
@if($bestSellers->count() > 0)
<section class="py-14 sm:py-20 border-b border-zinc-900/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="mb-8 sm:mb-10" data-reveal>
            <div class="flex items-center gap-2.5 mb-2">
                <div class="w-1 h-5 bg-red-800 rounded-full"></div>
                <span class="text-[9px] tracking-[0.5em] uppercase text-zinc-400">Los más pedidos</span>
            </div>
            <h2 class="font-heading text-3xl sm:text-4xl md:text-5xl text-white leading-none">MÁS VENDIDOS</h2>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-5" data-reveal>
            @foreach($bestSellers as $product)
            @php
                $pImgs    = is_array($product->images) ? $product->images : [];
                $pImgUrls = array_values(array_filter(array_map(fn($p) => $img($p), $pImgs)));
                $pCount   = count($pImgUrls);
                $pSizes   = is_array($product->size_options) ? $product->size_options : [];
                $hasSizes = count($pSizes) > 0;
            @endphp
            <div x-data="{
                    idx: 0, t: null,
                    on()  { @if($pCount > 1) this.t = setInterval(() => this.idx = (this.idx+1) % {{ $pCount }}, 2500) @endif },
                    off() { clearInterval(this.t); this.idx = 0; }
                 }"
                 @mouseenter="on()" @mouseleave="off()"
                 class="group" data-stagger>
                <a href="{{ route('tienda.show', $product) }}" class="block mb-3" aria-label="{{ $product->name }}">
                    <div class="aspect-[3/4] bg-zinc-900 rounded-xl overflow-hidden border border-zinc-800 group-hover:border-zinc-600 transition-colors duration-300 relative">
                        @foreach($pImgUrls as $pi => $pUrl)
                        <img src="{{ $pUrl }}" alt="{{ $product->name }}"
                             class="absolute inset-0 w-full h-full object-cover transition-opacity duration-700"
                             :class="idx === {{ $pi }} ? 'opacity-100' : 'opacity-0'"
                             loading="lazy"
                             style="will-change:opacity">
                        @endforeach
                        @if($pCount === 0)
                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-zinc-800 to-zinc-900">
                            <svg class="w-10 h-10 text-zinc-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                        </div>
                        @endif
                        @if($product->is_new)
                        <div class="absolute top-3 left-3 bg-white text-black text-[9px] tracking-[0.2em] uppercase font-bold px-2 py-0.5 leading-tight">NEW</div>
                        @endif
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/25 transition-colors duration-300"></div>
                    </div>
                </a>
                <a href="{{ route('tienda.show', $product) }}" class="block">
                    <h3 class="text-sm font-medium text-white group-hover:text-zinc-300 transition-colors leading-snug tracking-wide">{{ strtoupper($product->name) }}</h3>
                </a>
                <div class="flex items-center justify-between mt-1 mb-2.5">
                    <span class="font-heading text-xl text-red-700 leading-none">{{ number_format($product->price, 0) }}€</span>
                    @if($product->stock <= 5)
                    <span class="text-[9px] text-amber-600 tracking-wide uppercase">{{ $product->stock }} uds.</span>
                    @endif
                </div>
                @if($hasSizes)
                <a href="{{ route('tienda.show', $product) }}"
                   class="block w-full border border-zinc-700 hover:border-white text-zinc-500 hover:text-white text-[10px] tracking-widest uppercase text-center py-2 transition-all duration-200 rounded-lg">
                    Elegir talla →
                </a>
                @else
                <button x-data="{ ok: false }"
                    x-on:click.stop="$store.cart.add({{ $product->id }}, null); ok=true; setTimeout(()=>ok=false,1800)"
                    :class="ok ? 'border-green-700 bg-green-900/30 text-green-400' : 'border-zinc-700 hover:border-white hover:text-white text-zinc-500'"
                    class="w-full border text-[10px] tracking-widest uppercase py-2 transition-all duration-200 rounded-lg">
                    <span x-show="!ok">Añadir al carrito</span>
                    <span x-show="ok" style="display:none">✓ Añadido</span>
                </button>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ═══ CATÁLOGO ═══ --}}
@php
    $catLabels = ['camisetas' => 'Camisetas', 'sudaderas' => 'Sudaderas', 'pantalones' => 'Pantalones', 'accesorios' => 'Accesorios'];
    $activeCats = array_keys(array_filter($byCategory, fn($g) => $g->count() > 0));
@endphp
<script>
document.addEventListener('alpine:init', () => {
    Alpine.store('catFilter', 'todos');
});
</script>
<section id="todos" class="max-w-7xl mx-auto px-4 sm:px-6 py-14 sm:py-20">
    <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-5 mb-8 sm:mb-10" data-reveal>
        <div>
            <div class="flex items-center gap-2.5 mb-2">
                <div class="w-1 h-5 bg-red-800 rounded-full"></div>
                <span class="text-[9px] tracking-[0.5em] uppercase text-zinc-400">Catálogo completo</span>
            </div>
            <h2 class="font-heading text-3xl sm:text-4xl md:text-5xl text-white leading-none">COLECCIÓN</h2>
        </div>
        <span class="text-[10px] text-zinc-400 tracking-widest uppercase hidden sm:block"
              x-data x-text="$store.catFilter === 'todos' ? '{{ $products->count() }} piezas' : ''"></span>
    </div>

    {{-- Tabs de categoría --}}
    @if(count($activeCats) > 0)
    <div class="flex flex-wrap gap-2 mb-8" role="tablist" x-data>
        <button type="button" role="tab"
            x-on:click="$store.catFilter = 'todos'"
            :class="$store.catFilter === 'todos' ? 'border-white text-white bg-white/5' : 'border-zinc-800 text-zinc-500 hover:border-zinc-600 hover:text-zinc-300'"
            class="border text-[10px] tracking-[0.3em] uppercase px-4 py-2 transition-all duration-200 rounded-lg">
            Todos
        </button>
        @foreach($activeCats as $cat)
        <button type="button" role="tab"
            x-on:click="$store.catFilter = '{{ $cat }}'"
            :class="$store.catFilter === '{{ $cat }}' ? 'border-white text-white bg-white/5' : 'border-zinc-800 text-zinc-500 hover:border-zinc-600 hover:text-zinc-300'"
            class="border text-[10px] tracking-[0.3em] uppercase px-4 py-2 transition-all duration-200 rounded-lg">
            {{ $catLabels[$cat] }}
        </button>
        @endforeach
    </div>
    @endif

    @if($products->count() === 0)
    <div class="py-24 text-center border border-zinc-900 rounded-xl">
        <svg class="w-12 h-12 text-zinc-800 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
        <p class="text-zinc-400 text-sm">Nuevas piezas próximamente.</p>
    </div>
    @else
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-5">
        @foreach($products as $product)
        @php
            $pImgUrls = array_values(array_filter(array_map(fn($p) => $img($p), $product->images ?? [])));
            $pCount = count($pImgUrls);
            $hasSizes = $product->size_options && count($product->size_options) > 0;
            $pCat = $product->category ?? '';
        @endphp
        <div x-data="{
                idx: 0, t: null,
                on()  { @if($pCount > 1) this.t = setInterval(() => this.idx = (this.idx+1) % {{ $pCount }}, 2500) @endif },
                off() { clearInterval(this.t); this.idx = 0; }
             }"
             x-show="$store.catFilter === 'todos' || $store.catFilter === '{{ $pCat }}'"
             @mouseenter="on()" @mouseleave="off()"
             class="group">
            <a href="{{ route('tienda.show', $product) }}" class="block mb-3" aria-label="{{ $product->name }}">
                <div class="aspect-[3/4] bg-zinc-900 rounded-xl overflow-hidden border border-zinc-800 group-hover:border-zinc-600 transition-colors duration-300 relative">
                    @foreach($pImgUrls as $pi => $pUrl)
                    <img src="{{ $pUrl }}" alt="{{ $product->name }}"
                         class="absolute inset-0 w-full h-full object-cover transition-opacity duration-700"
                         :class="idx === {{ $pi }} ? 'opacity-100' : 'opacity-0'"
                         loading="lazy"
                         style="will-change:opacity">
                    @endforeach
                    @if($pCount === 0)
                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-zinc-800 to-zinc-900">
                        <svg class="w-10 h-10 text-zinc-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                    </div>
                    @endif
                    @if($product->is_new)
                    <div class="absolute top-3 left-3 bg-white text-black text-[9px] tracking-[0.2em] uppercase font-bold px-2 py-0.5 leading-tight">NEW</div>
                    @endif
                    @if($product->stock <= 5)
                    <div class="absolute top-3 right-3 bg-amber-600/90 text-black text-[9px] tracking-wide uppercase font-bold px-2 py-0.5 rounded-sm leading-tight">Solo {{ $product->stock }} uds.</div>
                    @endif
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/25 transition-colors duration-300"></div>
                </div>
            </a>
            <a href="{{ route('tienda.show', $product) }}" class="block">
                <h3 class="text-sm font-medium text-white group-hover:text-zinc-300 transition-colors leading-snug tracking-wide line-clamp-2">{{ strtoupper($product->name) }}</h3>
            </a>
            <div class="flex items-center justify-between mt-1 mb-2.5">
                <span class="font-heading text-xl text-red-700 leading-none">{{ number_format($product->price, 0) }}€</span>
                @if($pCat)
                <span class="text-[9px] tracking-widest uppercase text-zinc-400">{{ $catLabels[$pCat] ?? '' }}</span>
                @endif
            </div>
            @if($hasSizes)
            <a href="{{ route('tienda.show', $product) }}"
               class="block w-full border border-zinc-700 hover:border-white text-zinc-500 hover:text-white text-[10px] tracking-widest uppercase text-center py-2 transition-all duration-200 rounded-lg">
                Elegir talla →
            </a>
            @else
            <button x-data="{ ok: false }"
                x-on:click.stop="$store.cart.add({{ $product->id }}, null); ok=true; setTimeout(()=>ok=false,1800)"
                :class="ok ? 'border-green-700 bg-green-900/30 text-green-400' : 'border-zinc-700 hover:border-white hover:text-white text-zinc-500'"
                class="w-full border text-[10px] tracking-widest uppercase py-2 transition-all duration-200 rounded-lg">
                <span x-show="!ok">Añadir al carrito</span>
                <span x-show="ok" style="display:none">✓ Añadido</span>
            </button>
            @endif
        </div>{{-- /product card --}}
        @endforeach
    </div>
    @endif
</section>

{{-- ===== FAQ TIENDA ===== --}}
<section class="py-20 px-4 border-t border-zinc-900" itemscope itemtype="https://schema.org/FAQPage">
    <div class="max-w-3xl mx-auto">
        <div class="text-center mb-12">
            <span class="text-[10px] tracking-[0.5em] uppercase text-red-800 block mb-3">Preguntas frecuentes</span>
            <h2 class="text-2xl sm:text-3xl font-bold text-white tracking-tight">FAQ — Tienda de Ropa Streetwear</h2>
            <p class="text-zinc-500 text-sm mt-3">Todo sobre tu pedido y nuestra colección</p>
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
        <div class="mt-10 text-center">
            <p class="text-zinc-500 text-sm mb-5">¿Tienes más preguntas sobre un pedido? Estamos en WhatsApp.</p>
            <a href="/contacto"
               class="inline-flex items-center gap-2 bg-red-800 hover:bg-red-700 text-white text-xs tracking-widest uppercase px-8 py-4 rounded transition-colors btn-press">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                Contactar por WhatsApp
            </a>
        </div>
    </div>
</section>

@endsection
