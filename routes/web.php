<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Category;
use App\Http\Controllers\Admin\Tag;
use App\Http\Controllers\Admin\Post;
use App\Http\Controllers\Admin\User;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Personal;
use App\Http\Controllers\Main;
use App\Http\Controllers\Post\Comment;
use App\Http\Controllers\Post\Like;
use App\Http\Controllers;


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

Route::group([], function () {
    Route::get('/', Main\IndexController::class)->name('main.index');
});

Route::group(['prefix' => 'posts'], function () {
    Route::get('/', Controllers\Post\IndexController::class)->name('post.index');
    Route::get('/{post}', Controllers\Post\ShowController::class)->name('post.show');

    Route::group(['prefix' => '{post}/comments'], function () {
        Route::post('/', Comment\StoreController::class)->name('post.comment.store');
    });

    Route::group(['prefix' => '{post}/likes'], function () {
        Route::post('/', Like\StoreController::class)->name('post.like.store');
    });
});

Route::group(['prefix' => 'categories'], function () {
    Route::get('/', Controllers\Category\IndexController::class)->name('category.index');

    Route::group(['prefix' => '{category}/posts'], function () {
        Route::get('/', Controllers\Category\Post\IndexController::class)->name('category.post.index');
    });
});

Route::group(['prefix' => 'personal', 'middleware' => ['auth', 'verified']], function () {
    Route::get('/', Personal\Main\IndexController::class)->name('personal.main.index');

    Route::group(['prefix' => 'liked'], function () {
        Route::get('/', Personal\Liked\IndexController::class)->name('personal.liked.index');
        Route::delete('/{post}', Personal\Liked\DestroyController::class)->name('personal.liked.destroy');
    });

    Route::group(['prefix' => 'comments'], function () {
        Route::get('/', Personal\Comment\IndexController::class)->name('personal.comment.index');
        Route::get('/{comment}/edit', Personal\Comment\EditController::class)->name('personal.comment.edit');
        Route::patch('/{comment}', Personal\Comment\UpdateController::class)->name('personal.comment.update');
        Route::delete('/{comment}', Personal\Comment\DestroyController::class)->name('personal.comment.destroy');
    });
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin', 'verified']], function () {
    Route::get('/', Admin\Main\IndexController::class)->name('admin.main.index');

    Route::group(['prefix' => 'posts'], function () {
        Route::get('/', Post\IndexController::class)->name('admin.post.index');
        Route::get('/create', Post\CreateController::class)->name('admin.post.create');
        Route::post('/', Post\StoreController::class)->name('admin.post.store');
        Route::get('/{post}', Post\ShowController::class)->name('admin.post.show');
        Route::get('/{post}/edit', Post\EditController::class)->name('admin.post.edit');
        Route::patch('/{post}', Post\UpdateController::class)->name('admin.post.update');
        Route::delete('/{post}', Post\DestroyController::class)->name('admin.post.destroy');
    });

    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', Category\IndexController::class)->name('admin.category.index');
        Route::get('/create', Category\CreateController::class)->name('admin.category.create');
        Route::post('/', Category\StoreController::class)->name('admin.category.store');
        Route::get('/{category}', Category\ShowController::class)->name('admin.category.show');
        Route::get('/{category}/edit', Category\EditController::class)->name('admin.category.edit');
        Route::patch('/{category}', Category\UpdateController::class)->name('admin.category.update');
        Route::delete('/{category}', Category\DestroyController::class)->name('admin.category.destroy');
    });

    Route::group(['prefix' => 'tags'], function () {
        Route::get('/', Tag\IndexController::class)->name('admin.tag.index');
        Route::get('/create', Tag\CreateController::class)->name('admin.tag.create');
        Route::post('/', Tag\StoreController::class)->name('admin.tag.store');
        Route::get('/{tag}', Tag\ShowController::class)->name('admin.tag.show');
        Route::get('/{tag}/edit', Tag\EditController::class)->name('admin.tag.edit');
        Route::patch('/{tag}', Tag\UpdateController::class)->name('admin.tag.update');
        Route::delete('/{tag}', Tag\DestroyController::class)->name('admin.tag.destroy');
    });

    Route::group(['prefix' => 'users'], function () {
        Route::get('/', User\IndexController::class)->name('admin.user.index');
        Route::get('/create', User\CreateController::class)->name('admin.user.create');
        Route::post('/', User\StoreController::class)->name('admin.user.store');
        Route::get('/{user}', User\ShowController::class)->name('admin.user.show');
        Route::get('/{user}/edit', User\EditController::class)->name('admin.user.edit');
        Route::patch('/{user}', User\UpdateController::class)->name('admin.user.update');
        Route::delete('/{user}', User\DestroyController::class)->name('admin.user.destroy');
    });
});


Auth::routes(['verify' => true]);

