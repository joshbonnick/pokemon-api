<?php

namespace App\Services\PokeAPI\DataTransferObjects;

use App\Models\Pokemon;

readonly class PokemonDto
{
    /**
     * @var array<string, int>
     */
    public array $stats;

    /**
     * @param  array<int, array<string, mixed>>  $stats
     */
    public function __construct(
        public string $name,
        public int $poke_api_id,
        public int $base_experience,
        public int $height,
        public int $weight,
        public string $cry,
        array $stats,
        public bool $is_default,
        public int $order,
    ) {
        $this->stats = $this->processStats($stats);
    }

    public function toModel(): Pokemon
    {
        return Pokemon::query()->create([
            'name' => $this->name,
            'pokeapi_id' => $this->poke_api_id,
            'base_experience' => $this->base_experience,
            'height' => $this->height,
            'weight' => $this->weight,
            'cry' => $this->cry,
            'stats' => $this->stats,
            'is_default' => $this->is_default,
            'order' => $this->order,
        ]);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public static function from(array $payload): self
    {
        return new self(
            $payload['name'],
            $payload['id'],
            $payload['base_experience'],
            $payload['height'],
            $payload['weight'],
            $payload['cries']['latest'],
            $payload['stats'],
            $payload['is_default'],
            $payload['order']
        );
    }

    /**
     * @param  array<int, array<string, mixed>>  $stats
     * @return array<array-key, mixed>
     */
    protected function processStats(array $stats): array
    {
        return collect($stats)->mapWithKeys(fn (array $stat) => [$stat['stat']['name'] => $stat['base_stat']])->all();
    }
}
