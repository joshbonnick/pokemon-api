<?php

namespace Database\Seeders;

use App\Models\Pokemon;
use App\Models\PokemonAbility;
use App\Models\PokemonForm;
use App\Models\PokemonHeldItem;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;

class PokemonSeeder extends Seeder
{
    public function run(): void
    {
        $pokemon = Pokemon::factory()->count(20)->create();

        $pokemon->each(function (Pokemon $pokemon): void {
            $pokemon->abilities()->syncWithPivotValues($this->abilities(), ['is_hidden' => false, 'slot' => 1]);
            $pokemon->forms()->sync($this->forms());
            $pokemon->held_items()->sync($this->held_items());
        });
    }

    /**
     * @return Collection<int, PokemonAbility>
     */
    protected function abilities(): Collection
    {
        return PokemonAbility::factory()->count(rand(1, 2))->create();
    }

    /**
     * @return Collection<int, PokemonForm>
     */
    protected function forms(): Collection
    {
        return PokemonForm::factory()->count(rand(1, 2))->create();
    }

    /**
     * @return Collection<int, PokemonHeldItem>
     */
    protected function held_items(): Collection
    {
        return PokemonHeldItem::factory()->count(rand(1, 4))->create();
    }
}
