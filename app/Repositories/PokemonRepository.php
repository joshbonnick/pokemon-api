<?php

namespace App\Repositories;

use App\Contracts\PokemonQuery;
use App\Models\Pokemon;
use Illuminate\Database\Eloquent\Builder;

class PokemonRepository implements PokemonQuery
{
    public function all(): Builder
    {
        return Pokemon::query()->with(static::eagerLoadedRelationships());
    }

    public function count(): int
    {
        return Pokemon::query()->count();
    }

    public function eagerLoaded(Pokemon $pokemon): Pokemon
    {
        $pokemon->load(static::eagerLoadedRelationships());

        return $pokemon;
    }

    /**
     * @return array<int,string>
     */
    protected static function eagerLoadedRelationships(): array
    {
        return [
            'abilities:id,name',
            'forms',
            'forms.sprite',
            'held_items',
        ];
    }
}
