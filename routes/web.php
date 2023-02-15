<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\CategoryController;
use App\Http\Controllers\User\RecipeController;


use App\Http\Controllers\RegisterController;

use App\Http\Controllers\User\Auth;
use App\Http\Controllers\Admin;



// Auth process

// ユーザ作成画面
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])
    ->name('register_page');

// ユーザ作成処理
Route::post('/register', [RegisterController::class, 'register'])
    ->name('saveRegister');

// recipe list page
Route::get('/recipes/list', [RecipeController::class, 'list'])
    ->name('recipes.list');


Route::get('/recipes/{recipe}', [RecipeController::class, 'show'])
    ->name('recipes.show');


Route::group(['middleware' => ['guest:web']], function() {

    Route::get('/', [Auth\AuthController::class, 'showLogin'])
        ->name('login_form');

    Route::post('login', [Auth\AuthController::class, 'login'])
        ->name('login');

    // password reset page
    Route::get('password-reset-page', [Auth\PasswordResetController::class, 'index'])
        ->name('password-reset-page');

    // send email for password-reset process
    Route::post('password-reset-show', [Auth\PasswordResetController::class, 'sendEmail'])
        ->name('send-email-password-reset');

    // code entry page for password-reset
    Route::get('auth-code-form', function () {
        return view('reset.auth_code_form');
    })
    ->name('auth-code.entry_form')
    ->middleware('auth_code_form');

    Route::post('password-reset', [Auth\PasswordResetController::class, 'resetPassword'])
        ->name('password_reset');

});

Route::group([
    'middleware' => 'guest:admin',
    'prefix' => 'admin',
    // 'namespace' => 'Admin',
    // 'as' => 'admin'

    ], function(){

    // 管理者作成画面
    Route::get('/register', function () {
        return view('admin.register');
    // })->name('register_page');
    })->name('admin.register_page');

    Route::post('/register', [App\Http\Controllers\Admin\RegisterController::class, 'register'])
        // ->name('register');
        ->name('admin.register');

    // show loginPage
    Route::get('/login', function () {
        return view('admin.login');
    // })->name('login_page');
    })->name('admin.login_page');


    Route::post('/login', [App\Http\Controllers\Admin\LoginController::class, 'login'])
        ->name('admin.login');

});

Route::group([
    'middleware' => ['auth:web'],
    'namespace' => 'App\Http\Controllers\User',
    ], function() {

    Route::get('home', function () {
        return view('user.home');
    })->name('user.home');

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


    // カテゴリ関連
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

Route::group([
    'middleware' => 'auth:admin',
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'as' => 'admin.',
    ], function() {

    Route::get('/home', function() {
        return view('admin.home');
    })->name('home');

    Route::get('/members/list', [Admin\UserController::class, 'list'])
        ->name('members.list');


});
