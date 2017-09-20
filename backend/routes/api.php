<?php

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

Route::post('/login', ['uses' => 'LoginController@login']);
Route::get('/logout', ['uses' => 'LoginController@logout']);

Route::get('/users', ['uses' => 'UsersController@index']);
Route::post('/users/create', ['uses' => 'UsersController@store']);