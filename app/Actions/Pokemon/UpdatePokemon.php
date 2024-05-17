<?php

namespace App\Actions\Pokemon;

use App\Models\Pokemon;

class UpdatePokemon
{
    /**
     * @param  array<string, mixed>  $data
     */
    public function handle(Pokemon $pokemon, array $data): Pokemon
    {
        return tap($pokemon)->update($data);
    }
}
