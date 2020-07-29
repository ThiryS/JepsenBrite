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
Route::get('/', 'EventController@indexWelcome')->name('events.index.wel');
Route::get('/events', 'EventController@index')->name('events.index');

Route::get('/events/{id}/edit', 'EventController@edit')->name('events.edit')->middleware('verified');
Route::put('/events/{id}', 'EventController@update')->name('events.update')->middleware('verified');
Route::delete('/events/{id}', 'EventController@destroy')->name('events.destroy')->middleware('verified');

Route::get('/events/new', 'EventController@new')->name('events.new')->middleware('verified');
Route::get('/events/{id}', 'EventController@find')->name('events.show');
Route::post('/events', 'EventController@create')->name('events.create')->middleware('verified');

Route::post('/events/{id}/comments', 'CommentsController@create')->name('comments.create')->middleware('verified');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile/{user}', 'ProfilesController@index')->name('profile.show');
Route::get('/profile/{user}/edit', 'ProfilesController@edit')->name('profile.edit')->middleware('verified');
Route::put('profile/{user}', 'ProfilesController@update')->name('profile.update')->middleware('verified');
Route::delete('/profile/{user}', 'ProfilesController@destroy')->name('profile.destroy')->middleware('verified');
