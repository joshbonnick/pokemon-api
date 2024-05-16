<?php

namespace App\Http\Controllers\Api\Pokemon;

use App\Http\Controllers\Controller;
use App\Http\Resources\PokemonResource;
use App\Repositories\PokemonRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class IndexController extends Controller
{
    public function __invoke(Request $request, PokemonRepository $query): AnonymousResourceCollection
    {
        return PokemonResource::collection($query->withRelations()->paginate(15));
    }
}
