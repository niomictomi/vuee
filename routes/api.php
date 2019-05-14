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

Route::get('/person','PersonController@all');
Route::get('/person/{id}','PersonController@by_id');
Route::get('/person/search/query','PersonController@search');
Route::post('/person','PersonController@store');
Route::put('/person/{id}','PersonController@update');
Route::delete('/person/{id}','PersonController@delete');
