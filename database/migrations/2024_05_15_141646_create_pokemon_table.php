<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pokemon', function (Blueprint $table) {
            $table->id();
            $table->integer('pokeapi_id')->index();
            $table->integer('base_experience');
            $table->string('name')->index();
            $table->integer('height');
            $table->boolean('is_default');
            $table->json('stats');
            $table->integer('order')->index();
            $table->integer('weight');
            $table->string('cry');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pokemon');
    }
};
