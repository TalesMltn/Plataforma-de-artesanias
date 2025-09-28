<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        $categorias = [
            ['nombre' => 'Textiles y tejidos', 'slug' => 'textiles-y-tejidos', 'descripcion' => 'Productos hechos a mano en telares y técnicas textiles'],
            ['nombre' => 'Cerámica', 'slug' => 'ceramica', 'descripcion' => 'Piezas de cerámica tradicionales y modernas'],
            ['nombre' => 'Madera tallada', 'slug' => 'madera-tallada', 'descripcion' => 'Tallados artesanales en madera'],
            ['nombre' => 'Mates burilados', 'slug' => 'mates-burilados', 'descripcion' => 'Mates decorados con burilado artístico'],
            ['nombre' => 'Joyería y bisutería', 'slug' => 'joyeria-y-bisuteria', 'descripcion' => 'Accesorios hechos a mano en diversos materiales'],
            ['nombre' => 'Cuero y talabartería', 'slug' => 'cuero-y-talabarteria', 'descripcion' => 'Productos artesanales en cuero'],
            ['nombre' => 'Cestería y fibras vegetales', 'slug' => 'cesteria-y-fibras-vegetales', 'descripcion' => 'Cestas y artesanías en fibras naturales'],
            ['nombre' => 'Instrumentos musicales tradicionales', 'slug' => 'instrumentos-musicales-tradicionales', 'descripcion' => 'Instrumentos típicos hechos a mano'],
            ['nombre' => 'Arte decorativo y souvenir', 'slug' => 'arte-decorativo-y-souvenir', 'descripcion' => 'Artículos decorativos y recuerdos artesanales'],
        ];

        foreach ($categorias as $categoria) {
            DB::table('categorias')->insert([
                'nombre' => $categoria['nombre'],
                'slug' => $categoria['slug'],
                'descripcion' => $categoria['descripcion'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
