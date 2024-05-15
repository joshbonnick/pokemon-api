<?php

use App\Models\Pokemon;
use App\Models\PokemonHeldItem;
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
        Schema::create('pokemon_pokemon_held_item', function (Blueprint $table) {
            $table->foreignIdFor(Pokemon::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(PokemonHeldItem::class)->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pokemon_held_item_pokemon');
    }
};
