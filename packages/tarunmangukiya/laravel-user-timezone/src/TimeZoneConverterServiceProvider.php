<?php

namespace TarunMangukiya\TimeZoneConverter;

use Illuminate\Support\ServiceProvider;

class TimeZoneConverterServiceProvider extends ServiceProvider
{
    

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        /*
         * Register the service provider for the dependency.
         */
        $this->app->register('Torann\GeoIP\GeoIPServiceProvider');

        /*
         * Create aliases for the dependency.
         */
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('GeoIP', 'Torann\GeoIP\GeoIPFacade');

        $this->app['TimeZoneConverter'] = $this->app->share(function ($app) {
            return new TimeZoneConverter();
        });

        $this->app->alias('TimeZoneConverter', 'TarunMangukiya\TimeZoneConverter\TimeZoneConverter');

        include __DIR__.'/routes.php';
    }
}
