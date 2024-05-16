<?php

namespace App\Http\Controllers\Api\Pokemon;

use App\Http\Controllers\Controller;
use App\Http\Resources\PokemonResource;
use App\Models\Pokemon;
use App\Repositories\PokemonRepository;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowController extends Controller
{
    public function __invoke(Pokemon $pokemon, PokemonRepository $query): JsonResource
    {
        return PokemonResource::make($query->eagerLoaded($pokemon));
    }
}
