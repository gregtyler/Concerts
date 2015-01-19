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

// Individual index pages
Route::get('/e/{id}', 'EventController@showSingle')->where('id', '[0-9]+');
Route::get('/e/abstract/{id}', 'EventController@showAbstract')->where('id', '[0-9]+');
Route::get('/venue/{id}', 'VenueController@showSingle')->where('id', '[0-9]+');
Route::get('/tag/{type}:{slug}', 'TagController@showSingle')->where(array(
    'type' => '[a-z]+',
    'slug' => '[a-z]+'
));

// Listings
Route::get('/list/{area}/{timeframe}', 'EventController@showList')->where(array(
    'area' => '[A-Za-z]+',
    'timeframe' => '[a-z_]+'
));
Route::get('/list/{area}', 'EventController@showList')->where('area','[A-Za-z]+');
Route::get('/list', 'EventController@showFind');
Route::post('/list', 'EventController@doFind');

// Administration
Route::get('/admin/add', 'AdminController@showAdd');

// Basic site pages
Route::get('/', 'BaseController@showHome');
Route::get('/about', 'BaseController@showAbout');