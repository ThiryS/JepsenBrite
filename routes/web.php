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


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'EventController@indexWelcome')->name('events.index.wel');
Route::get('/events', 'EventController@index')->name('events.index');

Route::get('/events/{id}/edit', 'EventController@edit')->name('events.edit');
Route::put('/events/{id}', 'EventController@update')->name('events.update');
Route::delete('/events/{id}', 'EventController@destroy')->name('events.destroy');
    

Route::get('/events/create', 'EventController@create')->name('events.create');
Route::get('/events/{id}', 'EventController@find')->name('events.show');
Route::post('/events', 'EventController@store')->name('events.store');

Route::post('/events/{id}/comments', 'CommentsController@create')->name('comments.create');
Route::get('/events/{event_id}/comments/{id}/edit', 'CommentsController@commentEdit') -> name('comment.edit');
Route::put('/events/{event_id}/comments/{id}/update', 'CommentsController@commentUpdate') -> name('comment.update');
Route::delete('/events/{event_id}/commentdelete/{id}', 'CommentsController@deleteComment') -> name('comment.destroy');

Route::post('/events/{id}/participates', 'ParticipateController@create')->name('participate.create');
Route::get('/events/{id}/participants', 'ParticipateController@show')->name('participate.show');
Route::delete('/events/{id}/participates', 'ParticipateController@destroy')->name('participate.destroy');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile/{user}', 'ProfilesController@index')->name('profile.show');
Route::get('/profile/{user}/edit', 'ProfilesController@edit')->name('profile.edit');
Route::get('/profile/{user}/futurevents', 'ProfilesController@futureEvents')->name('profile.future');
Route::get('/profile/{user}/pastevents', 'ProfilesController@pastEvents')->name('profile.past');
Route::put('profile/{user}', 'ProfilesController@update')->name('profile.update');
Route::delete('/profile/{user}', 'ProfilesController@destroy')->name('profile.destroy');


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin/eventboard', 'AdminController@adminEvents')->middleware('is_admin')->name('admin.event.show');
Route::get('/admin/eventboard/{id}/edit', 'AdminController@adminEventEdit')->middleware('is_admin')->name('admin.event.edit');
Route::put('/admin/eventboard/{id}/update', 'AdminController@adminEventUpdate')->middleware('is_admin')->name('admin.event.update');
Route::delete('/admin/eventboard/{id}', 'AdminController@destroyEvent')->middleware('is_admin')->name('admin.events.destroy');

Route::get('/admin/eventboard/{id}/comments', 'AdminController@displayComments') -> middleware('is_admin') -> name('admin.comments.show');
Route::get('/admin/eventboard/{event_id}/comments/{id}/edit', 'AdminController@adminCommentEdit') -> middleware('is_admin') -> name('admin.comment.edit');
Route::put('/admin/eventboard/{event_id}/comments/{id}/update', 'AdminController@adminCommentUpdate') -> middleware('is_admin') -> name('admin.comment.update');
Route::delete('/admin/eventboard/{event_id}/commentdelete/{id}', 'AdminController@deleteComment') -> middleware('is_admin') -> name('admin.comment.destroy');

Route::get('/admin/userboard', 'AdminController@adminUsers')->middleware('is_admin')->name('admin.users.show');
Route::get('/admin/userboard/{id}/edit', 'AdminController@adminUserEdit')->middleware('is_admin')->name('admin.user.edit');
Route::put('/admin/userboard/{id}/update', 'AdminController@adminUserUpdate')->middleware('is_admin')->name('admin.user.update');
Route::delete('/admin/userboard/{user}', 'AdminController@destroyUser')->middleware('is_admin')->name('admin.users.destroy');
