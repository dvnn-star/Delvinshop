<?php

namespace Database\Seeders;

use App\Models\Ratings;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RatingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ratings::insert([
            'user' => 'delvin',
            'Ratings' => 'keren banget bang',
            'Bintang' => 3,
            'created_at' => fake()->dateTimeThisYear(), // Faker object
            'updated_at' => fake()->dateTimeThisYear(),
        ]);
        Ratings::insert([
            'user' => 'asep',
            'Ratings' => 'kacau parah bang',
            'Bintang' => 5,
    'created_at' => fake()->dateTimeThisYear(), // Faker object
    'updated_at' => fake()->dateTimeThisYear(),
        ]);
        Ratings::insert([
            'user' => 'delvin',
            'Ratings' => 'keren banget bang',
            'Bintang' => 3,
    'created_at' => fake()->dateTimeThisYear(), // Faker object
    'updated_at' => fake()->dateTimeThisYear(),
        ]);
        Ratings::insert([
            'user' => 'asep',
            'Ratings' => 'kacau parah bang',
            'Bintang' => 5,
    'created_at' => fake()->dateTimeThisYear(), // Faker object
    'updated_at' => fake()->dateTimeThisYear(),
        ]);
        Ratings::insert([
            'user' => 'delvin',
            'Ratings' => 'keren banget bang',
            'Bintang' => 3,
            'created_at' => fake()->dateTimeThisYear(), // Faker object
            'updated_at' => fake()->dateTimeThisYear(),
        ]);
        Ratings::insert([
            'user' => 'asep',
            'Ratings' => 'kacau parah bang',
            'Bintang' => 5,
            'created_at' => fake()->dateTimeThisYear(), // Faker object
            'updated_at' => fake()->dateTimeThisYear(),
        ]);
    }
}
