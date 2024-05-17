<?php

namespace Tests\Feature\Http\Controllers;

use App\Enums\PokemonStats;
use App\Models\Pokemon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class PokemonControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_displays_the_home_page_with_pokemon_data()
    {
        Pokemon::factory()->create([
            'name' => 'Bulbasaur',
            'stats' => [],
            'order' => 1,
            'base_experience' => 64,
            'height' => 7,
            'weight' => 69,
        ]);

        $response = $this->get(route('pokemon.index'));

        $response->assertStatus(200);

        $response->assertInertia(fn ($page) => $page
            ->component('Home')
            ->has('pokemon.data', 1)
            ->where('pokemon_count', 1)
            ->where('stats', PokemonStats::labels())
        );
    }

    #[Test]
    public function it_displays_the_pokemon_detail_page_with_related_pokemon()
    {
        $this->withoutExceptionHandling();

        $pokemon = Pokemon::factory()->create([
            'name' => 'Bulbasaur',
            'stats' => '[]',
            'order' => 1,
            'base_experience' => 64,
            'height' => 7,
            'weight' => 69,
        ]);

        Pokemon::factory()->count(5)->create();

        $response = $this->get(route('pokemon.show', ['pokemon' => $pokemon->id]));

        $response->assertStatus(200);

        $response->assertInertia(fn ($page) => $page
            ->component('Pokemon/Show')
            ->where('pokemon.id', $pokemon->id)
            ->has('related', 5)
        );
    }
}
