<?php

use App\Http\Controllers\PokemonController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PokemonController::class, 'index'])->name('home');
Route::get('/pokemon/{pokemon:id}', [PokemonController::class, 'show'])->name('home');
