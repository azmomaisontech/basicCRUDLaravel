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


Route::post("register", [RegisterController::class, 'register']);
Route::post("login", [AuthController::class, 'login']);
Route::post("logout", [AuthController::class, 'logout']);
Route::post("refresh", [AuthController::class, 'refresh']);
Route::post("me", [AuthController::class, 'me']);
