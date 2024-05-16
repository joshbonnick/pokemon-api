<?php

namespace App\Console\Commands\Pokemon;

use App\Jobs\Pokemon\ImportPokemon;
use App\Services\PokeAPI\Contracts\PokeAPIClient;
use App\Services\PokeAPI\Exceptions\NoResultsFoundException;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

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

    /**
     * @throws NoResultsFoundException
     */
    public function handle(PokeAPIClient $client): int
    {
        $list = $client->listPokemon(151);

        if (! Arr::exists($list, 'results')) {
            throw new NoResultsFoundException();
        }

        collect($list['results'])->chunk(20)->each(function (Collection $results) {
            ImportPokemon::dispatch($results);
        });

        return static::SUCCESS;
    }
}
