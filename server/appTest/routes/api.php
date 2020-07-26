<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users', 'UserController@getList');

Route::post('/events', 'EventController@createEvent');
Route::get('events', 'EventController@getAllEvent');
Route::get('events/{id}', 'EventController@getEvent');
Route::get('/eventsFil/{name}/{dstart}/{dend}', 'EventController@getFilterEvents');
Route::put('events/{id}', 'EventController@updateEvent');

Route::delete('/events/{is}', 'EventController@deleteEvent');

