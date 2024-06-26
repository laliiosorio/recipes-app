<?php

namespace Database\Factories;

use App\Models\Recipe;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class RecipeFactory extends Factory
{
    protected $model = Recipe::class;

    public function definition()
    {
        return [
            'name' => $this->faker->sentence(3),
            'publication_date' => $this->faker->date(),
            'difficulty' => $this->faker->randomElement(['bajo', 'medio', 'alto']),
            'preparation_time' => $this->faker->numberBetween(10, 120),
            'ingredients' => $this->faker->paragraph(),
            'author' => $this->faker->name(),
            'instructions' => $this->faker->paragraphs(3, true),
            'image' => $this->faker->word() . '.jpg',
        ];
    }
}
