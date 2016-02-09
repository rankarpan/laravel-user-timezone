<?php

namespace TarunMangukiya\OpenWeatherMap\Facades;

use Illuminate\Support\Facades\Facade;

class OpenWeatherMap extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'OpenWeatherMap';
    }
}
