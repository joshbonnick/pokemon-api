<?php

declare(strict_types=1);

namespace App\Services\PokeAPI;

use App\Services\PokeAPI\Contracts\PokeAPIClient;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Cache;

class HttpClient implements PokeAPIClient
{
    public function __construct(
        protected PendingRequest $request,
    ) {
    }

    public function listPokemon(int $limit): Response
    {
        return Cache::remember(
            "pokeapi:list-pokemon:limit:$limit",
            now()->addHour(),
            fn (): Response => $this->request->get('pokemon', ['limit' => $limit])
        );
    }

    public function pokemon(int $id): Response
    {
        return Cache::remember(
            "pokeapi:pokemon:$id",
            now()->addHour(),
            fn (): Response => $this->request->get("pokemon/$id")
        );
    }
}
