<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Auth\AuthController;

// Auth process

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])
    ->name('showRegister');

Route::post('/register', [RegisterController::class, 'register'])
    ->name('saveRegister');

Route::group(['middleware' => ['guest']], function() {


    Route::get('/', [AuthController::class, 'showLogin'])
        ->name('showLogin');

    Route::post('login', [AuthController::class, 'login'])
        ->name('login');
});


Route::group(['middleware' => ['auth']], function() {

    // logout

    Route::post('logout', [AuthController::class, 'logout'])
        ->name('logout');


    Route::get('/posts', [PostController::class, 'index'])
        ->name('posts.index');

    Route::get('/posts/{post}', [PostController::class, 'show'])
        ->name('posts.show')
        ->where('post', '[0-9]+');

    Route::post('/posts/store', [PostController::class, 'store'])
        ->name('posts.store');

    Route::patch('/posts/{post}/update', [PostController::class, 'update'])
        ->name('posts.update')
        ->where('post', '[0-9]+');

    Route::delete('/posts/{post}/destroy', [PostController::class, 'destroy'])
        ->name('posts.destroy')
        ->where('post', '[0-9]+');

    Route::patch('/posts/{post}/checked', [PostController::class, 'checked'])
        ->name('posts.checked')
        ->where('post', '[0-9]+');

    Route::delete('/posts/purge', [PostController::class, 'purge'])
        ->name('posts.purge');

    Route::patch('/posts/{post}/upto', [PostController::class, 'upto'])
        ->name('posts.upto')
        ->where('post', '[0-9]+');

    Route::patch('/posts/{post}/downto', [PostController::class, 'downto'])
        ->name('posts.downto')
        ->where('post', '[0-9]+');

    Route::post('/posts/{post}/tasks', [TaskController::class, 'store'])
        ->name('tasks.store')
        ->where('post', '[0-9]+');

    Route::delete('/tasks/{task}/destroy', [TaskController::class, 'destroy'])
        ->name('tasks.destroy')
        ->where('task', '[0-9]+');
});







