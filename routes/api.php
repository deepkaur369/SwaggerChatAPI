<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
 * |--------------------------------------------------------------------------
 * | API Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register API routes for your application. These
 * | routes are loaded by the RouteServiceProvider within a group which
 * | is assigned the "api" middleware group. Enjoy building your API!
 * |
 */

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('user/login', 'api\UserController@login');
Route::post('user/signup', 'api\UserController@signup');
Route::post('user/update', 'api\UserController@update');
Route::post('chat/send-message', 'ChatController@sendMessage');
Route::post('chat/get-message', 'ChatController@getMessage');
Route::post('chat/all-message', 'ChatController@allMessage');


