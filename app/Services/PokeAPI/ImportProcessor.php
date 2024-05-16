<?php

namespace App\Services\PokeAPI;

use App\Models\Pokemon;
use App\Models\PokemonForm;
use App\Models\PokemonFormSprite;
use App\Models\PokemonHeldItem;
use App\Repositories\PokemonAbilityRepository;
use App\Repositories\PokemonFormRepository;
use App\Repositories\PokemonHeldItemRepository;
use App\Services\PokeAPI\DataTransferObjects\PokemonDto;
use Http;
use Illuminate\Support\Collection;

class ImportProcessor
{
    public function __construct(
        protected PokemonAbilityRepository $ability_repository,
        protected PokemonHeldItemRepository $held_item_repository,
        protected PokemonFormRepository $form_repository
    ) {
    }

    /**
     * @param  array{url: string}  $pokemon
     */
    public function process(array $pokemon): Pokemon
    {
        $payload = cache()->remember($pokemon['url'], now()->addHour(), fn () => Http::get($pokemon['url'])->json());

        $pokemon = PokemonDto::from($payload)->toModel();

        $pokemon->forms()->sync($this->processForms($payload['forms'])->pluck('id'));
        $pokemon->abilities()->sync($this->processAbilities($payload['abilities'])->toArray());
        $pokemon->held_items()->sync($this->processHeldItems($payload['held_items'])->pluck('id'));

        return $pokemon;
    }

    /**
     * @param  array<string, mixed>  $held_items
     * @return Collection<array-key, PokemonHeldItem>
     */
    protected function processHeldItems(array $held_items): Collection
    {
        return collect($held_items)->map(function (array $held_item) {
            return $this->held_item_repository->getItemByNameOrCreate($held_item);
        });
    }

    /**
     * @param  array<int, array{ability: array{name: string}, is_hidden: bool, slot: int}>  $abilities
     * @return Collection<array-key, array{is_hidden: bool, slot: int}>
     */
    protected function processAbilities(array $abilities): Collection
    {
        return collect($abilities)->mapWithKeys(function (array $ability) {
            $ability_model = $this->ability_repository->getAbilityByNameOrCreate($ability['ability']['name']);

            return [$ability_model->id => ['is_hidden' => (bool) $ability['is_hidden'], 'slot' => (int) $ability['slot']]];
        });
    }

    /**
     * @param  array<string, mixed>  $forms
     * @return Collection<array-key, PokemonForm>
     */
    protected function processForms(array $forms): Collection
    {
        return collect($forms)->map(function (array $form) {
            $form = cache()->remember($form['url'], now()->addHour(), fn () => Http::get($form['url'])->json());

            return $this->form_repository->getFormByPokeIdOrCreate($form['id'], $form,
                $this->processSprite($form['sprites']));
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
