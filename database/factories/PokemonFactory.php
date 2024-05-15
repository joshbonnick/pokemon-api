<?php

namespace Database\Factories;

use App\Models\Pokemon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Pokemon>
 */
class PokemonFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pokeapi_id' => $this->faker->randomNumber(3),
            'name' => $this->faker->word,
            'stats' => json_encode([
                'speed' => 35,
                'special-attack' => 65,
                'special-defense' => 65,
                'defense' => 49,
            ]),
            'base_experience' => $this->faker->randomNumber(2),
            'height' => $this->faker->randomNumber(1),
            'is_default' => $this->faker->boolean(85),
            'order' => $this->faker->numberBetween(1, 3),
            'weight' => $this->faker->randomNumber(1),
            'cry' => 'https://raw.githubusercontent.com/PokeAPI/cries/main/cries/pokemon/latest/1.ogg',
        ];
    }
}
