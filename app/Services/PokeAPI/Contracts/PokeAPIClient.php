<?php

declare(strict_types=1);

namespace App\Services\PokeAPI\Contracts;

use Illuminate\Http\Client\Response;

interface PokeAPIClient
{
    public function listPokemon(int $limit): Response;

    public function pokemon(int $id): Response;
}
