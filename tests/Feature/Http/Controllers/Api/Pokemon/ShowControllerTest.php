<?php

namespace Tests\Feature\Http\Controllers\Api\Pokemon;

use App\Models\Pokemon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ShowControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_returns_a_successful_response()
    {
        $pokemon = Pokemon::factory()->create();

        $response = $this->get(route('api.v1.pokemon.show', ['pokemon' => $pokemon->id]));

        $response->assertStatus(200);
    }

    #[Test]
    public function it_returns_the_correct_pokemon_data()
    {
        $pokemon = Pokemon::factory()->create(['name' => 'Pikachu', 'base_experience' => 44]);

        $this->withoutExceptionHandling();

        $response = $this->get(route('api.v1.pokemon.show', ['pokemon' => $pokemon->id]));

        $response->assertStatus(200)
            ->assertJsonFragment([
                'name' => 'Pikachu',
                'base_experience' => 44,
            ]);
    }

    #[Test]
    public function it_returns_pokemon_with_expected_structure()
    {
        $pokemon = Pokemon::factory()->create();

        $response = $this->get(route('api.v1.pokemon.show', ['pokemon' => $pokemon->id]));

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id', 'name',
                    'weight', 'base_experience',
                    'height', 'stats',
                    'is_default', 'abilities',
                    'forms',
                ],
            ]);
    }
}
