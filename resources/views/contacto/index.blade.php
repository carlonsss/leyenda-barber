@extends('layouts.app')

@section('title', 'Contacto — Leyenda Barber & Tattoo | Barbería y Tatuajes en Madrid y Getafe')
@section('meta_description', 'Contacta con Leyenda Barber & Tattoo en Madrid y Getafe. Teléfono, WhatsApp, email y ubicación. Reserva cita para barbería en Booksy o solicita presupuesto de tatuaje.')

@section('content')
@php
    $cs = fn(string $key, string $default = '') => \App\Models\SiteSetting::get($key, $default);
    $phone    = $cs('contact_phone', '+34 600 000 000');
    $wa       = $cs('contact_whatsapp', '34600000000');
    $email    = $cs('contact_email', 'hola@leyenda.es');
    $addr1    = $cs('contact_address_line1', 'Calle Gran Vía, 00');
    $addr2    = $cs('contact_address_line2', '28013 Madrid, España');
    $hwday    = $cs('contact_hours_weekday', '10:00 – 20:00');
    $hsat     = $cs('contact_hours_saturday', '10:00 – 18:00');
    $hsun     = $cs('contact_hours_sunday', 'Cerrado');
    $branches = \App\Models\SiteSetting::branches();
@endphp

{{-- ═══ HERO ═══ --}}
<section class="relative pt-28 sm:pt-32 pb-12 sm:pb-16 overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-b from-zinc-950 via-black to-black"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6">
        <span class="text-[10px] tracking-[0.5em] uppercase text-zinc-400">Studio · Leyenda</span>
        <h1 class="font-heading text-[18vw] sm:text-[15vw] md:text-[10vw] leading-none text-white mt-1">CONTACTO</h1>
        <div class="h-0.5 w-16 bg-red-800 mt-3 sm:mt-4"></div>
        <p class="text-zinc-400 text-sm mt-3 sm:mt-4 max-w-md leading-relaxed">Estamos para ayudarte. Para citas de barbería o solicitud de tatuaje, contáctanos por cualquiera de estas vías.</p>
    </div>
</section>

{{-- ═══ CONTACT INFO + MAP ═══ --}}
<section class="max-w-7xl mx-auto px-4 sm:px-6 py-12 sm:py-16">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-16">

        {{-- Left: contact info --}}
        <div class="space-y-6 sm:space-y-8">

            {{-- Phone --}}
            <div class="flex items-start gap-4">
                <div class="w-10 h-10 rounded bg-red-900/20 border border-red-900/30 flex items-center justify-center flex-shrink-0 mt-0.5">
                    <svg class="w-4 h-4 text-red-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                </div>
                <div>
                    <p class="text-xs tracking-widest uppercase text-zinc-500 mb-1">Teléfono</p>
                    @php $phones = collect($branches)->unique('phone'); @endphp
                    @foreach($phones as $branch)
                    <a href="tel:{{ preg_replace('/\s+/', '', $branch['phone']) }}" class="block text-white text-base sm:text-lg font-medium hover:text-red-700 transition-colors">{{ $branch['phone'] }}@if($phones->count() > 1)<span class="text-zinc-500 text-xs font-normal ml-2">{{ $branch['name'] }}</span>@endif</a>
                    @endforeach
                    <p class="text-zinc-400 text-xs mt-0.5">Llamadas y mensajes</p>
                </div>
            </div>

            {{-- WhatsApp --}}
            <div class="flex items-start gap-4">
                <div class="w-10 h-10 rounded flex items-center justify-center flex-shrink-0 mt-0.5" style="background-color:#25D366/15; background: rgba(37,211,102,0.12); border: 1px solid rgba(37,211,102,0.25);">
                    <svg class="w-4 h-4" fill="#25D366" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                </div>
                <div>
                    <p class="text-xs tracking-widest uppercase text-zinc-500 mb-1">WhatsApp</p>
                    <a href="https://wa.me/{{ $wa }}?text=Hola%2C%20he%20visto%20vuestra%20web%20y%20me%20gustar%C3%ADa%20pedir%20informaci%C3%B3n." target="_blank" rel="noopener"
                       class="text-white text-base sm:text-lg font-medium hover:text-green-500 transition-colors">
                        Escríbenos por WhatsApp
                    </a>
                    <p class="text-zinc-400 text-xs mt-0.5">Respuesta rápida</p>
                </div>
            </div>

            {{-- Email --}}
            <div class="flex items-start gap-4">
                <div class="w-10 h-10 rounded bg-zinc-900 border border-zinc-800 flex items-center justify-center flex-shrink-0 mt-0.5">
                    <svg class="w-4 h-4 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
                <div>
                    <p class="text-xs tracking-widest uppercase text-zinc-500 mb-1">Email</p>
                    <a href="mailto:{{ $email }}" class="text-white text-base sm:text-lg font-medium hover:text-red-700 transition-colors">{{ $email }}</a>
                    <p class="text-zinc-400 text-xs mt-0.5">Para consultas y colaboraciones</p>
                </div>
            </div>

            {{-- Address --}}
            <div class="flex items-start gap-4">
                <div class="w-10 h-10 rounded bg-zinc-900 border border-zinc-800 flex items-center justify-center flex-shrink-0 mt-0.5">
                    <svg class="w-4 h-4 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <div>
                    <p class="text-xs tracking-widest uppercase text-zinc-500 mb-1">2 Sucursales en Getafe</p>
                    <div class="space-y-3">
                        @foreach($branches as $branch)
                        <a href="#sucursales" class="block group">
                            <p class="text-white text-sm sm:text-base font-medium group-hover:text-red-700 transition-colors">{{ $branch['addr1'] }}</p>
                            <p class="text-zinc-400 text-sm">{{ $branch['addr2'] }}</p>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- CTA Buttons --}}
            <div class="flex flex-col sm:flex-row gap-3">
                <a href="tel:{{ preg_replace('/\s+/', '', $phone) }}"
                   class="flex items-center justify-center gap-2 bg-red-800 hover:bg-red-700 text-white text-xs tracking-widest uppercase px-5 py-3 transition-colors rounded flex-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    Llamar ahora
                </a>
                <a href="https://wa.me/{{ $wa }}?text=Hola%2C%20he%20visto%20vuestra%20web%20y%20me%20gustar%C3%ADa%20pedir%20informaci%C3%B3n." target="_blank" rel="noopener"
                   class="flex items-center justify-center gap-2 text-white text-xs tracking-widest uppercase px-5 py-3 transition-colors rounded flex-1 border border-zinc-700 hover:border-zinc-500"
                   style="background-color:rgba(37,211,102,0.12)">
                    <svg class="w-4 h-4" fill="#25D366" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    WhatsApp
                </a>
            </div>
        </div>

        {{-- Right: horario + CTAs --}}
        <div class="flex flex-col gap-4">

            {{-- Hours --}}
            <div class="bg-zinc-900 border border-zinc-800 rounded p-4 sm:p-5">
                <h3 class="text-xs tracking-widest uppercase text-zinc-400 mb-4">Horario</h3>
                <div class="space-y-2">
                    @foreach([
                        ['Lunes – Viernes', $hwday],
                        ['Sábado', $hsat],
                        ['Domingo', $hsun],
                    ] as [$day, $hours])
                    <div class="flex justify-between items-center">
                        <span class="text-zinc-400 text-sm">{{ $day }}</span>
                        <span class="text-sm {{ $hours === 'Cerrado' ? 'text-zinc-400' : 'text-white' }}">{{ $hours }}</span>
                    </div>
                    @if(!$loop->last)<div class="border-t border-zinc-800/60 my-1"></div>@endif
                    @endforeach
                </div>
            </div>

            {{-- CTAs grid --}}
            <div class="mt-2 grid grid-cols-1 sm:grid-cols-2 gap-3">

                {{-- Barbería CTA --}}
                <div class="group relative bg-red-900/10 border border-red-900/30 rounded-xl p-4 sm:p-5 hover:bg-red-900/15 hover:border-red-900/50 transition-all duration-300 overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-red-900/5 to-transparent pointer-events-none"></div>
                    <div class="relative">
                        <div class="flex items-center gap-2 mb-2">
                            <div class="w-6 h-6 rounded bg-red-800/30 flex items-center justify-center flex-shrink-0">
                                <svg class="w-3 h-3 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.121 14.121L19 19m-7-7l7-7m-7 7l-2.879 2.879M12 12L9.121 9.121m0 5.758a3 3 0 10-4.243 4.243 3 3 0 004.243-4.243zm0-5.758a3 3 0 10-4.243-4.243 3 3 0 004.243 4.243z"/></svg>
                            </div>
                            <span class="text-[9px] tracking-[0.35em] uppercase text-red-700/80">Barbería · Getafe</span>
                        </div>
                        <h3 class="font-heading text-lg sm:text-xl text-white mb-1.5 leading-tight">¿QUIERES UN<br>CORTE DE PELO?</h3>
                        <p class="text-zinc-500 text-[11px] leading-relaxed mb-3">Reserva online en Booksy en cualquiera de nuestras 2 sucursales.</p>
                        <a href="https://booksy.com/es-es/105117_leyenda-barberia_barberia_52975_getafe#ba_s=sr_1"
                           target="_blank" rel="noopener" x-on:click.prevent="$dispatch('open-booksy')"
                           class="inline-flex items-center gap-1.5 text-[10px] tracking-widest uppercase text-red-500 hover:text-red-400 transition-colors font-medium">
                            Reservar en Booksy
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    </div>
                </div>

                {{-- Tatuaje CTA --}}
                <div class="group relative bg-amber-900/10 border border-amber-900/25 rounded-xl p-4 sm:p-5 hover:bg-amber-900/15 hover:border-amber-900/45 transition-all duration-300 overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-amber-900/5 to-transparent pointer-events-none"></div>
                    <div class="relative">
                        <div class="flex items-center gap-2 mb-2">
                            <div class="w-6 h-6 rounded bg-amber-800/30 flex items-center justify-center flex-shrink-0">
                                <svg class="w-3 h-3 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                            </div>
                            <span class="text-[9px] tracking-[0.35em] uppercase text-amber-700/80">Tatuaje · Getafe</span>
                        </div>
                        <h3 class="font-heading text-lg sm:text-xl text-white mb-1.5 leading-tight">¿QUIERES UN<br>TATUAJE?</h3>
                        <p class="text-zinc-500 text-[11px] leading-relaxed mb-3">Rellena la solicitud y te respondemos en menos de 48h.</p>
                        <a href="{{ route('tatuajes') }}#solicitar"
                           class="inline-flex items-center gap-1.5 text-[10px] tracking-widest uppercase text-amber-500 hover:text-amber-400 transition-colors font-medium">
                            Solicitar consulta
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

{{-- ═══ SUCURSALES + MAPAS ═══ --}}
<section id="sucursales" class="max-w-7xl mx-auto px-4 sm:px-6 pb-4 scroll-mt-24">
    <div class="mb-8">
        <span class="text-[10px] tracking-[0.5em] uppercase text-zinc-400">Dónde estamos</span>
        <h2 class="font-heading text-4xl sm:text-5xl md:text-6xl text-white leading-none mt-1">NUESTRAS SUCURSALES</h2>
        <div class="h-0.5 w-12 bg-red-800 mt-4"></div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8">
        @foreach($branches as $i => $branch)
        <div class="group bg-zinc-950 border border-zinc-800 hover:border-zinc-700 rounded-xl overflow-hidden transition-colors">
            <div class="h-64 sm:h-80 w-full bg-zinc-900 border-b border-zinc-800">
                <iframe
                    src="{{ $branch['map'] }}"
                    width="100%"
                    height="100%"
                    style="border:0; filter: invert(90%) hue-rotate(180deg) brightness(0.85) contrast(0.9);"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    title="Ubicación de Leyenda Barber & Tattoo — {{ $branch['name'] }}"
                ></iframe>
            </div>
            <div class="p-5 sm:p-6 flex flex-col sm:flex-row sm:items-end sm:justify-between gap-5">
                <div>
                    <span class="text-[9px] tracking-[0.4em] uppercase text-red-700">Sucursal 0{{ $i + 1 }}</span>
                    <h3 class="font-heading text-2xl sm:text-3xl text-white leading-tight mt-0.5">{{ $branch['name'] }}</h3>
                    <p class="text-zinc-300 text-sm mt-2">{{ $branch['addr1'] }}</p>
                    <p class="text-zinc-500 text-sm">{{ $branch['addr2'] }}</p>
                    <div class="flex flex-wrap gap-x-4 gap-y-1 mt-3 text-xs">
                        <a href="tel:{{ preg_replace('/\s+/', '', $branch['phone']) }}" class="text-zinc-300 hover:text-red-600 transition-colors">{{ $branch['phone'] }}</a>
                        <a href="https://wa.me/{{ $branch['whatsapp'] }}" target="_blank" rel="noopener" class="text-zinc-300 hover:text-green-500 transition-colors">WhatsApp</a>
                    </div>
                </div>
                <div class="flex flex-row sm:flex-col gap-2 flex-shrink-0">
                    <a href="{{ $branch['booksy'] }}" target="_blank" rel="noopener"
                       class="flex-1 inline-flex items-center justify-center gap-2 bg-red-800 hover:bg-red-700 text-white text-[10px] tracking-widest uppercase px-4 py-2.5 rounded transition-colors btn-press">
                        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        Reservar
                    </a>
                    <a href="{{ $branch['directions'] }}" target="_blank" rel="noopener"
                       class="flex-1 inline-flex items-center justify-center gap-2 border border-zinc-700 hover:border-zinc-500 text-zinc-300 hover:text-white text-[10px] tracking-widest uppercase px-4 py-2.5 rounded transition-colors btn-press">
                        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
                        Cómo llegar
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

@endsection
