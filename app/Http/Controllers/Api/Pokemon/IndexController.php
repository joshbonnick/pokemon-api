<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Pokemon;

use App\Contracts\PokemonQuery;
use App\Http\Controllers\Controller;
use App\Http\Resources\PokemonResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class IndexController extends Controller
{
    public function __invoke(Request $request, PokemonQuery $query): AnonymousResourceCollection
    {
        return PokemonResource::collection($query->all()->paginate(15));
    }
}
