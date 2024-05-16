<?php

namespace App\Repositories;

use App\Models\PokemonForm;
use App\Models\PokemonFormSprite;

class PokemonFormRepository
{
    /**
     * @param  array<string, mixed>  $form
     */
    public function getFormByPokeIdOrCreate(int $id, array $form, PokemonFormSprite $sprite): PokemonForm
    {
        return cache()->driver('array')->remember("pokemon-form:$id", 60, function () use ($id, $form, $sprite) {
            return PokemonForm::query()->firstOrCreate(['pokeapi_id' => $id], [
                'pokeapi_id' => $form['id'],
                'name' => $form['name'],
                'order' => $form['order'],
                'form_order' => $form['form_order'],
                'is_battle_only' => $form['is_battle_only'],
                'is_default' => $form['is_default'],
                'is_mega' => $form['is_mega'],
                'pokemon_form_sprite_id' => $sprite->id,
            ]);
        });
    }
}
