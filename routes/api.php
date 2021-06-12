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
  Route::get('/{video}/edit','VideoController@edit');
  Route::get('/{video}/{field}','VideoController@show');
});