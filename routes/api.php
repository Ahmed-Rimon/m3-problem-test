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

// Route::apiResource('user','API\UserController');
Route::apiResources(['user' => 'API\UserController']);
Route::get('profile','API\UserController@profile');
Route::put('profile','API\UserController@updateProfile');


Route::apiResources(['products' => 'API\ProductsController']);
