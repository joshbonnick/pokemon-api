<?php

namespace App\Services\PokeAPI;

use App\Models\Pokemon;
use App\Models\PokemonAbility;
use App\Models\PokemonForm;
use App\Services\PokeAPI\Contracts\PokeAPIClient;
use App\Services\PokeAPI\DataTransferObjects\PokemonDto;
use Illuminate\Support\Collection;

class ImportProcessor
{
    public function __construct(
        protected PokeAPIClient $poke_api,
    ) {
    }

    /**
     * @param  array{url: string}  $pokemon
     */
    public function process(array $pokemon): Pokemon
    {
        $payload = $this->poke_api->get($pokemon['url']);

        $pokemon = PokemonDto::from($payload)->toModel();

        $pokemon->forms()->sync($this->forms($payload['forms'])->pluck('id'));
        $pokemon->abilities()->sync($this->abilities($payload['abilities'])->toArray());

        return $pokemon;
    }

    /**
     * @param  array<int, array{ability: array{name: string}, is_hidden: bool, slot: int}>  $abilities
     * @return Collection<array-key, array{is_hidden: bool, slot: int}>
     */
    protected function abilities(array $abilities): Collection
    {
        return collect($abilities)->mapWithKeys(function (array $ability) {
            $ability_model = PokemonAbility::query()->firstOrCreate(
                ['name' => ($name = $ability['ability']['name'])],
                ['name' => $name]
            );

            return [$ability_model->id => ['is_hidden' => (bool) $ability['is_hidden'], 'slot' => (int) $ability['slot']]];
        });
    }

    /**
     * @param  array<string, mixed>  $forms
     * @return Collection<array-key, PokemonForm>
     */
    protected function forms(array $forms): Collection
    {
        return collect($forms)->map(function (array $form) {
            $form = $this->poke_api->get($form['url']);

            return PokemonForm::query()->firstOrCreate(['pokeapi_id' => $form['id']], [
                'pokeapi_id' => $form['id'],
                'name' => $form['name'],
                'order' => $form['order'],
                'form_order' => $form['form_order'],
                'is_battle_only' => $form['is_battle_only'],
                'is_default' => $form['is_default'],
                'is_mega' => $form['is_mega'],
                'sprites' => $form['sprites'],
            ]);
        });
    }
}
