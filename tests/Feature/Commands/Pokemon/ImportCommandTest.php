<?php

namespace Tests\Feature\Commands\Pokemon;

use App\Console\Commands\Pokemon\ImportCommand;
use App\Jobs\Pokemon\ImportPokemon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Queue;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ImportCommandTest extends TestCase
{
    #[Test]
    public function it_queues_import_job(): void
    {
        Queue::fake();

        Artisan::call(ImportCommand::class);

        Queue::assertPushed(ImportPokemon::class);
    }
}
