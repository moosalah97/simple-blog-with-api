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
| is assigned the "Api" middleware group. Enjoy building your API!
|
*/




Route::post('/register' ,[\App\Http\Controllers\Api\AuthController::class, 'register']);
Route::post('/login' ,[\App\Http\Controllers\Api\AuthController::class, 'login']);
Route::post('/logout' ,[\App\Http\Controllers\Api\AuthController::class, 'logout']);
Route::get('/user-profile' ,[\App\Http\Controllers\Api\AuthController::class, 'userProfile']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});





Route::get('/posts' ,[\App\Http\Controllers\Api\PostsController::class, 'index']);
Route::get('/post/{id}' ,[\App\Http\Controllers\Api\PostsController::class, 'show']);
Route::post('/posts' ,[\App\Http\Controllers\Api\PostsController::class, 'store']);
Route::post('/post/{id}' ,[\App\Http\Controllers\Api\PostsController::class, 'update']);
Route::delete('/post/{id}' ,[\App\Http\Controllers\Api\PostsController::class, 'destroy']);