<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => fake()->email(),
        ]);
        User::factory()->create([
            'name' => 'Delvin',
            'email' => 'delvintan38@gmail.com',
            'role' => 'staff',
            'password' => 'delvinpro'

        ]);
        User::factory()->create([
            'name' => 'Delvin',
            'email' => 'delvintan@gmail.com',
            'role' => 'user',
            'password' => 'delvinpro'

        ]);
        $this->call(ProductSeeder::class);
        $this->call(RatingsSeeder::class);
    }
}
