<?php

namespace App\Http\Requests\Api\Pokemon;

use App\Enums\PokemonStats;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class IndexRequest extends FormRequest
{
    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            's' => ['string'],
            'stat_sort' => [new Enum(PokemonStats::class)],
        ];
    }
}
