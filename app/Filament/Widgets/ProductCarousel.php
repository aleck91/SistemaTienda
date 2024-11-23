<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProductCarousel extends Widget
{
    protected static string $view = 'filament.widgets.product-carousel';

    public function render(): View
    {
        // Obtén las imágenes desde la carpeta public/images/productos
        $images = Storage::files('public/images/products');
        
        // Elimina la ruta 'public/' para que las imágenes se puedan servir correctamente
        $images = array_map(function ($image) {
            return asset('storage/images/products/' . basename($image));
        }, $images);

        return view('filament.widgets.product-carousel', [
            'images' => $images,
        ]);
    }
}
