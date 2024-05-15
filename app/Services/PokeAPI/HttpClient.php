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
    public function listPokemon(int $limit): array
    {
        return Cache::remember(
            "pokeapi:list-pokemon:limit:$limit",
            now()->addHour(),
            fn () => $this->request->get('pokemon', ['limit' => $limit])->json()
        );
    }

    /**
     * {@inheritDoc}
     */
    public function pokemon(int $id): array
    {
        return Cache::remember(
            "pokeapi:pokemon:$id",
            now()->addHour(),
            fn () => $this->request->get("pokemon/$id")->json()
        );
    }
}
