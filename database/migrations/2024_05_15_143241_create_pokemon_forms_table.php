<?php

use App\Models\PokemonFormSprite;
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
        Schema::create('pokemon_forms', function (Blueprint $table) {
            $table->id();
            $table->integer('pokeapi_id');
            $table->string('name');
            $table->integer('order');
            $table->integer('form_order');
            $table->boolean('is_battle_only');
            $table->boolean('is_default');
            $table->boolean('is_mega');
            $table->foreignIdFor(PokemonFormSprite::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pokemon_forms');
    }
};