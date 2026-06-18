@extends('layouts.app')

@section('title', 'Aviso Legal — Leyenda Barber & Tattoo')
@section('meta_description', 'Aviso legal de Leyenda Barber & Tattoo. Información sobre el titular del sitio web, condiciones de uso y propiedad intelectual.')

@section('content')
<section class="relative pt-28 sm:pt-32 pb-12 overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-b from-zinc-950 via-black to-black"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6">
        <span class="text-[10px] tracking-[0.5em] uppercase text-zinc-400">Legal · Leyenda</span>
        <h1 class="font-heading text-5xl sm:text-6xl md:text-7xl leading-none text-white mt-1">AVISO LEGAL</h1>
        <div class="h-0.5 w-16 bg-red-800 mt-3"></div>
    </div>
</section>

<section class="max-w-3xl mx-auto px-4 sm:px-6 py-12 sm:py-16">
    <div class="prose prose-invert prose-zinc max-w-none space-y-8 text-zinc-400 text-sm leading-relaxed">

        <div>
            <h2 class="font-heading text-2xl text-white mb-3">1. TITULAR DEL SITIO WEB</h2>
            <p>En cumplimiento de la Ley 34/2002, de 11 de julio, de Servicios de la Sociedad de la Información y de Comercio Electrónico (LSSI-CE), se informa:</p>
            <ul class="mt-3 space-y-1.5 list-none pl-0">
                <li><span class="text-zinc-500">Titular:</span> <span class="text-white">Antonio Marte Espinal</span></li>
                <li><span class="text-zinc-500">DNI / NIF / CIF:</span> <span class="text-white">50227358G</span></li>
                <li><span class="text-zinc-500">Domicilio:</span> <span class="text-white">Av. del Ingenioso Hidalgo, n.º 3, 28906 Getafe, Madrid, España</span></li>
                <li><span class="text-zinc-500">Email:</span> <span class="text-white">anthony198216@gmail.com</span></li>
                <li><span class="text-zinc-500">Dominio:</span> <span class="text-white">leyendabarber.es</span></li>
                <li><span class="text-zinc-500">Actividad:</span> <span class="text-white">Barbería, estudio de tatuajes y venta de ropa</span></li>
            </ul>
        </div>

        <div>
            <h2 class="font-heading text-2xl text-white mb-3">2. OBJETO Y CONDICIONES DE USO</h2>
            <p>El presente Aviso Legal regula el acceso y uso del sitio web <strong class="text-white">leyendabarber.es</strong> (en adelante, "el Sitio Web"), del que es titular la persona identificada en el apartado anterior.</p>
            <p class="mt-3">El acceso al Sitio Web implica la aceptación plena y sin reservas de las presentes condiciones. El titular se reserva el derecho a modificar el contenido del Sitio Web, así como las presentes condiciones, en cualquier momento y sin previo aviso.</p>
        </div>

        <div>
            <h2 class="font-heading text-2xl text-white mb-3">3. PROPIEDAD INTELECTUAL E INDUSTRIAL</h2>
            <p>Todos los contenidos del Sitio Web — textos, imágenes, logotipos, diseño gráfico, código fuente y demás elementos — son titularidad del titular o de terceros que han autorizado su uso. Queda expresamente prohibida su reproducción, distribución, comunicación pública o transformación sin autorización previa y por escrito.</p>
            <p class="mt-3">El nombre <strong class="text-white">Leyenda Barber & Tattoo</strong>, su logotipo y demás signos distintivos son marcas del titular. Su uso sin autorización constituye una infracción de los derechos del titular.</p>
        </div>

        <div>
            <h2 class="font-heading text-2xl text-white mb-3">4. EXCLUSIÓN DE RESPONSABILIDAD</h2>
            <p>El titular no garantiza la disponibilidad continuada del Sitio Web ni que esté libre de errores. El acceso al Sitio Web es bajo responsabilidad exclusiva del usuario. El titular queda exonerado de cualquier responsabilidad derivada de daños o perjuicios de cualquier naturaleza producidos por la imposibilidad de acceso al Sitio Web o por los contenidos alojados en sitios de terceros a los que se enlace desde éste.</p>
        </div>

        <div>
            <h2 class="font-heading text-2xl text-white mb-3">5. LEGISLACIÓN APLICABLE Y JURISDICCIÓN</h2>
            <p>Las presentes condiciones se rigen por la legislación española. Para la resolución de cualquier controversia derivada del acceso o uso del Sitio Web, el titular y el usuario se someten a los Juzgados y Tribunales de <strong class="text-white">Getafe (Madrid)</strong>, con renuncia expresa a cualquier otro fuero que pudiera corresponderles.</p>
        </div>

        <p class="text-zinc-600 text-xs border-t border-zinc-900 pt-6">Última actualización: {{ date('d/m/Y') }}</p>
    </div>
</section>
@endsection
