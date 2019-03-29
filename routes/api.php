<?php

use Illuminate\Http\Request;

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

Route::post('/register', 'AuthController@register');

Route::post('/login', 'AuthController@login');

Route::post('/logout', 'AuthController@logout');

Route::middleware('auth:api')->get('/users', 'UserController@index')->name('users.index');

Route::post('/users', 'UserController@store')->name('users.store');

Route::get('/users/{id}', 'UserController@show')->name('users.show'); // по условию задания читать по одному пользователю может и НЕ авториз.user

Route::middleware('auth:api')->put('/users/{id}', 'UserController@update')->name('users.update');

Route::middleware('auth:api')->delete('/users/{id}', 'UserController@delete')->name('users.delete');

