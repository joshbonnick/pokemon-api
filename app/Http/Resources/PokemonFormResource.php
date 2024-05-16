<?php

namespace App\Http\Resources;

use App\Models\PokemonForm;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin PokemonForm
 */
class PokemonFormResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'order' => $this->order,
            'form_order' => $this->form_order,
            'is_battle_only' => $this->is_battle_only,
            'is_default' => $this->is_default,
            'is_mega' => $this->is_mega,
            'sprites' => $this->sprites,
        ];
    }
}
