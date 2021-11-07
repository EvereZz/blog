<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostCommentsController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PostController;
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

Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('posts/{post:slug}', [PostController::class, 'show']);

Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');

Route::post('posts/{post:slug}/comments', [PostCommentsController::class, 'store'])->middleware('auth');

Route::get('login', [SessionsController::class, 'create'])->middleware('guest');
Route::post('sessions', [SessionsController::class, 'store'])->middleware('guest');
Route::post('logout', [SessionsController::class, 'destroy'])->middleware('auth');

Route::middleware('can:admin')->group(function () {
    Route::resource('admin/posts', AdminController::class)->except('show');
//    Route::get('admin/posts', [AdminController::class, 'index']);
//    Route::get('admin/posts/create', [AdminController::class, 'create']);
//    Route::post('admin/posts', [AdminController::class, 'store']);
//    Route::get('admin/posts/{post}/edit', [AdminController::class, 'edit']);
//    Route::patch('admin/posts/{post}', [AdminController::class, 'update']);
//    Route::delete('admin/posts/{post}', [AdminController::class, 'destroy']);
});
