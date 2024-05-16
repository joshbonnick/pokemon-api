<?php

namespace App\Repositories;

use App\Models\PokemonHeldItem;

class PokemonHeldItemRepository
{
    /**
     * @param  array<string, mixed>  $item
     */
    public function getItemByNameOrCreate(array $item): PokemonHeldItem
    {
        $name = $item['item']['name'];

        return cache()->driver('array')->remember("pokemon-held-item:$name", 60, function () use ($name) {
            return PokemonHeldItem::query()->firstOrCreate(
                ['name' => $name],
                ['name' => $name]
            );
        });
    }
}
