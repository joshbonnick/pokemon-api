<?php

use App\Http\Controllers\Api\Pokemon\IndexController as PokemonIndexController;
use App\Http\Controllers\Api\Pokemon\ShowController as PokemonShowController;
use App\Http\Controllers\Api\Pokemon\UpdateController as PokemonUpdateController;

Route::group(['prefix' => 'v1', 'as' => 'api.v1.'], function () {
    Route::get('pokemon', PokemonIndexController::class)->name('pokemon.index');
    Route::get('pokemon/{pokemon:id}', PokemonShowController::class)->name('pokemon.show');
    Route::patch('pokemon/{pokemon:id}', PokemonUpdateController::class)->name('pokemon.update');
});
