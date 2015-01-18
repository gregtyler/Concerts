<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

App::missing(function($exception) {
    return Response::view('errors.missing', array(), 404);
});

Route::get('/', 'EventController@showList');
Route::get('/e/{id}', 'EventController@showSingle')->where('id', '[0-9]+');
Route::get('/venue/{id}', 'VenueController@showSingle')->where('id', '[0-9]+');
Route::get('/tag/{type}:{slug}', 'TagController@showSingle')->where(array(
    'type' => '[a-z]+',
    'slug' => '[a-z]+'
));