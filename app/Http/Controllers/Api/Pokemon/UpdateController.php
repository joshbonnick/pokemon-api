<?php

namespace App\Http\Controllers\Api\Pokemon;

use App\Actions\Pokemon\UpdatePokemon;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Pokemon\UpdateRequest;
use App\Models\Pokemon;
use Illuminate\Http\JsonResponse;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Pokemon $pokemon, UpdatePokemon $action): JsonResponse
    {
        $action->handle($pokemon, $request->safe()->toArray());

        return response()->json();
    }
}
