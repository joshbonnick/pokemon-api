<?php

namespace Tests\Feature\Http\Controllers\Api\Pokemon;

use App\Models\Pokemon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UpdateControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_update_pokemon(): void
    {
        $pokemon = Pokemon::factory()->create(['name' => '::old::']);

        $response = $this->patchJson(route('api.v1.pokemon.update', [$pokemon->id]), [
            'stats' => $pokemon->stats,
            'name' => '::new::',
        ]);
        $response->assertStatus(200);

        $this->assertDatabaseHas(Pokemon::class, ['id' => $pokemon->id, 'name' => '::new::']);
    }
}
