<?php

namespace App\Http\Resources;

use App\Models\Pokemon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Pokemon
 */
class PokemonResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->pokeapi_id,
            'name' => $this->name,
            'base_experience' => $this->base_experience,
            'stats' => $this->stats,
            'weight' => $this->weight,
            'height' => $this->height,
            'is_default' => $this->is_default,
            'abilities' => PokemonAbilityResource::collection($this->abilities),
            'held_items' => $this->held_items,
            'forms' => PokemonFormResource::collection($this->forms),
        ];
    }
}
