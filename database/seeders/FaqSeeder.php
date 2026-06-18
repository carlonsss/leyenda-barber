<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            // BARBERÍA
            ['section' => 'barberia', 'sort_order' => 1,
             'question' => '¿Dónde está la barbería Leyenda en Getafe?',
             'answer'   => 'Estamos en Getafe, al sur de Madrid, con fácil acceso en transporte público. Puedes ver la dirección exacta y el mapa en nuestra sección de contacto. Somos la barbería de referencia en Getafe para peluquería masculina.'],

            ['section' => 'barberia', 'sort_order' => 2,
             'question' => '¿Cuánto cuesta un corte de pelo en Getafe?',
             'answer'   => 'Los precios varían según el servicio: corte clásico, degradado o arreglo de barba. Puedes ver la tarifa completa en la sección de servicios o preguntarnos directamente por WhatsApp. Ofrecemos la mejor peluquería masculina en Getafe y Madrid con una relación calidad-precio difícil de igualar.'],

            ['section' => 'barberia', 'sort_order' => 3,
             'question' => '¿Se necesita cita previa en la barbería?',
             'answer'   => 'Sí, recomendamos reservar cita para garantizarte tu turno y evitar esperas. Puedes hacerlo de forma rápida y sencilla desde Booksy. También puedes escribirnos por WhatsApp si prefieres atención directa.'],

            ['section' => 'barberia', 'sort_order' => 4,
             'question' => '¿Qué tipo de cortes hacéis? ¿Fade, degradados, clásicos?',
             'answer'   => 'Dominamos todos los estilos: fades americanos, degradados en Getafe a máquina, cortes clásicos con tijera, diseño y arreglo de barba, y afeitado a navaja. Nuestros barberos se forman continuamente para ofrecerte los acabados más actuales.'],

            ['section' => 'barberia', 'sort_order' => 5,
             'question' => '¿Cuánto tarda un corte de pelo?',
             'answer'   => 'Un corte estándar dura entre 30 y 40 minutos. Si incluyes arreglo de barba o acabados especiales puede llegar a los 60 minutos. Reservando cita no tendrás que esperar: entras, te atendemos y sales impecable.'],

            ['section' => 'barberia', 'sort_order' => 6,
             'question' => '¿Usáis productos profesionales?',
             'answer'   => 'Sí. Trabajamos exclusivamente con productos profesionales de alta gama para el cabello y la barba. La calidad del producto importa tanto como la técnica: por eso el resultado de tu corte dura más y se ve mejor.'],

            // TATUAJES
            ['section' => 'tatuajes', 'sort_order' => 1,
             'question' => '¿Duele hacerse un tatuaje?',
             'answer'   => 'Depende de la zona y la tolerancia de cada persona. Zonas carnosas como el brazo o el muslo son más llevaderas; costillas o manos pueden ser más intensas. Nuestros tatuadores trabajan con ritmo y descansos para que la experiencia sea lo más cómoda posible.'],

            ['section' => 'tatuajes', 'sort_order' => 2,
             'question' => '¿Cuánto cuesta un tatuaje en Getafe?',
             'answer'   => 'El precio de un tatuaje en nuestro estudio de tatuajes en Getafe depende del tamaño, complejidad y estilo. Los tatuajes pequeños tienen precio cerrado; los grandes se presupuestan por sesión o por hora. Consúltanos sin compromiso y te hacemos un presupuesto personalizado.'],

            ['section' => 'tatuajes', 'sort_order' => 3,
             'question' => '¿Necesito pedir cita para tatuarme?',
             'answer'   => 'Sí. Para tatuajes siempre trabajamos con cita previa. Esto nos permite preparar el diseño con antelación y dedicarte el tiempo que merece tu proyecto. Escríbenos por WhatsApp o usa el formulario de contacto para reservar tu consulta.'],

            ['section' => 'tatuajes', 'sort_order' => 4,
             'question' => '¿Qué estilos de tatuajes hacéis?',
             'answer'   => 'Somos especialistas en realismo, blackwork, fine line y tatuajes personalizados. Como tatuador en Madrid y Getafe, nuestro equipo adapta cada diseño a tu piel y personalidad. También hacemos retoques y coberturas de tatuajes anteriores.'],

            ['section' => 'tatuajes', 'sort_order' => 5,
             'question' => '¿Cuánto tarda una sesión de tatuaje?',
             'answer'   => 'Una sesión estándar dura entre 2 y 5 horas según el tamaño y detalle del diseño. Los proyectos grandes se dividen en varias sesiones para garantizar la calidad y el bienestar. Al reservar te informamos del tiempo estimado para tu tatuaje.'],

            ['section' => 'tatuajes', 'sort_order' => 6,
             'question' => '¿Cómo cuido un tatuaje después de hacerlo?',
             'answer'   => 'Tras la sesión te damos instrucciones detalladas de cuidado. En general: mantener la zona limpia e hidratada, evitar el sol directo durante la cicatrización, no rascar ni sumergir en agua. Un buen cuidado es clave para que tu tatuaje personalizado conserve sus colores y líneas con el tiempo.'],

            // TIENDA
            ['section' => 'tienda', 'sort_order' => 1,
             'question' => '¿La ropa tiene envío o solo recogida en tienda?',
             'answer'   => 'Puedes recoger tu pedido directamente en nuestra tienda en Getafe, en el mismo local de Leyenda Barber & Tattoo. Si tienes dudas sobre disponibilidad o quieres reservar una prenda, escríbenos por WhatsApp y te lo gestionamos.'],

            ['section' => 'tienda', 'sort_order' => 2,
             'question' => '¿Cómo me avisáis cuando el pedido está listo?',
             'answer'   => 'Una vez confirmado tu pedido recibirás un aviso por email o WhatsApp con todos los detalles. Así sabrás exactamente cuándo y cómo pasar a recogerlo sin sorpresas.'],

            ['section' => 'tienda', 'sort_order' => 3,
             'question' => '¿Cuál es el horario para recoger mi pedido?',
             'answer'   => 'Puedes pasar a recoger tu pedido de lunes a sábado de 10:00 a 20:00. Cerramos domingos y festivos. Si necesitas otro horario, escríbenos y buscamos una solución.'],

            ['section' => 'tienda', 'sort_order' => 4,
             'question' => '¿Cómo elijo mi talla correctamente?',
             'answer'   => 'Cada prenda tiene su guía de tallas en la ficha de producto. Nuestra ropa streetwear sigue un tallaje estándar europeo. Si tienes dudas entre dos tallas, escríbenos y te asesoramos según el ajuste que buscas.'],

            ['section' => 'tienda', 'sort_order' => 5,
             'question' => '¿Qué hago si no me queda bien la prenda?',
             'answer'   => 'Contáctanos por WhatsApp o pásate por la tienda y lo gestionamos. Trabajamos para que estés satisfecho con tu compra de nuestra marca de ropa urbana en Madrid. La mejor atención está a un mensaje de distancia.'],

            ['section' => 'tienda', 'sort_order' => 6,
             'question' => '¿Cada cuánto sacáis nuevas colecciones?',
             'answer'   => 'Lanzamos colecciones por temporada y drops especiales a lo largo del año. Síguenos en redes sociales para ser el primero en enterarte de cada novedad. Nuestro streetwear en Getafe se agota rápido, especialmente en drops limitados.'],

            ['section' => 'tienda', 'sort_order' => 7,
             'question' => '¿Los productos son de edición limitada?',
             'answer'   => 'Sí. Muchos de nuestros drops son de producción limitada, lo que garantiza exclusividad. Una vez que se agotan, no vuelven. Si ves algo que te gusta en nuestra tienda, no esperes demasiado.'],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
