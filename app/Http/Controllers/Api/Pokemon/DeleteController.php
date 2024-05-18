<?php

namespace App\Http\Controllers\Api\Pokemon;

use App\Http\Controllers\Controller;
use App\Models\Pokemon;
use Illuminate\Http\JsonResponse;

class DeleteController extends Controller
{
    public function __invoke(Pokemon $pokemon): JsonResponse
    {
        $pokemon->delete();

        return response()->json();
    }
}
