<?php

declare(strict_types=1);

namespace App\Services\PokeAPI\Contracts;

interface PokeAPIClient
{
    /**
     * @return array{count: int, next: string, previous: ?string, results: array<int, array{name: string, url: string}>}
     */
    public function listPokemon(int $limit): array;

    /**
     * @return array<string, mixed>
     */
    public function pokemon(int $id): array;

    /**
     * @return array<string, mixed>
     */
    public function get(string $url): array;
}
