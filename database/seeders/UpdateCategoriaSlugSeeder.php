<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;
use Illuminate\Support\Str;

class UpdateCategoriaSlugSeeder extends Seeder
{
    public function run()
    {
        foreach (Categoria::all() as $cat) {
            $cat->slug = Str::slug($cat->nombre);
            $cat->save();
        }
    }
}
