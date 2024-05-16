<?php

namespace App\Http\Controllers\Api\Pokemon;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Pokemon\IndexRequest;
use App\Http\Resources\PokemonResource;
use App\Repositories\PokemonRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class IndexController extends Controller
{
    public function __invoke(IndexRequest $request, PokemonRepository $query): AnonymousResourceCollection
    {
        $validated = $request->safe();

        $pokemon_query = $query->withRelations();

        if ($validated->has('s')) {
            $search = str($validated->input('s'))->wrap('%');

            $pokemon_query->where(function (Builder $query) use ($search) {
                $query->where('name', 'like', $search);
            });
        }

        return PokemonResource::collection($pokemon_query->get());
    }
}
