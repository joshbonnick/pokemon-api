<?php

namespace Tests\Feature\Http\Controllers\Api\Pokemon;

use App\Models\Pokemon;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class DeleteControllerTest extends TestCase
{
    #[Test]
    public function it_can_delete_pokemon(): void
    {
        $pokemon = Pokemon::factory()->create();

        $response = $this->deleteJson(route('api.v1.pokemon.delete', [$pokemon]));
        $response->assertStatus(200);

        $this->assertModelMissing($pokemon);
    }
}
