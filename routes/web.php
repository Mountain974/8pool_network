<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');

Route::resource('/users', App\Http\Controllers\UserController::class)->except('index', 'create', 'store');

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

Route::resource('/posts', App\Http\Controllers\PostController::class)->except('index');

Route::post('/posts\create', [App\Http\Controllers\PostController::class, 'store'])->name('posts.store');


