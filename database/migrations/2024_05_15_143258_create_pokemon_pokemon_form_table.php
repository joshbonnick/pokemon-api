<?php

use App\Models\Pokemon;
use App\Models\PokemonForm;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pokemon_pokemon_form', function (Blueprint $table) {
            $table->foreignIdFor(Pokemon::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(PokemonForm::class)->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pokemon_pokemon_form');
    }
};
