<?php

namespace Database\Factories;

use App\Models\PokemonAbility;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PokemonAbility>
 */
class PokemonAbilityFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pokeapi_id' => $this->faker->randomNumber(3),
            'name' => $this->faker->word,
            'is_main_series' => $this->faker->boolean(85),
        ];
    }
}
