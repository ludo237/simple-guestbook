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

/**
 * HTTP Endpoints
 */
$app->group(['namespace' => 'App\Http\Controllers'], function($app)
{
    $app->get('/', ['as' => 'home', 'uses' => 'HomeController@index']);
});

/**
 * Javascript API endpoints
 */
$app->group(['prefix' => 'api', 'namespace' => 'App\Http\Controllers'], function($app)
{
    $app->get('messages', ['as' => 'guestbook.messages', 'uses' => 'GuestbookController@retrieveMessages']);
    $app->post('messages', ['as' => 'guestbook.messages', 'uses' => 'GuestbookController@postMessage']);
});
