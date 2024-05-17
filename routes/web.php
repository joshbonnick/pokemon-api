<?php

use App\Http\Controllers\PokemonController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PokemonController::class, 'index'])->name('pokemon.index');
Route::get('/pokemon/{pokemon:id}', [PokemonController::class, 'show'])->name('pokemon.show');
Route::get('/pokemon/{pokemon:id}/edit', [PokemonController::class, 'edit'])->name('pokemon.edit');
