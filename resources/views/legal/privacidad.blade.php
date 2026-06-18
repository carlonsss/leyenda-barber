@extends('layouts.app')

@section('title', 'Política de Privacidad — Leyenda Barber & Tattoo')
@section('meta_description', 'Política de privacidad de Leyenda Barber & Tattoo. Cómo tratamos tus datos personales conforme al RGPD y la LOPDGDD.')

@section('content')
<section class="relative pt-28 sm:pt-32 pb-12 overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-b from-zinc-950 via-black to-black"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6">
        <span class="text-[10px] tracking-[0.5em] uppercase text-zinc-400">Legal · Leyenda</span>
        <h1 class="font-heading text-4xl sm:text-6xl md:text-7xl leading-none text-white mt-1">POLÍTICA DE<br>PRIVACIDAD</h1>
        <div class="h-0.5 w-16 bg-red-800 mt-3"></div>
    </div>
</section>

<section class="max-w-3xl mx-auto px-4 sm:px-6 py-12 sm:py-16">
    <div class="space-y-8 text-zinc-400 text-sm leading-relaxed">

        <div>
            <h2 class="font-heading text-2xl text-white mb-3">1. RESPONSABLE DEL TRATAMIENTO</h2>
            <ul class="space-y-1.5 list-none pl-0">
                <li><span class="text-zinc-500">Responsable:</span> <span class="text-white">Antonio Marte Espinal</span></li>
                <li><span class="text-zinc-500">DNI / NIF:</span> <span class="text-white">50227358G</span></li>
                <li><span class="text-zinc-500">Dirección:</span> <span class="text-white">Av. del Ingenioso Hidalgo, n.º 3, 28906 Getafe, Madrid</span></li>
                <li><span class="text-zinc-500">Email:</span> <span class="text-white">anthony198216@gmail.com</span></li>
            </ul>
        </div>

        <div>
            <h2 class="font-heading text-2xl text-white mb-3">2. DATOS QUE RECOGEMOS Y CON QUÉ FINALIDAD</h2>

            <div class="space-y-5">
                <div class="border border-zinc-800 rounded-xl p-4">
                    <h3 class="text-white text-sm font-medium mb-2">Formulario de solicitud de tatuaje</h3>
                    <p class="text-xs">Datos: nombre, email, teléfono, zona corporal, estilo, presupuesto e idea.</p>
                    <p class="text-xs mt-1"><span class="text-zinc-500">Finalidad:</span> Gestionar tu solicitud y contactarte para concertar una cita.</p>
                    <p class="text-xs mt-1"><span class="text-zinc-500">Base legal:</span> Ejecución de un precontrato (Art. 6.1.b RGPD).</p>
                    <p class="text-xs mt-1"><span class="text-zinc-500">Conservación:</span> Hasta que finalice la relación comercial o solicites su supresión.</p>
                </div>

                <div class="border border-zinc-800 rounded-xl p-4">
                    <h3 class="text-white text-sm font-medium mb-2">Pedidos de tienda</h3>
                    <p class="text-xs">Datos: nombre, email y teléfono.</p>
                    <p class="text-xs mt-1"><span class="text-zinc-500">Finalidad:</span> Gestionar el pedido de ropa y coordinar la recogida en tienda.</p>
                    <p class="text-zinc-500 text-xs mt-1"><span class="text-zinc-500">Base legal:</span> Ejecución del contrato de compraventa (Art. 6.1.b RGPD).</p>
                    <p class="text-xs mt-1"><span class="text-zinc-500">Conservación:</span> El tiempo exigido por la normativa fiscal y mercantil (mínimo 5 años).</p>
                </div>

                <div class="border border-zinc-800 rounded-xl p-4">
                    <h3 class="text-white text-sm font-medium mb-2">Analítica web (Google Analytics 4)</h3>
                    <p class="text-xs">Datos: datos de navegación anonimizados (páginas visitadas, tiempo de visita, dispositivo).</p>
                    <p class="text-xs mt-1"><span class="text-zinc-500">Finalidad:</span> Medir el rendimiento del sitio web y mejorar la experiencia de usuario.</p>
                    <p class="text-xs mt-1"><span class="text-zinc-500">Base legal:</span> Consentimiento del usuario (Art. 6.1.a RGPD). Solo se activa si aceptas las cookies analíticas.</p>
                    <p class="text-xs mt-1"><span class="text-zinc-500">Responsable del servicio:</span> Google LLC. Consulta su <a href="https://policies.google.com/privacy" target="_blank" rel="noopener" class="text-red-600 hover:text-red-500 underline">política de privacidad</a>.</p>
                </div>
            </div>
        </div>

        <div>
            <h2 class="font-heading text-2xl text-white mb-3">3. CESIÓN DE DATOS A TERCEROS</h2>
            <p>No cedemos tus datos personales a terceros salvo obligación legal o para la prestación del servicio (Google Analytics 4, únicamente si has prestado consentimiento). No realizamos transferencias internacionales de datos fuera del Espacio Económico Europeo salvo las inherentes al uso de Google LLC, cubierto por el Marco de Privacidad de Datos UE-EE.UU.</p>
        </div>

        <div>
            <h2 class="font-heading text-2xl text-white mb-3">4. TUS DERECHOS (ARCO+)</h2>
            <p>Puedes ejercer en cualquier momento los siguientes derechos dirigiéndote a <span class="text-white">anthony198216@gmail.com</span>:</p>
            <ul class="mt-3 space-y-1 list-disc list-inside text-zinc-400">
                <li><span class="text-white">Acceso</span> — saber qué datos tuyos tratamos.</li>
                <li><span class="text-white">Rectificación</span> — corregir datos inexactos.</li>
                <li><span class="text-white">Supresión</span> — solicitar que borremos tus datos.</li>
                <li><span class="text-white">Oposición</span> — oponerte al tratamiento.</li>
                <li><span class="text-white">Limitación</span> — restringir el tratamiento en ciertos supuestos.</li>
                <li><span class="text-white">Portabilidad</span> — recibir tus datos en formato estructurado.</li>
            </ul>
            <p class="mt-3">Asimismo, tienes derecho a presentar una reclamación ante la <a href="https://www.aepd.es" target="_blank" rel="noopener" class="text-red-600 hover:text-red-500 underline">Agencia Española de Protección de Datos (AEPD)</a>.</p>
        </div>

        <div>
            <h2 class="font-heading text-2xl text-white mb-3">5. SEGURIDAD</h2>
            <p>Aplicamos medidas técnicas y organizativas adecuadas para proteger tus datos frente a accesos no autorizados, pérdida o divulgación, en cumplimiento del RGPD y la LOPDGDD.</p>
        </div>

        <p class="text-zinc-600 text-xs border-t border-zinc-900 pt-6">Última actualización: {{ date('d/m/Y') }}</p>
    </div>
</section>
@endsection
