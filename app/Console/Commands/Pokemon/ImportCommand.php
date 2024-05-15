<?php

namespace App\Console\Commands\Pokemon;

use App\Jobs\Pokemon\ImportPokemon;
use Illuminate\Console\Command;

class ImportCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'pokemon:import';

    /**
     * @var string
     */
    protected $description = 'Dispatch job to import Pokemon from PokeAPI';

    public function handle(): int
    {
        ImportPokemon::dispatch();

        return static::SUCCESS;
    }
}
