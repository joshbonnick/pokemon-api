<?php

namespace Tests\Feature\Repositories;

use App\Models\Pokemon;
use App\Repositories\PokemonRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class PokemonRepositoryTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function all_method_returns_all_pokemon(): void
    {
        Pokemon::factory()->count(3)->create();

        $this->assertCount(3, resolve(PokemonRepository::class)->all()->select('id')->get());
    }
}
