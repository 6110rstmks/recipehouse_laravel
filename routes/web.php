<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\CategoryController;
use App\Http\Controllers\User\RecipeController;
use App\Http\Controllers\User\TagController;


use App\Http\Controllers\RegisterController;

use App\Http\Controllers\User\Auth;
use App\Http\Controllers\Admin;




// Auth process

// ユーザ作成画面
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])
    ->name('register_form');

// ユーザ作成処理
Route::post('/register', [RegisterController::class, 'register'])
    ->name('saveRegister');

// recipe list page
Route::get('/recipes/list', [RecipeController::class, 'list'])
    ->name('recipes.list');

// recipe detailed page from list page
Route::get('/recipes/show/{recipe}', [RecipeController::class, 'showFromList'])
    ->name('recipes.showFromList')
    ->where('recipe', '[0-9]+')
    ->middleware('other_recipe');


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

    // sign out

    Route::post('sign_out', [App\Http\Controllers\User\Auth\AuthController::class, 'logout'])
    // Route::post('logout', [Auth\AuthController::class, 'logout'])
    // ↑だとエラーになる。Auth\からはじまる完全修飾名として認識されているようです。
        ->name('sign_out');

    // delete account
    Route::post('delete_member', [App\Http\Controllers\User\Auth\AuthController::class, 'delete'])
        ->name('delete_user');

    // recipe detailed page
    Route::get('/recipes/{recipe}', [RecipeController::class, 'show'])
        ->name('recipes.show')
        ->where('recipe', '[0-9]+');


    // recipe create page
    // Route::get('/recipes/create-page/{recipe}', [RecipeController::class, 'createPage'])
    Route::get('/recipes/create-page', [RecipeController::class, 'createPage'])
    ->name('recipes.create_page')
    ->where('recipe', '[0-9]+');

    // 草稿破棄
    Route::get('/recipes/{category}/discard', [RecipeController::class, 'discard'])
        ->name('recipes.discard');
    // recipe edit page
    Route::get('/recipes/edit-page/{recipe}', [RecipeController::class, 'editPage'])
        ->name('recipes.edit_page')
        ->where('recipe', '[0-9]+');

    Route::post('/recipes/edit/{recipe}', [RecipeController::class, 'edit'])
        ->name('recipes.edit')
        ->where('recipe', '[0-9]+');

    // categoryに紐付けたrecipeを追加(タイトル名のみ)
    Route::post('/pre_store/{category}/recipes', [RecipeController::class, 'pre_store'])
        ->name('recipes.pre_store')
        ->where('category', '[0-9]+');

    // Route::post('/store/{recipes}', [RecipeController::class, 'store'])
    Route::post('/store/recipes', [RecipeController::class, 'store'])
        ->name('recipes.store')
        ->where('category', '[0-9]+');

    // レシピを削除
    Route::delete('/recipes/{recipe}/destroy', [RecipeController::class, 'destroy'])
    // Route::delete('/categories/{category}/{recipe}/destroy', [RecipeController::class, 'destroy'])
    // 上のコメントアウトしているやつでやろうとしたがうまくいかなくて断念
    // dotinstallをみると/recipes/{recipe}/destroyでやっていた。
        ->name('recipes.destroy')
        ->where('recipe', '[0-9]+');

    // ごみばこ
    Route::get('/recipes/deleted_list', [RecipeController::class, 'deletedList'])
        ->name('recipes.deletedList');

    // restore process
    Route::post('/recipes/restore/{recipeId}/', [RecipeController::class, 'restore'])
        ->name('recipes.restore')
        ->where('recipeId', '[0-9]+');

    // consume point
    Route::post('/consume', function () {
        illuminate\Support\Facades\Auth::user()->point = illuminate\Support\Facades\Auth::user()->point - config('recipe.options.consumption_point');
        illuminate\Support\Facades\Auth::user()->save();
        // logger(Auth::user()->point);
        logger("3334p");
    });


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

    // Route::group(['prefix' => 'tags', 'as' => 'tags.'], function() {
    //     Route::post('/store/{recipe}', [TagController::class, 'store'])
    //         ->name('store')
    //         ->where('recipe', '[0-9]+');

    // });

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

    Route::get('/users/list', [Admin\UserController::class, 'list'])
        ->name('users.list');

    Route::get('/history/list', [Admin\UserController::class, 'historyList'])
    ->name('histories.list');

});
