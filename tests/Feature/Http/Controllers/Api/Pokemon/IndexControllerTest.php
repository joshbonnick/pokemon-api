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
        $pokemon = Pokemon::factory()->create([
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
}
