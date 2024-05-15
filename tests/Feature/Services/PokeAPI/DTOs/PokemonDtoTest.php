<?php

namespace Tests\Feature\Services\PokeAPI\DTOs;

use App\Models\Pokemon;
use App\Services\PokeAPI\DataTransferObjects\PokemonDto;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class PokemonDtoTest extends TestCase
{
    #[Test]
    public function it_converts_to_model(): void
    {
        $dto = PokemonDto::from(json_decode($this->stub('tests/stubs/pokemon-payload.json'), true));

        $this->assertInstanceOf(Pokemon::class, $dto->toModel());
    }
}
