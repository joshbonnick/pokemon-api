<?php

namespace Database\Factories;

use App\Models\PokemonFormSprite;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PokemonFormSprite>
 */
class PokemonFormSpriteFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'back_default' => 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/back/1.png',
            'back_shiny' => 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/back/shiny/1.png',
            'front_default' => 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/1.png',
            'front_shiny' => 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/shiny/1.png',
        ];
    }
}
