<?php

namespace Database\Seeders;

use App\Models\Barber;
use App\Models\BarberGallery;
use App\Models\Service;
use App\Models\TattooStyle;
use App\Models\TattooWork;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DemoSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedServices();
        $this->seedBarbers();
        $this->seedTattooStyles();
        $this->seedProducts();
    }

    private function seedServices(): void
    {
        if (Service::count() > 0) return;

        $services = [
            ['name' => 'Corte Clásico',       'description' => 'Corte a tijera o máquina con acabado impecable.',               'price' => 15, 'duration' => 30],
            ['name' => 'Arreglo de Barba',     'description' => 'Perfilado, degradado y definición total de la barba.',           'price' => 10, 'duration' => 20],
            ['name' => 'Corte + Barba',        'description' => 'El pack más solicitado. Transformación completa.',               'price' => 22, 'duration' => 50],
            ['name' => 'Afeitado Clásico',     'description' => 'Navaja, toalla caliente y aceites de acabado premium.',          'price' => 18, 'duration' => 40],
            ['name' => 'Degradado Premium',    'description' => 'Degradado técnico con definición milimétrica de contornos.',     'price' => 17, 'duration' => 35],
            ['name' => 'Corte Niños',          'description' => 'Corte para los más pequeños, tranquilo y sin prisas.',           'price' => 10, 'duration' => 25],
            ['name' => 'Tratamiento Capilar',  'description' => 'Hidratación profunda con productos de alta gama.',               'price' => 25, 'duration' => 45],
            ['name' => 'Coloración',           'description' => 'Tinte, mechas o decoloración. Consulta previa obligatoria.',     'price' => 40, 'duration' => 90],
        ];

        foreach ($services as $s) {
            Service::create($s);
        }
    }

    private function seedBarbers(): void
    {
        if (Barber::count() > 0) return;

        $barbers = [
            [
                'name'        => 'Carlos Mendoza',
                'role'        => 'Master Barber',
                'description' => 'Con más de 10 años de experiencia en barbería clásica, Carlos es el fundador de Leyenda. Especialista en degradados y arreglos de barba. Su precisión y dedicación hacen de cada visita una experiencia única.',
                'image'       => 'https://i.pravatar.cc/400?img=12',
                'active'      => true,
            ],
            [
                'name'        => 'Alejandro Torres',
                'role'        => 'Senior Barber',
                'description' => 'Experto en cortes modernos y estilos urbanos. Alejandro combina las técnicas más actuales con un estilo propio que ha convertido a sus clientes en seguidores incondicionales.',
                'image'       => 'https://i.pravatar.cc/400?img=15',
                'active'      => true,
            ],
            [
                'name'        => 'Marcos Gil',
                'role'        => 'Barber & Colorist',
                'description' => 'Especialista en coloración masculina y técnicas de decoloración. Marcos domina los degradados y los estilos más atrevidos. Si buscas diferenciarte, Marcos es tu barbero.',
                'image'       => 'https://i.pravatar.cc/400?img=18',
                'active'      => true,
            ],
            [
                'name'        => 'Daniel Vega',
                'role'        => 'Junior Barber',
                'description' => 'El más joven del equipo pero con un talento innato para los cortes clásicos y el afeitado a navaja. Formado en las mejores academias, Daniel aporta frescura y técnica al estudio.',
                'image'       => 'https://i.pravatar.cc/400?img=22',
                'active'      => true,
            ],
        ];

        foreach ($barbers as $data) {
            $barber = Barber::create($data);
            $this->seedBarberGallery($barber);
        }
    }

    private function seedBarberGallery(Barber $barber): void
    {
        $galleryImages = [
            "https://picsum.photos/seed/{$barber->id}g1/600/800",
            "https://picsum.photos/seed/{$barber->id}g2/600/800",
            "https://picsum.photos/seed/{$barber->id}g3/600/800",
            "https://picsum.photos/seed/{$barber->id}g4/600/800",
            "https://picsum.photos/seed/{$barber->id}g5/600/800",
        ];

        $titles = ['Degradado Premium', 'Corte Clásico', 'Fade Perfecto', 'Barba Perfilada', 'Look Urbano'];

        foreach ($galleryImages as $i => $img) {
            BarberGallery::create([
                'barber_id' => $barber->id,
                'title'     => $titles[$i],
                'image'     => $img,
            ]);
        }
    }

    private function seedTattooStyles(): void
    {
        if (TattooStyle::count() > 0) return;

        $styles = [
            [
                'name'        => 'Blackwork',
                'description' => 'Geometría pura, sombras profundas y contraste extremo. El estilo Blackwork se basa en tinta negra sólida para crear diseños de alto impacto visual.',
                'image'       => 'https://picsum.photos/seed/blackwork/800/600',
            ],
            [
                'name'        => 'Realismo',
                'description' => 'Detalle fotográfico, retratos y escenas de la vida real reproducidas con una precisión extraordinaria. Requiere altísima técnica y experiencia.',
                'image'       => 'https://picsum.photos/seed/realismo/800/600',
            ],
            [
                'name'        => 'Fine Line',
                'description' => 'Trazos delicados, líneas finas y elegancia en su máxima expresión. Ideal para diseños minimalistas y botanicals. Precisión absoluta.',
                'image'       => 'https://picsum.photos/seed/fineline/800/600',
            ],
            [
                'name'        => 'Japonés',
                'description' => 'Tradición oriental con dragones, koi, flores y máscaras. Composiciones grandes y equilibradas que narran historias ancestrales.',
                'image'       => 'https://picsum.photos/seed/japones/800/600',
            ],
            [
                'name'        => 'Neo Traditional',
                'description' => 'Color vibrante, grosor variable y composiciones modernas que reinterpretan los clásicos del tatuaje americano con una visión contemporánea.',
                'image'       => 'https://picsum.photos/seed/neotraditional/800/600',
            ],
            [
                'name'        => 'Acuarela',
                'description' => 'Colores que fluyen libremente, sin contornos definidos, como una pintura sobre la piel. Cada pieza es irrepetible por naturaleza.',
                'image'       => 'https://picsum.photos/seed/acuarela/800/600',
            ],
        ];

        foreach ($styles as $style) {
            $s = TattooStyle::create($style);
            $this->seedTattooWorks($s);
        }
    }

    private function seedTattooWorks(TattooStyle $style): void
    {
        $worksByStyle = [
            'Blackwork'       => ['Mandala Geométrico', 'Serpiente Tribal', 'Lobo Blackout', 'Ojo Sagrado', 'Escarabajo Solar'],
            'Realismo'        => ['Retrato Familiar', 'León Majestuoso', 'Ojo Hiperrealista', 'Manos Entrelazadas', 'Rosa Detallada'],
            'Fine Line'       => ['Ramo Botánico', 'Mariposa Minimalista', 'Constelación', 'Montañas Finas', 'Luna y Flores'],
            'Japonés'         => ['Dragón Imperial', 'Carpa Koi', 'Oni Mask', 'Peonía Tradicional', 'Tigre Japonés'],
            'Neo Traditional' => ['Zorro Moderno', 'Calavera Colorida', 'Búho Neo', 'Pantera Rosa', 'Cabeza de Toro'],
            'Acuarela'        => ['Galaxia Acuarela', 'Colibrí Libre', 'Aurora Boreal', 'Ballena Cósmica', 'Lobo Acuarela'],
        ];

        $works = $worksByStyle[$style->name] ?? ['Trabajo Destacado 1', 'Trabajo Destacado 2', 'Trabajo Destacado 3', 'Trabajo Destacado 4', 'Trabajo Destacado 5'];

        foreach ($works as $i => $title) {
            TattooWork::create([
                'tattoo_style_id' => $style->id,
                'title'           => $title,
                'image'           => "https://picsum.photos/seed/{$style->name}{$i}/600/800",
                'description'     => "Trabajo en estilo {$style->name}. Pieza única realizada en el estudio Leyenda.",
            ]);
        }
    }

    private function seedProducts(): void
    {

        $products = [
            [
                'name'         => 'Pomada Fuerte Hold',
                'description'  => 'Pomada de fijación fuerte con acabado brillante. Fórmula a base de agua, fácil de lavar. Ideal para looks estructurados y duraderos.',
                'price'        => 18.99,
                'images'       => ['https://picsum.photos/seed/pomada1/600/800'],
                'size_options' => null,
                'stock'        => 25,
            ],
            [
                'name'         => 'Cera Mate Premium',
                'description'  => 'Cera de acabado mate con fijación media. Texturiza y define sin brillos. Producto profesional disponible en dos tamaños.',
                'price'        => 16.50,
                'images'       => ['https://picsum.photos/seed/cera1/600/800'],
                'size_options' => null,
                'stock'        => 18,
            ],
            [
                'name'         => 'Aceite de Barba Signature',
                'description'  => 'Mezcla exclusiva de aceites naturales para hidratación y suavidad de la barba. Aroma amaderado con notas de cedro y sándalo.',
                'price'        => 22.00,
                'images'       => ['https://picsum.photos/seed/aceite1/600/800'],
                'size_options' => null,
                'stock'        => 20,
            ],
            [
                'name'         => 'Camiseta Leyenda OG',
                'description'  => 'Camiseta premium 100% algodón con el logo Leyenda bordado. Disponible en Negro y Blanco. Corte recto y cuello redondo reforzado.',
                'price'        => 29.00,
                'images'       => ['https://picsum.photos/seed/camiseta1/600/800'],
                'size_options' => ['XS', 'S', 'M', 'L', 'XL', 'XXL'],
                'stock'        => 40,
            ],
            [
                'name'         => 'Hoodie Studio',
                'description'  => 'Sudadera con capucha en algodón orgánico. Logo serigrafíado en el pecho. Ideal para llevar el espíritu del estudio contigo.',
                'price'        => 55.00,
                'images'       => ['https://picsum.photos/seed/hoodie1/600/800'],
                'size_options' => ['S', 'M', 'L', 'XL'],
                'stock'        => 15,
            ],
            [
                'name'         => 'Gorra Snapback',
                'description'  => 'Gorra snapback con parche bordado del logo Leyenda. Ajuste universal, color negro con detalles dorados.',
                'price'        => 22.00,
                'images'       => ['https://picsum.photos/seed/gorra1/600/800'],
                'size_options' => null,
                'stock'        => 30,
            ],
            [
                'name'         => 'Kit Cuidado Barba',
                'description'  => 'Pack completo: aceite de barba, bálsamo hidratante y peine de madera. El regalo perfecto para el hombre que cuida su imagen.',
                'price'        => 45.00,
                'images'       => ['https://picsum.photos/seed/kitbarba/600/800'],
                'size_options' => null,
                'stock'        => 10,
            ],
            [
                'name'         => 'Bálsamo Hidratante Barba',
                'description'  => 'Bálsamo de manteca de karité y aceite de argán para domar y suavizar la barba más rebelde. Sin parabenos ni siliconas.',
                'price'        => 14.99,
                'images'       => ['https://picsum.photos/seed/balsamo1/600/800'],
                'size_options' => null,
                'stock'        => 22,
            ],
            [
                'name'         => 'Spray Volumen Capilar',
                'description'  => 'Spray de volumen y fijación ligera. Ideal para cabellos finos que necesitan cuerpo sin pesadez. Uso profesional.',
                'price'        => 19.50,
                'images'       => ['https://picsum.photos/seed/spray1/600/800'],
                'size_options' => null,
                'stock'        => 12,
            ],
            [
                'name'         => 'Navaja Afeitado Clásico',
                'description'  => 'Navaja de afeitar de acero inoxidable con mango de madera. Incluye 5 hojas de repuesto. Para el aficionado al afeitado tradicional.',
                'price'        => 38.00,
                'images'       => ['https://picsum.photos/seed/navaja1/600/800'],
                'size_options' => null,
                'stock'        => 8,
            ],
            [
                'name'         => 'Tote Bag Leyenda',
                'description'  => 'Bolsa de tela 100% algodón con el diseño gráfico Leyenda. Resistente y reutilizable. Negra con estampado en blanco.',
                'price'        => 12.00,
                'images'       => ['https://picsum.photos/seed/totebag/600/800'],
                'size_options' => null,
                'stock'        => 50,
            ],
            [
                'name'         => 'Crema Post-Afeitado',
                'description'  => 'Crema calmante y regeneradora para después del afeitado. Con aloe vera y vitamina E. Reduce irritaciones y deja la piel suave.',
                'price'        => 13.50,
                'images'       => ['https://picsum.photos/seed/crema1/600/800'],
                'size_options' => null,
                'stock'        => 28,
            ],
        ];

        foreach ($products as $p) {
            Product::firstOrCreate(['name' => $p['name']], $p);
        }
    }
}
