<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use App\Repositories\PokemonRepository;
use Inertia\Inertia;
use Inertia\Response;

class PokemonController extends Controller
{
    public function index(PokemonRepository $pokemon_repository): Response
    {
        return Inertia::render('Home', [
            'pokemon' => $pokemon_repository->withRelations()->select([
                'id', 'name', 'stats',
            ])->orderBy('order')->paginate(20),
            'pokemon_count' => $pokemon_repository->count(),
        ]);
    }

    public function show(PokemonRepository $pokemon_repository, Pokemon $pokemon): Response
    {
        return Inertia::render('Pokemon/Show', [
            'pokemon' => $pokemon_repository->eagerLoaded($pokemon),
        ]);
    }
}
