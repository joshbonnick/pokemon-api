<?php

namespace App\Jobs\Pokemon;

use App\Services\PokeAPI\ImportProcessor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class ImportPokemon implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @param  Collection<int, array{url: string, name:string}>  $pokemon
     */
    public function __construct(protected Collection $pokemon)
    {
    }

    public function handle(ImportProcessor $import_processor): void
    {
        $this->pokemon->each(function (array $pokemon) use ($import_processor) {
            $import_processor->process($pokemon);
        });
    }
}
