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
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', 'API\UserController@register');
Route::post('login', 'API\UserController@login');
Route::post('softdeleterecord', 'API\BookController@softDeleteRecord');
Route::post('addrecord', 'API\BookController@addRecord');
Route::post('updaterecord', 'API\BookController@updateRecord');
Route::post('/updatebook', 'API\BookController@updateBook');
Route::post('permanentdelete', 'API\BookController@permanentDelete');
Route::post('restore', 'API\BookController@restoreEntry');


