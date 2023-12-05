<?php

namespace Database\Factories;

use App\Models\Pokemon;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CustomPokemon>
 */
class CustomPokemonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

		$userIds = User::all()->pluck('id')->toArray();
		$pokemonIds = Pokemon::all()->pluck('id')->toArray();
		// because faker is so cool and awesome i just get an array of every number possible for the forign keys to work and then it works
		
        return [
            'nickname' =>fake()->name(),
			'pokemon_id' => fake()->randomElement($pokemonIds),
			'user_id' => fake()->randomElement($userIds)
        ];
    }
}
