<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Defaults
    |--------------------------------------------------------------------------
    |
    | This can be overridden in the render method
    |
    */

    'defaults' => array(
        'style' => 'default',
        'query' => null,
        'days'  => 4,
        'units' => 'metric',
        'night' => 'no',
        'date'  => 'l',
        'appid' => env('OPENWEATHERMAP_APPID', null)
    ),

    /*
    |--------------------------------------------------------------------------
    | Cache Time
    |--------------------------------------------------------------------------
    |
    | How long to keep the forecast cached
    |
    */

    'cache' => 0,

    /*
    |--------------------------------------------------------------------------
    | Weather Widget Views
    |--------------------------------------------------------------------------
    |
    | The VIEWS used to render weather widget with Laravel Weather
    | method render.
    |
    | By default, the out of the box confide views are used
    | but you can create your own widgets and replace the view
    | names here. For example
    |
    |  // To use app/views/widgets/weather/{different widgets}
    |
    | 'views' => 'widgets/weather'
    |
    |
    */

    'views' => 'laravel-open-weather-map::widgets',
);

