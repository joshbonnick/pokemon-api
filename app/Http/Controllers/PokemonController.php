<?php

namespace App\Http\Controllers;

use App\Enums\PokemonStats;
use App\Models\Pokemon;
use App\Repositories\PokemonRepository;
use Inertia\Inertia;
use Inertia\Response;

class PokemonController extends Controller
{
    public function index(PokemonRepository $pokemon_repository): Response
    {
        $pokemon = $pokemon_repository
            ->withRelations()
            ->select(['id', 'name', 'stats', 'order', 'base_experience', 'height', 'weight'])
            ->orderBy('order')
            ->paginate(20);

        return Inertia::render('Home', [
            'pokemon' => $pokemon,
            'pokemon_count' => $pokemon_repository->count(),
            'stats' => PokemonStats::labels(),
        ]);
    }

    public function show(PokemonRepository $pokemon_repository, Pokemon $pokemon): Response
    {
        $related = $pokemon_repository
            ->withRelations()
            ->select(['id', 'name', 'stats', 'order', 'base_experience', 'height', 'weight'])
            ->limit(5)
            ->inRandomOrder()
            ->get();

        return Inertia::render('Pokemon/Show', [
            'pokemon' => $pokemon_repository->eagerLoaded($pokemon),
            'related' => $related,
        ]);
    }
}
