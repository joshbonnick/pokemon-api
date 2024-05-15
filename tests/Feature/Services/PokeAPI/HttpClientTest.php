<?php

namespace Tests\Feature\Services\PokeAPI;

use App\Services\PokeAPI\Contracts\PokeAPIClient;
use App\Services\PokeAPI\HttpClient;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class HttpClientTest extends TestCase
{
    #[Test]
    public function it_can_resolve_poke_client(): void
    {
        $this->assertInstanceOf(HttpClient::class, $this->app->make(PokeAPIClient::class));
    }

    #[Test]
    public function it_fetches_pokemon_with_limit()
    {
        Http::preventStrayRequests();

        $limit = fake()->randomNumber(1);
        $base = config('pokeapi.base_url');
        $url = "{$base}pokemon?limit=$limit";

        Http::fake([
            $url => Http::response(['results' => []], 200),
        ]);

        $client = $this->app->make(PokeAPIClient::class);
        $client->listPokemon($limit);

        Http::assertSent(fn (Request $request): bool => $request->url() == $url && $request['limit'] == $limit);
    }

    #[Test]
    public function it_caches_pokemon_list_result()
    {
        Http::preventStrayRequests();
        Cache::flush();

        $limit = fake()->randomNumber(1);
        $base = config('pokeapi.base_url');
        $url = "{$base}pokemon?limit=$limit";

        Http::fake([
            $url => Http::response(['results' => []], 200),
        ]);

        $client = $this->app->make(PokeAPIClient::class);

        $client->listPokemon($limit);

        Http::assertSent(fn (Request $request): bool => $request->url() == $url && $request['limit'] == $limit);

        $this->assertNotEmpty(Cache::get("pokeapi:list-pokemon:limit:$limit"));
    }

    #[Test]
    public function it_fetches_pokemon_by_id()
    {
        Http::preventStrayRequests();

        $base = config('pokeapi.base_url');
        $url = "{$base}pokemon/1";

        Http::fake([
            $url => Http::response(['results' => []], 200),
        ]);

        $client = $this->app->make(PokeAPIClient::class);

        $response = $client->pokemon(1);

        Http::assertSent(fn (Request $request): bool => $request->url() == $url);
    }

    #[Test]
    public function it_caches_pokemon_by_id_result()
    {
        Http::preventStrayRequests();
        Cache::flush();

        $base = config('pokeapi.base_url');
        $url = "{$base}pokemon/1";

        Http::fake([
            $url => Http::response(['results' => []], 200),
        ]);

        $client = $this->app->make(PokeAPIClient::class);
        $client->pokemon(1);

        $this->assertNotEmpty(Cache::get('pokeapi:pokemon:1'));
    }

    protected function setUp(): void
    {
        parent::setUp();

        Cache::flush();
    }
}
