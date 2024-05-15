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
            'name' => $this->faker->word,
        ];
    }
}
