<?php

namespace App\Contracts;

use App\Models\Pokemon;
use Illuminate\Database\Eloquent\Builder;

interface PokemonQuery
{
    public function eagerLoaded(Pokemon $pokemon): Pokemon;

    /**
     * @return Builder<Pokemon>
     */
    public function all(): Builder;

    public function count(): int;
}
