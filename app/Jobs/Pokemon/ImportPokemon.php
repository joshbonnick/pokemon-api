<?php

namespace App\Jobs\Pokemon;

use App\Services\PokeAPI\Contracts\PokeAPIClient;
use App\Services\PokeAPI\ImportProcessor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ImportPokemon implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct()
    {
    }

    public function handle(PokeAPIClient $client, ImportProcessor $import_processor): void
    {
        $list = $client->listPokemon(151);

        $pokemon = collect($list['results'])->map($import_processor->process(...));
    }
}
