<?php

namespace App\Http\Controllers\Api\Pokemon;

use App\Http\Controllers\Controller;
use App\Http\Resources\PokemonResource;
use App\Repositories\PokemonRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class IndexController extends Controller
{
    public function __invoke(Request $request, PokemonRepository $query): AnonymousResourceCollection
    {
        $validated = $request->validate(['s' => ['string']]);

        $pokemon = $query->withRelations();

        if (array_key_exists('s', $validated)) {
            $search = str($validated['s'])->wrap('%');

            $pokemon->where(function (Builder $subQuery) use ($search) {
                $subQuery->where('name', 'like', $search);
            });
        }

        return PokemonResource::collection($pokemon->get());
    }
}
