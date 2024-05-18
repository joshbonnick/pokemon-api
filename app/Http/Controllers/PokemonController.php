<?php

namespace App\Http\Controllers;

use App\Enums\PokemonStats;
use App\Models\Pokemon;
use Inertia\Inertia;
use Inertia\Response;

class PokemonController extends Controller
{
    public function index(): Response
    {

        $pokemon = Pokemon::query()
            ->withRelations()
            ->select(['id', 'name', 'stats', 'order', 'base_experience', 'height', 'weight'])
            ->orderBy('order')
            ->paginate(20);

        return Inertia::render('Home', [
            'pokemon' => $pokemon,
            'pokemon_count' => Pokemon::count(),
            'stats' => PokemonStats::labels(),
        ]);
    }

    public function show(Pokemon $pokemon): Response
    {
        $related = Pokemon::query()
            ->withRelations()
            ->select(['id', 'name', 'stats', 'order', 'base_experience', 'height', 'weight'])
            ->limit(5)
            ->inRandomOrder()
            ->get();

        return Inertia::render('Pokemon/Show', [
            'pokemon' => $pokemon->eagerLoaded(),
            'related' => $related,
        ]);
    }

    public function edit(Pokemon $pokemon): Response
    {
        return Inertia::render('Pokemon/Edit', [
            'pokemon' => $pokemon->eagerLoaded(),
        ]);
    }
}
