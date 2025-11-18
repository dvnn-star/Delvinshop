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
            'updated_at' => fake()->date(22,5,4,'now'),
            'created_at' => fake()->date(20,5,4,'now'),
        ]);
          Ratings::insert([
            'user' => 'asep',
            'Ratings' => 'kacau parah bang',
            'Bintang' => 5,
            'updated_at' => fake()->date(22,5,4,'now'),
            'created_at' => fake()->date(20,5,4,'now'),
        ]);
                Ratings::insert([
            'user' => 'delvin',
            'Ratings' => 'keren banget bang',
            'Bintang' => 3,
            'updated_at' => fake()->date(22,5,4,'now'),
            'created_at' => fake()->date(20,5,4,'now'),
        ]);
          Ratings::insert([
            'user' => 'asep',
            'Ratings' => 'kacau parah bang',
            'Bintang' => 5,
            'updated_at' => fake()->date(22,5,4,'now'),
            'created_at' => fake()->date(20,5,4,'now'),
        ]);
                Ratings::insert([
            'user' => 'delvin',
            'Ratings' => 'keren banget bang',
            'Bintang' => 3,
            'updated_at' => fake()->date(22,5,4,'now'),
            'created_at' => fake()->date(20,5,4,'now'),
        ]);
          Ratings::insert([
            'user' => 'asep',
            'Ratings' => 'kacau parah bang',
            'Bintang' => 5,
            'updated_at' => fake()->date(22,5,4,'now'),
            'created_at' => fake()->date(20,5,4,'now'),
        ]);
    }
}
