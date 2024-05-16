<?php

namespace App\Repositories;

use App\Models\PokemonAbility;

class PokemonAbilityRepository
{
    public function getAbilityByNameOrCreate(string $name): PokemonAbility
    {
        return cache()->driver('array')->remember("pokemon-ability:$name", 60, function () use ($name) {
            return PokemonAbility::query()->firstOrCreate(
                ['name' => $name],
                ['name' => $name]
            );
        });
    }
}
