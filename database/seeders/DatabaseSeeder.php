<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\move_seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\pokemon_seeder;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
		$this->call(UserSeeder::class);
		$this->call(type_seeder::class);
		$this->call(pokemon_seeder::class);
		$this->call(move_seeder::class);
    }
}
