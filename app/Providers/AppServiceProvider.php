<?php

namespace App\Providers;

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
    }

    public function boot(): void
    {
        Model::preventLazyLoading(! app()->isProduction());
    }
}
