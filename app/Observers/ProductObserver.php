<?php

namespace App\Observers;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProductObserver
{
    public function saved(Product $product): void
    {
        $images = $product->images ?? [];
        if (empty($images)) {
            return;
        }

        $manager = new ImageManager(new Driver());

        foreach ($images as $path) {
            if (!Storage::disk('public')->exists($path)) {
                continue;
            }

            $fullPath = Storage::disk('public')->path($path);

            // Solo procesar si pesa más de 300 KB
            if (filesize($fullPath) <= 300 * 1024) {
                continue;
            }

            try {
                $image = $manager->read($fullPath);
                // Reducir a máximo 1920px de ancho manteniendo proporción
                $image->scaleDown(width: 1920);
                // Guardar como JPEG al 82% de calidad (invisible para el ojo)
                $image->toJpeg(82)->save($fullPath);
            } catch (\Throwable) {
                // Si falla una imagen, continuar con las demás
            }
        }
    }
}
