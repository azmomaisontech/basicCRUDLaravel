<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;

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

Route::apiResource("posts", PostController::class);


Route::group([
    'middleware' => 'api',
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'auth',
], function ($router) {
    Route::post("login", 'AuthController@login');
    Route::post("register", 'AuthController@register');
    Route::post("logout", 'AuthController@logout');
    Route::post("profile", 'AuthController@profile');
    Route::post("refresh", 'AuthController@refresh');
});
