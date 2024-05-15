<?php

namespace App\Services\PokeAPI;

use App\Models\Pokemon;
use App\Models\PokemonAbility;
use App\Models\PokemonForm;
use App\Models\PokemonFormSprite;
use App\Models\PokemonHeldItem;
use App\Services\PokeAPI\DataTransferObjects\PokemonDto;
use Http;
use Illuminate\Support\Collection;

class ImportProcessor
{
    /**
     * @param  array{url: string}  $pokemon
     */
    public function process(array $pokemon): Pokemon
    {
        $payload = Http::get($pokemon['url'])->json();

        $pokemon = PokemonDto::from($payload)->toModel();

        $pokemon->forms()->sync($this->processForms($payload['forms'])->pluck('id'));
        $pokemon->abilities()->sync($this->processAbilities($payload['abilities'])->toArray());
        $pokemon->held_items()->sync($this->processHeldItems($payload['held_items'])->pluck('id'));

        return $pokemon;
    }

    /**
     * @param  array<string, mixed>  $held_items
     * @return Collection<string, PokemonHeldItem>
     */
    protected function processHeldItems(array $held_items): Collection
    {
        return collect($held_items)->map(
            fn (array $held_item) => PokemonHeldItem::query()->firstOrCreate(
                ['name' => $held_item['item']['name']],
                ['name' => $held_item['item']['name']]
            ));
    }

    /**
     * @param  array<string, mixed>  $abilities
     * @return Collection<int, array{is_hidden: bool, slot: int}>
     */
    protected function processAbilities(array $abilities): Collection
    {
        return collect($abilities)->mapWithKeys(function (array $ability) {
            $ability_model = PokemonAbility::query()->firstOrCreate(
                ['name' => $ability['ability']['name']],
                ['name' => $ability['ability']['name']]
            );

            return [$ability_model->value('id') => ['is_hidden' => $ability['is_hidden'], 'slot' => $ability['slot']]];
        });
    }

    /**
     * @param  array<string, mixed>  $forms
     * @return Collection<array-key, PokemonForm>
     */
    protected function processForms(array $forms): Collection
    {
        return collect($forms)
            ->map(function (array $form) {
                $form = Http::get($form['url'])->json();

                return PokemonForm::query()->firstOrCreate(
                    ['pokeapi_id' => $form['id']],
                    [
                        'pokeapi_id' => $form['id'],
                        'name' => $form['name'],
                        'order' => $form['order'],
                        'form_order' => $form['form_order'],
                        'is_battle_only' => $form['is_battle_only'],
                        'is_default' => $form['is_default'],
                        'is_mega' => $form['is_mega'],
                        'pokemon_form_sprite_id' => $this->processSprite($form['sprites'])->id,
                    ]
                );
            });
    }

    /**
     * @param  array{front_default: string, front_shiny: string, back_default: string, back_shiny: string}  $sprites
     */
    protected function processSprite(array $sprites): PokemonFormSprite
    {
        return PokemonFormSprite::query()->create([
            'front_default' => $sprites['front_default'],
            'front_shiny' => $sprites['front_shiny'],
            'back_default' => $sprites['back_default'],
            'back_shiny' => $sprites['back_shiny'],
        ]);
    }
}
