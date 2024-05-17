<?php

namespace Tests\Feature\Commands\Pokemon;

use App\Console\Commands\Pokemon\ImportCommand;
use App\Jobs\Pokemon\ImportPokemon;
use App\Services\PokeAPI\Contracts\PokeAPIClient;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Queue;
use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ImportCommandTest extends TestCase
{
    #[Test]
    public function it_queues_import_job(): void
    {
        Http::preventStrayRequests();

        $this->instance(PokeAPIClient::class, Mockery::mock(PokeAPIClient::class, function (MockInterface $mock) {
            $mock->shouldReceive('listPokemon')->andReturn(['results' => [['url' => '::fake::']]]);
        }));

        Queue::fake();

        Artisan::call(ImportCommand::class);

        Queue::assertPushed(ImportPokemon::class);
    }
}
