<?php

namespace App\Http\Resources;

use App\Models\PokemonFormSprite;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin PokemonFormSprite
 */
class PokemonFormSpriteResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'back_default' => $this->back_default,
            'back_shiny' => $this->back_shiny,
            'front_default' => $this->front_default,
            'front_shiny' => $this->front_shiny,
        ];
    }
}
