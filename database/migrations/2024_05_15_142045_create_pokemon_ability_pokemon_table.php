<?php

use App\Models\Pokemon;
use App\Models\PokemonAbility;
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
        Schema::create('pokemon_pokemon_ability', function (Blueprint $table) {
            $table->foreignIdFor(Pokemon::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(PokemonAbility::class)->constrained()->cascadeOnDelete();
            $table->boolean('is_hidden');
            $table->integer('slot');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pokemon_ability_pokemon');
    }
};
