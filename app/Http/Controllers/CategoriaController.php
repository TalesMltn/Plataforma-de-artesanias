<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function show($slug)
    {
        $categorias = [
            'textiles-y-tejidos' => [
                'nombre' => 'Textiles y tejidos',
                'descripcion' => 'Ponchos, mantas, chullos, bufandas y otros productos en lana de alpaca o oveja con técnicas tradicionales de tejido y bordado.'
            ],
            'ceramica' => [
                'nombre' => 'Cerámica',
                'descripcion' => 'Piezas utilitarias o decorativas hechas en barro, como vasijas, ollas, figuras rituales y souvenirs.'
            ],
            'madera-tallada' => [
                'nombre' => 'Madera tallada',
                'descripcion' => 'Artesanía en madera que incluye muebles pequeños, utensilios, figuras decorativas y esculturas.'
            ],
            'mates-burilados' => [
                'nombre' => 'Mates burilados',
                'descripcion' => 'Mates de calabaza grabados a mano con diseños geométricos, culturales o escenas de la vida local.'
            ],
            'joyeria-bisuteria' => [
                'nombre' => 'Joyería y bisutería artesanal',
                'descripcion' => 'Collares, pulseras, anillos y aretes hechos con plata, piedras semipreciosas o materiales naturales.'
            ],
            'cuero-talabarteria' => [
                'nombre' => 'Cuero y talabartería',
                'descripcion' => 'Bolsos, carteras, cinturones, zapatos y accesorios hechos de cuero trabajado artesanalmente.'
            ],
            'cesteria-fibras' => [
                'nombre' => 'Cestería y fibras vegetales',
                'descripcion' => 'Canastas, sombreros, tapices, adornos y utensilios hechos con fibras vegetales como totora, paja o palma.'
            ],
            'instrumentos-tradicionales' => [
                'nombre' => 'Instrumentos musicales tradicionales',
                'descripcion' => 'Flautas de caña, charangos, bombos y otros instrumentos típicos elaborados por artesanos locales.'
            ],
            'arte-souvenir' => [
                'nombre' => 'Arte decorativo y souvenir',
                'descripcion' => 'Figurillas, esculturas, adornos y recuerdos representativos de la cultura y tradición de la región.'
            ],
        ];

        if (!array_key_exists($slug, $categorias)) {
            abort(404);
        }

        $categoria = $categorias[$slug];

        return view('productos.categoria', compact('categoria'));
    }
}
