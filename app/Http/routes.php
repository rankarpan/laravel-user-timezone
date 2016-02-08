<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('', function () {
    return view('welcome');
});

Route::get('blog', 'BlogController@getBlog');

Route::group(['prefix' => 'api/v1'], function () {
	Route::resource('articles', 'ArticleController');
});

Route::get('/expiry-url', 'BlogController@generateExpiryUrl');

Route::post('/expiry-url', 'BlogController@postExpiryUrl');

Route::get('/expiry-url/{url}', 'BlogController@getExpiryUrl');

Route::get('/intervention-image', 'BlogController@getInterventionImage');

Route::post('/intervention-image', 'BlogController@postInterventionImage');

Route::get('/auto-mail', 'BlogController@getAutoMailContent');

Route::get('/send-reminder-email/{id}', 'BlogController@sendReminderEmail');

Route::post('/auto-mail', 'BlogController@postAutoMailContent');

Route::get('/identity-card', 'BlogController@getIDCard');

Route::get('/download-pdf', 'BlogController@getDownloadPDF');

Route::get('/algolia-search', 'BlogController@getAlgoliaSearch');

Route::post('/data', 'BlogController@postData');

Route::get('/generate/models', '\\Jimbolino\\Laravel\\ModelBuilder\\ModelGenerator5@start');

Route::get('/timezone', 'BlogController@getTimeZone');

Route::post('/timezone', 'BlogController@postTimeZone');