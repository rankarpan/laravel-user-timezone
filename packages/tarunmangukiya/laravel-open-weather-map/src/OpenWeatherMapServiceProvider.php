<?php

namespace TarunMangukiya\OpenWeatherMap;

use Illuminate\Support\ServiceProvider;

class OpenWeatherMapServiceProvider extends ServiceProvider
{
    

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/views', 'laravel-open-weather-map');

        $this->publishes(array(
            __DIR__.'/config/config.php' => config_path('openweathermap.php')
        ));
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // merge default config
        //
        $this->mergeConfigFrom(
            __DIR__.'/config/config.php',
            'openweathermap'
        );

        $this->app['OpenWeatherMap'] = $this->app->share(function ($app) {
            return new OpenWeatherMap($app->cache, $app->view, $this->app['config']->get('openweathermap'));
        });

        $this->app->alias('OpenWeatherMap', 'TarunMangukiya\OpenWeatherMap\OpenWeatherMap');
    }
}
