{{--
    Botones por sucursal, todos del mismo tamaño.
    Uso: @include('partials.booksy-branches', ['type' => 'barberia|tatuajes|ropa', 'compact' => true, 'width' => 'w-full'])
--}}
@php
    $compact = $compact ?? false;
    $type    = $type ?? 'barberia';
    $width   = $width ?? ($compact ? 'max-w-xs' : 'sm:w-[380px]');
    $styles  = [
        'barberia' => ['btn' => 'bg-red-800 hover:bg-red-700',     'sub' => 'text-red-200/70',   'label' => 'Reservar'],
        'tatuajes' => ['btn' => 'bg-amber-700 hover:bg-amber-600', 'sub' => 'text-amber-100/70', 'label' => 'WhatsApp'],
        'ropa'     => ['btn' => 'bg-zinc-700 hover:bg-zinc-600',   'sub' => 'text-zinc-300/70',  'label' => 'Recoger en'],
    ][$type];
    $waText = 'Hola%2C%20he%20visto%20vuestra%20web%20y%20me%20gustar%C3%ADa%20pedir%20informaci%C3%B3n%20sobre%20un%20tatuaje.';
@endphp
<div class="grid grid-cols-1 gap-2.5 w-full {{ $width }}">
    @foreach(\App\Models\SiteSetting::branches() as $i => $branch)
    @php
        $href = match ($type) {
            'tatuajes' => 'https://wa.me/' . $branch['whatsapp_tattoo'] . '?text=' . $waText,
            'ropa'     => route('tienda', ['sucursal' => $i + 1]),
            default    => $branch['booksy'],
        };
    @endphp
    <a href="{{ $href }}" @if($type !== 'ropa') target="_blank" rel="noopener" @endif
       class="group flex items-center gap-3 {{ $styles['btn'] }} text-white rounded transition-colors btn-press {{ $compact ? 'px-4 py-2.5' : 'px-5 sm:px-6 py-4' }}">
        @if($type === 'tatuajes')
        <svg class="{{ $compact ? 'w-4 h-4' : 'w-5 h-5' }} flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
        @elseif($type === 'ropa')
        <svg class="{{ $compact ? 'w-4 h-4' : 'w-5 h-5' }} flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
        @else
        <svg class="{{ $compact ? 'w-4 h-4' : 'w-5 h-5' }} flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        @endif
        <span class="flex-1 min-w-0 text-left">
            <span class="block text-[9px] tracking-[0.3em] uppercase {{ $styles['sub'] }}">{{ $styles['label'] }} · Sucursal 0{{ $i + 1 }}</span>
            <span class="block truncate {{ $compact ? 'text-xs' : 'text-sm' }} tracking-widest uppercase font-medium mt-0.5">{{ $branch['name'] }}</span>
            @unless($compact)
            <span class="block truncate text-[11px] {{ $styles['sub'] }} mt-0.5">{{ $branch['addr1'] }}</span>
            @endunless
        </span>
        <svg class="w-4 h-4 flex-shrink-0 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
    </a>
    @endforeach
</div>
