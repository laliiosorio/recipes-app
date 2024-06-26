<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Recipe;
use App\Models\Category;

class RecipeSeeder extends Seeder
{
    public function run()
    {
        // Crear algunas categorías de ejemplo
        $categories = [
            'Mexicana',
            'Rápida',
            'Vegetariana',
            'Carnes',
        ];

        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }

        // Generar recetas ficticias
        Recipe::factory()->count(100)->create()->each(function ($recipe) {
            $categories = Category::inRandomOrder()->take(2)->pluck('id');
            $recipe->categories()->attach($categories);
        });
    }
}
