<?php

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


Auth::routes(['verify' => true]);


Route::get('/welcome', 'WelcomeController@index')->name('welcome');

Route::post('/star/{post}', 'StarsController@store');

Route::post('/add/{post}', 'AddsController@store');
Route::post('/add/{category}/{post}', 'AddsController@store_category');
Route::post('/remove/{post}/{album}', 'AddsController@restore');

Route::post('/subscribe/{album}', 'SubscribesController@store');

Route::post('/comment/{album}', 'CommentsController@store');
Route::delete('/comment/{comment}', 'CommentsController@destroy');

Route::get('/users', 'UsersController@index');
Route::get('/users/search',function(){ return App\User::all(); });

Route::get('/library/{user}', 'LibrariesController@index');
Route::get('/library/{user}/{album}', 'LibrariesController@show');

Route::post('/album', 'AlbumsController@store');
Route::get('/album/create', 'AlbumsController@create');
Route::get('/album/{user}', 'AlbumsShowController@index');
Route::get('/album/{album}/edit', 'AlbumsController@edit');
Route::patch('/album/{album}', 'AlbumsController@update');
Route::get('/album/{user}/{album}', 'AlbumsShowController@show');
Route::delete('/album/{album}', 'AlbumsController@destroy');

Route::post('/p', 'PostsController@store');
Route::get('/p/{prefecture}/create', 'PostsController@create');
Route::get('/post/{post}', 'PostsShowController@show_general');
Route::get('/p/{post}', 'PostsShowController@show');
Route::get('/p/{category}/{post}', 'PostsShowController@show_category');
Route::get('/p/album/{album}/{post}', 'PostsShowController@show_album');
Route::get('/p/library/{user}/{album}/{post}', 'PostsShowController@show_library');
Route::delete('/p/{post}', 'PostsController@destroy');
Route::get('/p/stars/{user}/{post}', 'PostsController@stars');

Route::get('/profile/{user}/edit', 'ProfilesController@edit');
Route::get('/profile/{user}/{prefecture}', 'ProfilesController@pref');
Route::get('/profile/{user}', 'ProfilesController@show');
Route::patch('/profile/{user}', 'ProfilesController@update');
Route::get('/stars/{user}', 'ProfilesController@stars');

Route::get('/', 'PostsController@index');
Route::post('/filter', 'PostsController@index_filter')->middleware('keyword');
Route::get('/following', 'PostsController@index_following');
Route::get('/albums', 'PostsController@index_album');
Route::post('/albums/filter', 'PostsController@index_album_filter')->middleware('keyword');
