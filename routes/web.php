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


Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::get('/events', 'EventController@index')->name('events.index');
// Route::put('/events/{id}', 'EventController@edit');
// Route::delete('/events/{id}', 'EventController@delete');
Route::get('/events/new', 'EventController@new')->name('events.new')->middleware('verified');
Route::get('/events/{id}', 'EventController@find')->name('events.show');
Route::post('/events', 'EventController@create')->name('events.create')->middleware('verified');
