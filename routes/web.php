<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RecipeController;
// use App\Http\Controllers\LogController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\Auth\AuthController;

// Auth process

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])
    ->name('showRegister');

Route::post('/register', [RegisterController::class, 'register'])
    ->name('saveRegister');

// recipe list page
Route::get('/recipes/list', [RecipeController::class, 'list'])
    ->name('recipes.list');

Route::group(['middleware' => ['guest']], function() {


    Route::get('/', [AuthController::class, 'showLogin'])
        ->name('showLogin');

    Route::post('login', [AuthController::class, 'login'])
        ->name('login');

    Route::get('/password-reset', [PasswordController::class, 'resetPasswordPage'])
        ->name('password_reset');

    Route::post('/password-reset-email-send', [PasswordController::class, 'emailSend'])
        ->name('password-reset.email.send');

});



Route::group(['middleware' => ['auth']], function() {

    // logout

    Route::post('logout', [AuthController::class, 'logout'])
        ->name('logout');


    Route::get('/categories', [CategoryController::class, 'index'])
        ->name('categories.index');

    Route::get('/categories/{recipe}', [CategoryController::class, 'show'])
        ->name('categories.show')
        ->where('category', '[0-9]+');

    Route::post('/categories/store', [CategoryController::class, 'store'])
        ->name('categories.store');

    Route::patch('/categories/{recipe}/update', [CategoryController::class, 'update'])
        ->name('categories.update')
        ->where('category', '[0-9]+');

    Route::delete('/categories/{recipe}/destroy', [CategoryController::class, 'destroy'])
        ->name('categories.destroy')
        ->where('category', '[0-9]+');

    Route::patch('/categories/{recipe}/checked', [CategoryController::class, 'checked'])
        ->name('categories.checked')
        ->where('category', '[0-9]+');

    Route::delete('/categories/purge', [CategoryController::class, 'purge'])
        ->name('categories.purge');

    Route::patch('/categories/{recipe}/upto', [CategoryController::class, 'upto'])
        ->name('categories.upto')
        ->where('category', '[0-9]+');

    Route::patch('/categories/{recipe}/downto', [CategoryController::class, 'downto'])
        ->name('categories.downto')
        ->where('category', '[0-9]+');

    // postに紐付けたタスクを追加
    Route::post('/categories/{recipe}/recipes', [RecipeController::class, 'store'])
        ->name('recipes.store')
        ->where('category', '[0-9]+');

    Route::delete('/recipes/{recipe}/destroy', [RecipeController::class, 'destroy'])
    // Route::delete('/categories/{recipe}/{recipe}/destroy', [RecipeController::class, 'destroy'])
    // 上のコメントアウトしているやつでやろうとしたがうまくいかなくて断念
    // dotinstallをみると/recipes/{recipe}/destroyでやっていた。
        ->name('recipes.destroy')
        ->where('recipe', '[0-9]+');



});







