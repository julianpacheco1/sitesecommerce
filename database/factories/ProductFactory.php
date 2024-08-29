<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{

    public function definition(): array
    {
      return [
        'name' => fake()->text,
        'price' => fake()->randomFloat(2, 100, 1000),
        'image' => fake()->imageUrl
    ];
    }

}
