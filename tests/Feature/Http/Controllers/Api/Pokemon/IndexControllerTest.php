<?php

namespace Tests\Feature\Http\Controllers\Api\Pokemon;

use App\Models\Pokemon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class IndexControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_returns_a_successful_response()
    {
        $response = $this->get(route('api.v1.pokemon.index'));

        $response->assertStatus(200);
    }

    #[Test]
    public function it_returns_a_list_of_pokemon()
    {
        Pokemon::factory()->count(3)->create();

        $response = $this->get(route('api.v1.pokemon.index'));

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data');
    }

    #[Test]
    public function it_returns_pokemon_with_expected_structure()
    {
        Pokemon::factory()->create([
            'name' => 'Pikachu',
            'base_experience' => 12,
        ]);

        $response = $this->get(route('api.v1.pokemon.index'));

        $response->assertStatus(200)
            ->assertJsonFragment([
                'name' => 'Pikachu',
                'base_experience' => 12,
            ]);
    }

    #[Test]
    public function it_filters_pokemon_by_name()
    {
        Pokemon::factory()->create(['name' => 'Pikachu']);
        Pokemon::factory()->create(['name' => 'Bulbasaur']);
        Pokemon::factory()->create(['name' => 'Charmander']);

        $response = $this->getJson(route('api.v1.pokemon.index', ['s' => 'Pika']));

        $response->assertStatus(200);
        $response->assertJsonCount(1, 'data');
        $response->assertJsonFragment(['name' => 'Pikachu']);
    }

    #[Test]
    public function it_sorts_pokemon_by_stat()
    {
        Pokemon::factory()->create(['name' => 'Pikachu', 'stats' => ['speed' => 90]]);
        Pokemon::factory()->create(['name' => 'Bulbasaur', 'stats' => ['speed' => 45]]);
        Pokemon::factory()->create(['name' => 'Charmander', 'stats' => ['speed' => 65]]);

        $response = $this->getJson(route('api.v1.pokemon.index', ['stat_sort' => 'speed']));

        $response->assertStatus(200);
        $response->assertJsonCount(3, 'data');
        $response->assertJsonPath('data.0.name', 'Pikachu');
        $response->assertJsonPath('data.1.name', 'Charmander');
        $response->assertJsonPath('data.2.name', 'Bulbasaur');
    }
}
