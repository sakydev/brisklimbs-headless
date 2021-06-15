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

/* Authentication routes */
Route::post('/register', 'UserController@register');
Route::post('/login', 'UserController@login');

Route::group(['prefix' => 'videos', 'middleware' => ['auth:sanctum']], function() {
  Route::get('/','VideoController@index');
  Route::get('/{video}','VideoController@show');
  // Route::post('/{video}/edit','VideoController@edit');
  Route::get('/search/{keyword}','VideoController@search');
  Route::get('/{video}/{field}','VideoController@show');
});

Route::group(['prefix' => 'users', 'middleware' => ['auth:sanctum']], function() {
  Route::get('/{user}/history','UserHistoryController@index');
  Route::post('/{user}/history','UserHistoryController@store');
  Route::delete('/{user}/history/{video}','UserHistoryController@destroy');
  Route::delete('/{user}/history','UserHistoryController@destroy');

  // add {user} playlist
  Route::post('/{user}/playlists', 'PlaylistController@store');
  
  // show {user} all playlists
  Route::get('/{user}/playlists', 'PlaylistController@index');
  
// show {user} single playlist
  Route::get('/{user}/playlists/{playlist}', 'PlaylistController@show');

  // update {user} playlist's details
  Route::put('/{user}/playlists/{playlist}', 'PlaylistController@update');

  // add {video} to {user} playlist's
  Route::post('/{user}/playlists/{playlist}', 'PlaylistController@store_item');

  // delete {user} playlist
  Route::delete('/{user}/playlists/{playlist}', 'PlaylistController@destroy');

  // delete {video} from {user} playlist
  Route::delete('/{user}/playlists/{playlist}/{video}', 'PlaylistController@destroy_item');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth:sanctum', 'admin']], function() {
  // show all categories
  Route::get('/categories', 'CategoryController@index');

  // show single category
  Route::get('/categories/{category}', 'CategoryController@show');

  // update a category
  Route::put('/categories/{category}', 'CategoryController@update');

  // add new category
  Route::post('/categories', 'CategoryController@store');

  // delete category
  Route::delete('/categories/{category}', 'CategoryController@destroy');
});