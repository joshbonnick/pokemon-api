<?php

declare(strict_types=1);

namespace App\Providers;

use App\Contracts\PokemonQuery;
use App\Repositories\PokemonRepository;
use App\Services\PokeAPI\Contracts\PokeAPIClient;
use App\Services\PokeAPI\HttpClient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            abstract: PokeAPIClient::class,
            concrete: fn () => new HttpClient(
                Http::baseUrl(config('pokeapi.base_url'))->timeout(15)->asJson()->acceptJson()
            )
        );

        $this->app->singleton(PokemonQuery::class, PokemonRepository::class);
    }

    public function boot(): void
    {
        Model::preventLazyLoading(! app()->isProduction());
    }
}
