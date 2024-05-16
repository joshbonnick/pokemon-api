<?php

namespace App\Repositories;

use App\Models\Pokemon;
use Illuminate\Database\Eloquent\Builder;

class PokemonRepository
{
    /**
     * @return Builder<Pokemon>
     */
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
        return tap($pokemon)->load(static::eagerLoadedRelationships());
    }

    /**
     * @return array<int,string>
     */
    protected static function eagerLoadedRelationships(): array
    {
        return [
            'abilities:id,name',
            'forms:id,name,order,form_order,is_battle_only,is_default,is_mega,pokemon_form_sprite_id',
            'forms.sprite:id,back_default,back_shiny,front_default,front_shiny',
            'held_items:id,name',
        ];
    }
}
