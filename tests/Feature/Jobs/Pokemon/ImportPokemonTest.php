<?php

namespace Tests\Feature\Jobs\Pokemon;

use App\Jobs\Pokemon\ImportPokemon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ImportPokemonTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_imports_pokemon_from_api(): void
    {
        Http::preventStrayRequests();

        $limit = 151;
        $base = config('pokeapi.base_url');
        $url = "{$base}pokemon?limit=$limit";

        Http::fake([
            $url => Http::response([
                'results' => [
                    [
                        'name' => 'bob', 'url' => 'https://pokeapi.co/api/v2/pokemon/1/',
                    ],
                ],
            ]),
            'https://pokeapi.co/api/v2/pokemon/1/' => Http::response(json_decode($this->stub('tests/stubs/pokemon-payload.json'),
                true)),
            'https://pokeapi.co/api/v2/pokemon-form/1/' => Http::response(json_decode($this->stub('tests/stubs/pokemon-form-payload.json'),
                true)),
        ]);

        ImportPokemon::dispatchSync($limit);

        Http::assertSent(fn (Request $request): bool => $request->url() === 'https://pokeapi.co/api/v2/pokemon/1/');
        Http::assertSent(fn (Request $request): bool => $request->url() === 'https://pokeapi.co/api/v2/pokemon-form/1/');
    }
}
