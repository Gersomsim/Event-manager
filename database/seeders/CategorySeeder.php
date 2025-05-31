<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Faker\Factory as Faker;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => "Conferencias",
            'description' => "Eventos educativos o informativos donde expertos comparten conocimientos.",
            'icon' => "fas fa-microphone-alt",
            'color' => "#1E90FF"
        ]);
        Category::create([
            'name' => "Conciertos",
            'description' => "Presentaciones musicales en vivo con artistas o bandas.",
            'icon' => "fas fa-music",
            'color' => "#FF4500"
        ]);
        Category::create([
            'name' => "Talleres",
            'description' => "Sesiones prácticas donde los participantes aprenden haciendo.",
            'icon' => "fas fa-tools",
            'color' => "#32CD32"
        ]);
        Category::create([
            'name' => "Exposiciones",
            'description' => "Eventos donde se exhiben productos, arte o innovaciones.",
            'icon' => "fas fa-images",
            'color' => "#8A2BE2"
        ]);
    }
}


  