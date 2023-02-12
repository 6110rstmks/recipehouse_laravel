<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\CategoryController;
use App\Http\Controllers\User\RecipeController;


use App\Http\Controllers\RegisterController;

use App\Http\Controllers\PasswordController;
use App\Http\Controllers\User\Auth\AuthController;
use App\Http\Controllers\Admin\LoginController;

// Auth process

// ユーザ作成画面
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])
    ->name('showRegister');

// ユーザ作成処理
Route::post('/register', [RegisterController::class, 'register'])
    ->name('saveRegister');

// recipe list page
Route::get('/recipes/list', [RecipeController::class, 'list'])
    ->name('recipes.list');


Route::get('/recipes/{recipe}', [RecipeController::class, 'show'])
    ->name('recipes.show');


Route::group(['middleware' => ['guest:web']], function() {


    Route::get('/', [AuthController::class, 'showLogin'])
        ->name('showLogin');

    Route::post('login', [AuthController::class, 'login'])
        ->name('login');

    // password reset process
    Route::get('password-reset', [PasswordResetController::class, 'index'])
        ->name('showPasswordReset');

    Route::get('password-reset-show', [PasswordResetController::class, 'sendEmail'])
        ->name('SendEmailForPasswordReset');


});

Route::group([
    'middleware' => 'guest:admin',
    'prefix' => 'admin',
    'namespace' => 'App\Http\Controllers\Admin',
    // 'name' => 'admin.'

    ], function(){

    // 管理者作成画面
    Route::get('/register', function () {
        return view('admin.register');
    })->name('admin.register_page');

    Route::post('/register', [RegisterController::class, 'register'])
        ->name('admin.register');

    // show loginPage
    Route::get('/login', function () {
        return view('admin.login');
    })->name('admin.login_page');


    Route::post('/login', [LoginController::class, 'login'])
        ->name('admin.login');

});

Route::group([
    'middleware' => ['auth:web'],
    'namespace' => 'App\Http\Controllers\User',
    ], function() {

    // logout

    Route::post('logout', [App\Http\Controllers\User\Auth\AuthController::class, 'logout'])
    // Route::post('logout', [Auth\AuthController::class, 'logout'])
    // ↑だとエラーになる。Auth\からはじまる完全修飾名として認識されているようです。
        ->name('logout');


    // categoryに紐付けたrecipeを追加
    Route::post('/categories/{category}/recipes', [RecipeController::class, 'store'])
        ->name('recipes.store')
        ->where('category', '[0-9]+');

    // レシピを削除
    Route::delete('/recipes/{recipe}/destroy', [RecipeController::class, 'destroy'])
    // Route::delete('/categories/{recipe}/{recipe}/destroy', [RecipeController::class, 'destroy'])
    // 上のコメントアウトしているやつでやろうとしたがうまくいかなくて断念
    // dotinstallをみると/recipes/{recipe}/destroyでやっていた。
        ->name('recipes.destroy')
        ->where('recipe', '[0-9]+');


    Route::group(['prefix' => 'categories', 'as' => 'categories.'], function() {
        Route::get('/', [CategoryController::class, 'index'])
        ->name('index');

        Route::delete('/purge', [CategoryController::class, 'purge'])
        ->name('purge');

        Route::delete('/{category}/destroy', [CategoryController::class, 'destroy'])
        ->name('destroy')
        ->where('category', '[0-9]+');

        Route::get('/{category}', [CategoryController::class, 'show'])
        ->name('show')
        ->where('category', '[0-9]+');

        Route::post('/store', [CategoryController::class, 'store'])
            ->name('store');

        Route::patch('/{category}/update', [CategoryController::class, 'update'])
            ->name('update')
            ->where('category', '[0-9]+');

        Route::patch('{category}/checked', [CategoryController::class, 'checked'])
            ->name('checked')
            ->where('category', '[0-9]+');


        Route::patch('/{category}/upto', [CategoryController::class, 'upto'])
            ->name('upto')
            ->where('category', '[0-9]+');

        Route::patch('/{category}/downto', [CategoryController::class, 'downto'])
            ->name('downto')
            ->where('category', '[0-9]+');
    });

});
