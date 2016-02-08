<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use AlgoliaSearch\Client;
use App\Contracts\Search;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() == 'local') {
            $this->app->register('Laracasts\Generators\GeneratorsServiceProvider');
        }
    
        $this->app->singleton(Search::class, function ()
        {
            $config = config('services.algolia');

            return new AlgoliaSearch(
                new Client($config['app_id'], $config['api_key'])
            );
        });
    }
}
