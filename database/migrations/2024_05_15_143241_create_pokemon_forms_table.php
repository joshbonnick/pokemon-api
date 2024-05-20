<?php

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
            $table->integer('pokeapi_id')->index();
            $table->string('name');
            $table->integer('order')->index();
            $table->integer('form_order')->index();
            $table->boolean('is_battle_only');
            $table->boolean('is_default');
            $table->boolean('is_mega');
            $table->json('sprites');
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
