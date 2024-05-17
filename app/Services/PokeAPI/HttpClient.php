<?php

declare(strict_types=1);

namespace App\Services\PokeAPI;

use App\Services\PokeAPI\Contracts\PokeAPIClient;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Cache;

class HttpClient implements PokeAPIClient
{
    public function __construct(
        protected PendingRequest $request,
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function listPokemon(int $limit, int $offset = 0): array
    {
        return Cache::remember("pokeapi:list-pokemon:limit:$limit:offset:$offset", now()->addHour(),
            fn () => $this->request->get('pokemon', ['limit' => $limit, 'offset' => $offset])->json());
    }

    /**
     * {@inheritDoc}
     */
    public function pokemon(int $id): array
    {
        return Cache::remember("pokeapi:pokemon:$id", now()->addHour(),
            fn () => $this->request->get("pokemon/$id")->json());
    }

    /**
     * {@inheritDoc}
     */
    public function get(string $url): array
    {
        return cache()->remember("pokeapi:$url", now()->addHour(), fn () => $this->request->get($url)->json());
    }
}
