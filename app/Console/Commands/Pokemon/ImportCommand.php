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
    protected $signature = 'pokemon:import {limit=151} {chunk-size=20}';

    /**
     * @var string
     */
    protected $description = 'Dispatch job to import Pokemon from PokeAPI';

    /**
     * @throws NoResultsFoundException
     */
    public function handle(PokeAPIClient $client): int
    {
        $limit = (int) $this->argument('limit');

        $this->info("Attempting to importing $limit Pokemon");

        $list = $client->listPokemon($limit, 0);

        if (! Arr::exists($list, 'results')) {
            throw new NoResultsFoundException();
        }

        collect($list['results'])->chunk((int) $this->argument('chunk-size'))->each(function (Collection $results) {
            ImportPokemon::dispatch($results);
        });

        return static::SUCCESS;
    }
}
