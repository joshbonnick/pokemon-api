<?php

namespace Database\Factories;

use App\Models\PokemonHeldItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PokemonHeldItem>
 */
class PokemonHeldItemFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pokeapi_id' => $this->faker->randomNumber(3),
            'name' => $this->faker->word,
        ];
    }
}
