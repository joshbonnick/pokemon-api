<?php

namespace App\Services\PokeAPI;

use App\Models\Pokemon;
use App\Models\PokemonAbility;
use App\Models\PokemonForm;
use App\Services\PokeAPI\Contracts\PokeAPIClient;
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

        $pokemon = $this->pokemon($payload);

        $pokemon->forms()->sync($this->forms($payload['forms'])->pluck('id'));
        $pokemon->abilities()->sync($this->abilities($payload['abilities']));

        return $pokemon;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    protected function pokemon(array $payload): Pokemon
    {
        return Pokemon::query()->firstOrCreate(['pokeapi_id' => $payload['pokeapi_id']], [
            'name' => $payload['name'],
            'pokeapi_id' => $payload['pokeapi_id'],
            'base_experience' => $payload['base_experience'],
            'height' => $payload['height'],
            'weight' => $payload['weight'],
            'cry' => $payload['cry'],
            'is_default' => $payload['is_default'],
            'order' => $payload['order'],
            'stats' => collect($payload['stats'])->mapWithKeys(fn (array $stat) => [
                data_get($stat, 'stat.name') => $stat['base_stat'],
            ])->toArray(),
        ]);
    }

    /**
     * @param  array<int, array{ability: array{name: string}, is_hidden: bool, slot: int}>  $abilities
     * @return Collection<array-key, array{is_hidden: bool, slot: int}>
     */
    protected function abilities(array $abilities): Collection
    {
        return collect($abilities)->mapWithKeys(function (array $ability) {
            $ability_model = PokemonAbility::query()->firstOrCreate(
                ['name' => ($name = data_get($ability, 'ability.name'))],
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
