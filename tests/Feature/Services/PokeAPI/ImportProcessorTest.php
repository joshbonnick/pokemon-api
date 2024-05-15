<?php

namespace Tests\Feature\Services\PokeAPI;

use App\Models\Pokemon;
use App\Services\PokeAPI\ImportProcessor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ImportProcessorTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_processes_raw_response_into_pokemon_models(): void
    {
        Http::preventStrayRequests();

        Http::fake([
            'https://pokeapi.co/api/v2/pokemon/1/' => Http::response(json_decode($this->stub('tests/stubs/pokemon-payload.json'),
                true)),
            'https://pokeapi.co/api/v2/pokemon-form/1/' => Http::response(json_decode($this->stub('tests/stubs/pokemon-form-payload.json'),
                true)),
        ]);

        $pokemon = resolve(ImportProcessor::class)->process(['url' => 'https://pokeapi.co/api/v2/pokemon/1/']);

        $this->assertInstanceOf(Pokemon::class, $pokemon);
        $this->assertDatabaseHas(Pokemon::class, ['name' => $pokemon->name]);
    }
}
