@extends('layouts.app')

@section('title', 'Política de Cookies — Leyenda Barber & Tattoo')
@section('meta_description', 'Política de cookies de Leyenda Barber & Tattoo. Qué cookies usamos, para qué y cómo gestionarlas.')

@section('content')
<section class="relative pt-28 sm:pt-32 pb-12 overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-b from-zinc-950 via-black to-black"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6">
        <span class="text-[10px] tracking-[0.5em] uppercase text-zinc-400">Legal · Leyenda</span>
        <h1 class="font-heading text-4xl sm:text-6xl md:text-7xl leading-none text-white mt-1">POLÍTICA DE<br>COOKIES</h1>
        <div class="h-0.5 w-16 bg-red-800 mt-3"></div>
    </div>
</section>

<section class="max-w-3xl mx-auto px-4 sm:px-6 py-12 sm:py-16">
    <div class="space-y-8 text-zinc-400 text-sm leading-relaxed">

        <div>
            <h2 class="font-heading text-2xl text-white mb-3">1. ¿QUÉ SON LAS COOKIES?</h2>
            <p>Las cookies son pequeños archivos de texto que los sitios web almacenan en tu dispositivo cuando los visitas. Permiten recordar tus preferencias y mejorar la experiencia de navegación.</p>
        </div>

        <div>
            <h2 class="font-heading text-2xl text-white mb-3">2. COOKIES QUE USAMOS</h2>

            {{-- Tabla cookies técnicas --}}
            <h3 class="text-white text-sm font-medium mb-3 mt-5">Cookies técnicas o esenciales <span class="text-zinc-600 text-xs font-normal">(no requieren consentimiento)</span></h3>
            <div class="overflow-x-auto rounded-xl border border-zinc-800">
                <table class="w-full text-xs">
                    <thead>
                        <tr class="border-b border-zinc-800 bg-zinc-900/60">
                            <th class="text-left text-zinc-400 font-medium px-4 py-3">Cookie</th>
                            <th class="text-left text-zinc-400 font-medium px-4 py-3">Finalidad</th>
                            <th class="text-left text-zinc-400 font-medium px-4 py-3">Duración</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-900">
                        <tr>
                            <td class="px-4 py-3 text-white font-mono">laravel_session</td>
                            <td class="px-4 py-3">Mantener la sesión del usuario (carrito de compra, formularios).</td>
                            <td class="px-4 py-3 text-zinc-500">Sesión</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3 text-white font-mono">XSRF-TOKEN</td>
                            <td class="px-4 py-3">Seguridad: protección contra ataques CSRF en formularios.</td>
                            <td class="px-4 py-3 text-zinc-500">Sesión</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3 text-white font-mono">leyenda_cookies</td>
                            <td class="px-4 py-3">Guardar tu preferencia de consentimiento de cookies.</td>
                            <td class="px-4 py-3 text-zinc-500">Permanente</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- Tabla cookies analíticas --}}
            <h3 class="text-white text-sm font-medium mb-3 mt-7">Cookies analíticas <span class="text-zinc-600 text-xs font-normal">(solo si aceptas)</span></h3>
            <div class="overflow-x-auto rounded-xl border border-zinc-800">
                <table class="w-full text-xs">
                    <thead>
                        <tr class="border-b border-zinc-800 bg-zinc-900/60">
                            <th class="text-left text-zinc-400 font-medium px-4 py-3">Cookie</th>
                            <th class="text-left text-zinc-400 font-medium px-4 py-3">Finalidad</th>
                            <th class="text-left text-zinc-400 font-medium px-4 py-3">Duración</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-900">
                        <tr>
                            <td class="px-4 py-3 text-white font-mono">_ga</td>
                            <td class="px-4 py-3">Google Analytics 4. Identifica usuarios únicos para estadísticas de visitas.</td>
                            <td class="px-4 py-3 text-zinc-500">2 años</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3 text-white font-mono">_ga_XXXXXX</td>
                            <td class="px-4 py-3">Google Analytics 4. Mantiene el estado de sesión para análisis.</td>
                            <td class="px-4 py-3 text-zinc-500">2 años</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <p class="text-xs text-zinc-600 mt-2">Responsable: Google LLC · <a href="https://policies.google.com/privacy" target="_blank" rel="noopener" class="hover:text-zinc-400 underline">Política de privacidad de Google</a></p>
        </div>

        <div>
            <h2 class="font-heading text-2xl text-white mb-3">3. CÓMO GESTIONAR TUS COOKIES</h2>
            <p>Puedes cambiar tu preferencia en cualquier momento pulsando el botón <strong class="text-white">"Gestionar cookies"</strong> que encontrarás al pie de todas las páginas del sitio web.</p>
            <p class="mt-3">También puedes configurar tu navegador para bloquear o eliminar cookies. Ten en cuenta que bloquear las cookies técnicas puede afectar al funcionamiento del carrito y los formularios.</p>
            <ul class="mt-3 space-y-1 list-disc list-inside">
                <li><a href="https://support.google.com/chrome/answer/95647" target="_blank" rel="noopener" class="text-red-600 hover:text-red-500 underline">Google Chrome</a></li>
                <li><a href="https://support.mozilla.org/es/kb/habilitar-y-deshabilitar-cookies" target="_blank" rel="noopener" class="text-red-600 hover:text-red-500 underline">Mozilla Firefox</a></li>
                <li><a href="https://support.apple.com/es-es/guide/safari/sfri11471/mac" target="_blank" rel="noopener" class="text-red-600 hover:text-red-500 underline">Safari</a></li>
                <li><a href="https://support.microsoft.com/es-es/microsoft-edge/eliminar-las-cookies-en-microsoft-edge" target="_blank" rel="noopener" class="text-red-600 hover:text-red-500 underline">Microsoft Edge</a></li>
            </ul>

            {{-- Panel de gestión inline --}}
            <div x-data class="mt-6 bg-zinc-900 border border-zinc-800 rounded-xl px-5 py-4">
                <p class="text-white text-sm font-medium mb-3">Tu preferencia actual</p>
                <div class="flex flex-col sm:flex-row gap-3">
                    <button x-on:click="localStorage.setItem('leyenda_cookies','accepted'); gtag('consent','update',{'analytics_storage':'granted','ad_storage':'denied','ad_user_data':'denied','ad_personalization':'denied'}); alert('Preferencia guardada: cookies analíticas activadas.');"
                            class="flex-1 text-[11px] tracking-widest uppercase bg-white text-black hover:bg-zinc-200 transition-colors px-4 py-2.5 rounded-lg font-medium">
                        Aceptar analíticas
                    </button>
                    <button x-on:click="localStorage.setItem('leyenda_cookies','rejected'); gtag('consent','update',{'analytics_storage':'denied','ad_storage':'denied','ad_user_data':'denied','ad_personalization':'denied'}); alert('Preferencia guardada: solo cookies esenciales.');"
                            class="flex-1 text-[11px] tracking-widest uppercase border border-zinc-700 hover:border-zinc-500 text-zinc-400 hover:text-white transition-colors px-4 py-2.5 rounded-lg">
                        Solo esenciales
                    </button>
                </div>
            </div>
        </div>

        <div>
            <h2 class="font-heading text-2xl text-white mb-3">4. MÁS INFORMACIÓN</h2>
            <p>Para cualquier consulta sobre esta política puedes contactarnos en <span class="text-white">anthony198216@gmail.com</span>. También puedes consultar nuestra <a href="{{ route('privacidad') }}" class="text-red-600 hover:text-red-500 underline">Política de Privacidad</a> y el <a href="{{ route('aviso-legal') }}" class="text-red-600 hover:text-red-500 underline">Aviso Legal</a>.</p>
        </div>

        <p class="text-zinc-600 text-xs border-t border-zinc-900 pt-6">Última actualización: {{ date('d/m/Y') }}</p>
    </div>
</section>
@endsection
