<?php

namespace App\Http\Resources;

use App\Models\PokemonAbility;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin PokemonAbility
 *
 * @property object{is_hidden: bool, slot: int} $pivot
 */
class PokemonAbilityResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'is_hidden' => $this->pivot->is_hidden,
            'slot' => $this->pivot->slot,
        ];
    }
}
