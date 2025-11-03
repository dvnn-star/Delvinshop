<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class RatingsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user' => fake()->userName(),
            'Ratings' => 'Gila recommended banget bang',
            'Bintang' => fake()->numberBetween(4,5),
            'updated_at' => fake()->date(22,5,4,'now'),
            'created_at' => fake()->date(20,5,4,'now'),
        ];
    }
}
