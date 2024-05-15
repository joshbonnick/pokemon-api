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
        Schema::create('pokemon_form_sprites', function (Blueprint $table) {
            $table->id();
            $table->string('front_default');
            $table->string('front_shiny');
            $table->string('back_default');
            $table->string('back_shiny');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pokemon_form_sprites');
    }
};
