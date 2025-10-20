<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        // Limpia la tabla antes de insertar
        DB::table('productos')->truncate();

        $productos = [
            // Textiles y tejidos
            ['nombre' => 'Poncho', 'slug_categoria' => 'textiles-y-tejidos'],
            ['nombre' => 'Manta', 'slug_categoria' => 'textiles-y-tejidos'],
            ['nombre' => 'Chullo', 'slug_categoria' => 'textiles-y-tejidos'],
            ['nombre' => 'Bufanda', 'slug_categoria' => 'textiles-y-tejidos'],

            // Cerámica
            ['nombre' => 'Vasija', 'slug_categoria' => 'ceramica'],
            ['nombre' => 'Olla', 'slug_categoria' => 'ceramica'],
            ['nombre' => 'Figura ritual', 'slug_categoria' => 'ceramica'],
            ['nombre' => 'Souvenir', 'slug_categoria' => 'ceramica'],

            // Madera tallada
            ['nombre' => 'Mueble pequeño', 'slug_categoria' => 'madera-tallada'],
            ['nombre' => 'Utensilio', 'slug_categoria' => 'madera-tallada'],
            ['nombre' => 'Figura decorativa', 'slug_categoria' => 'madera-tallada'],
            ['nombre' => 'Escultura', 'slug_categoria' => 'madera-tallada'],

            // Mates burilados
            ['nombre' => 'Mate con diseño geométrico', 'slug_categoria' => 'mates-burilados'],
            ['nombre' => 'Mate con escena cultural', 'slug_categoria' => 'mates-burilados'],
            ['nombre' => 'Mate con diseño local', 'slug_categoria' => 'mates-burilados'],

            // Joyería y bisutería
            ['nombre' => 'Collar', 'slug_categoria' => 'joyeria-y-bisuteria'],
            ['nombre' => 'Pulsera', 'slug_categoria' => 'joyeria-y-bisuteria'],
            ['nombre' => 'Anillo', 'slug_categoria' => 'joyeria-y-bisuteria'],
            ['nombre' => 'Arete', 'slug_categoria' => 'joyeria-y-bisuteria'],

            // Cuero y talabartería
            ['nombre' => 'Bolso', 'slug_categoria' => 'cuero-y-talabarteria'],
            ['nombre' => 'Cartera', 'slug_categoria' => 'cuero-y-talabarteria'],
            ['nombre' => 'Cinturón', 'slug_categoria' => 'cuero-y-talabarteria'],
            ['nombre' => 'Par de zapatos', 'slug_categoria' => 'cuero-y-talabarteria'],

            // Cestería y fibras vegetales
            ['nombre' => 'Canasta', 'slug_categoria' => 'cesteria-y-fibras-vegetales'],
            ['nombre' => 'Sombrero', 'slug_categoria' => 'cesteria-y-fibras-vegetales'],
            ['nombre' => 'Tapiz', 'slug_categoria' => 'cesteria-y-fibras-vegetales'],
            ['nombre' => 'Adorno', 'slug_categoria' => 'cesteria-y-fibras-vegetales'],

            // Instrumentos musicales tradicionales
            ['nombre' => 'Flauta de caña', 'slug_categoria' => 'instrumentos-musicales-tradicionales'],
            ['nombre' => 'Charango', 'slug_categoria' => 'instrumentos-musicales-tradicionales'],
            ['nombre' => 'Bombo', 'slug_categoria' => 'instrumentos-musicales-tradicionales'],
            ['nombre' => 'Otro instrumento típico', 'slug_categoria' => 'instrumentos-musicales-tradicionales'],

            // Arte decorativo y souvenir
            ['nombre' => 'Figurilla', 'slug_categoria' => 'arte-decorativo-y-souvenir'],
            ['nombre' => 'Escultura', 'slug_categoria' => 'arte-decorativo-y-souvenir'],
            ['nombre' => 'Adorno', 'slug_categoria' => 'arte-decorativo-y-souvenir'],
            ['nombre' => 'Recuerdo cultural', 'slug_categoria' => 'arte-decorativo-y-souvenir'],
        ];

        foreach ($productos as $producto) {
            $categoriaId = DB::table('categorias')->where('slug', $producto['slug_categoria'])->value('id');

            DB::table('productos')->insert([
                'nombre' => $producto['nombre'],
                'slug' => Str::slug($producto['nombre']),
                'categoria_id' => $categoriaId,
                'descripcion' => 'Descripción de ' . $producto['nombre'],
                'precio' => rand(10, 100),
                'stock' => rand(1, 50),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
