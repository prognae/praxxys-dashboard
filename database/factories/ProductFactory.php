<?php

namespace Database\Factories;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // generate products with random names and descriptions. categories are either 1, 2, or 3
        return [
            //
            'name' => 'Product'.' '.fake()->sentence(1),
            'category' => 'Category'.' '.fake()->numberBetween($min = 1, $max = 3),
            'description' => fake()->sentence(),
            'date_and_time' => now()
        ];
    }
}
