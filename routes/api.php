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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', '\App\Domain\Http\Controllers\CrudRestController@index');
Route::post('/', '\App\Domain\Http\Controllers\CrudRestController@create');
Route::get('/{id}', '\App\Domain\Http\Controllers\CrudRestController@edit');
Route::put('/{id}', '\App\Domain\Http\Controllers\CrudRestController@update');
Route::delete('/{id}', '\App\Domain\Http\Controllers\CrudRestController@delete');