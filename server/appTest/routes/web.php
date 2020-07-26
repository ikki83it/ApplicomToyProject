<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/', [ 'as' => 'home', function () { //nomino la rotta 'home'
    return "Benvenuti in Biblios";
}]);
Route::get('/home', function () {
    return redirect(route('home'));
});
Route::get('/users', 'UserController@getList');
Route::get('/events', 'EventController@index');
Route::get('/events/{event}', 'EventController@show');
//Route::post('/events/{event}', 'EventController@store');
Route::post('events', 'EventController@createEvent');
Route::put('/events/{event}', 'EventController@update');
Route::delete('/events/{event}', 'EventController@delete');
