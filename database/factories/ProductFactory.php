<?php

namespace Database\Factories;

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
        return [
            'nama' => fake()->word(5),
            'image' => 'https://picsum.photos/seed/' . fake()->uuid() . '/640/480',
            'price' => fake()->randomNumber(3, true),
            'description' => fake()->text(),
            'type' => fake()->randomElement(['baju', 'celana', 'gaun', 'kemeja']),
            'updated_at' => now(), // or Carbon::now()
            'created_at' => now(),
        ];
    }
}
