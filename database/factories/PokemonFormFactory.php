<?php

namespace Database\Factories;

use App\Models\PokemonForm;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PokemonForm>
 */
class PokemonFormFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pokeapi_id' => $this->faker->randomNumber(3),
            'name' => $this->faker->word,
            'order' => $this->faker->randomNumber(1),
            'form_order' => $this->faker->randomNumber(1),
            'is_battle_only' => $this->faker->boolean(15),
            'is_default' => $this->faker->boolean(85),
            'is_mega' => $this->faker->boolean(15),
            'sprites' => json_encode([
                'back_default' => 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/back/1.png',
                'back_shiny' => 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/back/shiny/1.png',
                'front_default' => 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/1.png',
                'front_shiny' => 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/shiny/1.png',
            ]),
        ];
    }
}
