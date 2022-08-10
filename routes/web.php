<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/posts', [\App\Http\Controllers\PostsController::class,'index'])->name('posts.index');
Route::get('/posts/create', [\App\Http\Controllers\PostsController::class,'create'])->name('posts.create');
Route::post('/posts', [\App\Http\Controllers\PostsController::class,'store'])->name('posts.store');
Route::get('/posts/{id}/edit',[\App\Http\Controllers\PostsController::class,'edit'])->name('posts.edit');
Route::put('/posts/{id}',[\App\Http\Controllers\PostsController::class,'update'])->name('posts.update');
Route::delete('/posts/{id}',[\App\Http\Controllers\PostsController::class,'destroy'])->name('posts.destroy');

Auth::routes();


