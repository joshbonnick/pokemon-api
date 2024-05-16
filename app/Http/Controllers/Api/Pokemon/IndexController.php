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

        $pokemon_query = $query->withRelations()
            ->select(['id', 'name', 'stats', 'order', 'base_experience', 'height', 'weight']);

        if ($validated->has('s')) {
            $search = str($validated->input('s'))->wrap('%');

            $pokemon_query->where(function (Builder $query) use ($search) {
                $query->where('name', 'like', $search);
            });
        }

        if ($validated->has('stat_sort')) {
            $stat = $validated->input('stat_sort');

            $pokemon_query->orderByRaw("CAST(stats->'$.{$stat}' AS unsigned) DESC");
        }

        $pokemon_query->orderBy('order');

        return PokemonResource::collection($pokemon_query->get());
    }
}
