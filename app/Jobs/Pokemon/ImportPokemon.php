<?php

namespace App\Jobs\Pokemon;

use App\Services\PokeAPI\Contracts\PokeAPIClient;
use App\Services\PokeAPI\Exceptions\NoResultsFoundException;
use App\Services\PokeAPI\ImportProcessor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Arr;

class ImportPokemon implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(protected int $limit)
    {
    }

    /**
     * @throws NoResultsFoundException
     */
    public function handle(PokeAPIClient $client, ImportProcessor $import_processor): void
    {
        $list = $client->listPokemon($this->limit);

        if (! Arr::exists($list, 'results')) {
            throw new NoResultsFoundException();
        }

        collect($list['results'])->each($import_processor->process(...));
    }
}
