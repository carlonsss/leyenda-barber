<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Limpia productos demo anteriores (pomadas/aceites) si existen
        if (Product::where('name', 'Pomada Fuerte Hold')->exists()) {
            DB::table('order_items')->whereIn('product_id', Product::pluck('id'))->delete();
            Product::query()->delete();
        }

        $products = [
            // ── NEW DROP + DESTACADOS ─────────────────────────────────────
            [
                'name'        => 'Camiseta Signature Black',
                'description' => 'Nuestro básico esencial. 100% algodón peinado 200g/m². Corte recto, cuello redondo reforzado y logo Leyenda bordado en el pecho. Disponible en negro.',
                'price'       => 35,
                'images'      => [
                    'https://picsum.photos/seed/ld-tee-black-a/600/800',
                    'https://picsum.photos/seed/ld-tee-black-b/600/800',
                ],
                'size_options' => ['S', 'M', 'L', 'XL'],
                'stock'       => 48,
                'is_new'      => true,
                'is_featured' => true,
            ],
            [
                'name'        => 'Hoodie Barber Classic',
                'description' => 'Sudadera con capucha en felpa francesa 320g/m². Bolsillo canguro, cordones planos y parche tejido Leyenda en el pecho. Negra, corte oversize.',
                'price'       => 65,
                'images'      => [
                    'https://picsum.photos/seed/ld-hoodie-a/600/800',
                    'https://picsum.photos/seed/ld-hoodie-b/600/800',
                ],
                'size_options' => ['S', 'M', 'L', 'XL'],
                'stock'       => 30,
                'is_new'      => true,
                'is_featured' => true,
            ],
            [
                'name'        => 'Camiseta Oversize Drop',
                'description' => 'Corte oversize con hombro caído. Algodón orgánico 180g/m². Serigrafía frontal con el logo Leyenda y "Est. Getafe" en la manga. Edición limitada.',
                'price'       => 32,
                'images'      => [
                    'https://picsum.photos/seed/ld-oversized-a/600/800',
                    'https://picsum.photos/seed/ld-oversized-b/600/800',
                ],
                'size_options' => ['S', 'M', 'L', 'XL'],
                'stock'       => 22,
                'is_new'      => true,
                'is_featured' => false,
            ],
            // ── DESTACADOS ────────────────────────────────────────────────
            [
                'name'        => 'Sudadera Crewneck Studio',
                'description' => 'Crewneck en felpa cepillada 280g/m². Acabado vintage, ribetes acanalados y gráfico "Leyenda Studio" en espalda. Imprescindible de temporada.',
                'price'       => 55,
                'images'      => [
                    'https://picsum.photos/seed/ld-crew-a/600/800',
                    'https://picsum.photos/seed/ld-crew-b/600/800',
                ],
                'size_options' => ['S', 'M', 'L', 'XL'],
                'stock'       => 20,
                'is_new'      => false,
                'is_featured' => true,
            ],
            [
                'name'        => 'Gorra Snapback Black',
                'description' => 'Snapback 6 paneles en lona estructurada. Visera plana, cierre ajustable y parche bordado con el monograma LD. Negro mate, sin temporada.',
                'price'       => 25,
                'images'      => [
                    'https://picsum.photos/seed/ld-cap-a/600/800',
                    'https://picsum.photos/seed/ld-cap-b/600/800',
                ],
                'size_options' => ['Talla Única'],
                'stock'       => 35,
                'is_new'      => false,
                'is_featured' => true,
            ],
            // ── COLECCIÓN BASE ────────────────────────────────────────────
            [
                'name'        => 'Tee Tattoo Studio',
                'description' => 'Camiseta con gráfico del estudio de tatuajes. Algodón 180g/m², corte regular. Impresión de alta resolución resistente a lavados.',
                'price'       => 28,
                'images'      => [
                    'https://picsum.photos/seed/ld-tee-tattoo/600/800',
                ],
                'size_options' => ['S', 'M', 'L', 'XL'],
                'stock'       => 40,
                'is_new'      => false,
                'is_featured' => false,
            ],
            [
                'name'        => 'Bucket Hat Leyenda',
                'description' => 'Pescador en gabardina de algodón tratado. Ala ancha, logo Leyenda bordado en frente y correa de ajuste interior. Versátil y atemporal.',
                'price'       => 28,
                'images'      => [
                    'https://picsum.photos/seed/ld-bucket-a/600/800',
                ],
                'size_options' => ['Talla Única'],
                'stock'       => 18,
                'is_new'      => true,
                'is_featured' => false,
            ],
            [
                'name'        => 'Shorts Urban Cargo',
                'description' => 'Bermuda cargo en algodón lavado. Bolsillos laterales con solapa, cinturilla elástica y cordón. Fit relaxed para el uso diario.',
                'price'       => 42,
                'images'      => [
                    'https://picsum.photos/seed/ld-shorts-a/600/800',
                ],
                'size_options' => ['S', 'M', 'L', 'XL'],
                'stock'       => 15,
                'is_new'      => false,
                'is_featured' => false,
            ],
            [
                'name'        => 'Tote Bag Canvas',
                'description' => 'Bolsa de tela en canvas natural 350g/m². Serigrafía doble cara con el logo Leyenda. Asa reforzada, capacidad 10L. Reutilizable y resistente.',
                'price'       => 18,
                'images'      => [
                    'https://picsum.photos/seed/ld-tote-a/600/800',
                ],
                'size_options' => [],
                'stock'       => 60,
                'is_new'      => false,
                'is_featured' => false,
            ],
            [
                'name'        => 'Calcetines Pack x3',
                'description' => 'Pack de 3 pares de calcetines en algodón con lycra. Tres diseños distintos con el logo Leyenda. Talla única (36-45). Negro, blanco y gris.',
                'price'       => 12,
                'images'      => [
                    'https://picsum.photos/seed/ld-socks-a/600/800',
                ],
                'size_options' => [],
                'stock'       => 80,
                'is_new'      => false,
                'is_featured' => false,
            ],
            [
                'name'        => 'Camiseta Logo Blanca',
                'description' => 'El clásico en blanco. Mismo corte recto que la Signature pero en blanco óptico. Logo Leyenda en negro bordado. Algodón peinado 200g/m².',
                'price'       => 35,
                'images'      => [
                    'https://picsum.photos/seed/ld-tee-white-a/600/800',
                    'https://picsum.photos/seed/ld-tee-white-b/600/800',
                ],
                'size_options' => ['S', 'M', 'L', 'XL'],
                'stock'       => 3,
                'is_new'      => false,
                'is_featured' => false,
            ],
        ];

        foreach ($products as $data) {
            Product::create($data);
        }
    }
}
