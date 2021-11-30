<?php

use App\Http\Controllers\FollowersController;
use App\Http\Controllers\VerifyEmailController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\RssFeedController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\PostCommentsController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\BookmarksController;
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

Route::get('feed', [RssFeedController::class, 'feed']);

Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');

Route::post('posts/{post:slug}/comments', [PostCommentsController::class, 'store'])->middleware('auth');

Route::get('login', [SessionsController::class, 'create'])->middleware('guest')->name('login');
Route::post('sessions', [SessionsController::class, 'store'])->middleware('guest')->name('session');
Route::post('logout', [SessionsController::class, 'destroy'])->middleware('auth')->name('logout');

Route::middleware('can:admin')->group(function () {
    Route::resource('admin/posts', AdminController::class)->except('show');
});

Route::get('account/{user:username}', [AccountController::class, 'show'])->middleware('auth');
Route::get('account/{user:username}/edit', [AccountController::class, 'edit'])->middleware('auth');
Route::patch('account/{user}', [AccountController::class, 'update'])->middleware('auth');

Route::get('account/{user:username}/bookmarks', [BookmarksController::class, 'show'])->middleware('auth');
Route::post('account/{post:slug}/bookmarks', [BookmarksController::class, 'store'])->middleware('auth');
Route::delete('account/bookmarks/{post:slug}', [BookmarksController::class, 'destroy'])->middleware('auth');

Route::get('forgot-password', [PasswordResetController::class, 'create'])->middleware('guest')->name('password.request');
Route::post('forgot-password', [PasswordResetController::class, 'store'])->middleware('guest')->name('password.email');
Route::get('reset-password/{token}', [PasswordResetController::class, 'edit'])->middleware('guest')->name('password.reset');
Route::post('reset-password', [PasswordResetController::class, 'update'])->middleware('guest')->name('password.update');

Route::get('email/verify', [VerifyEmailController::class, 'show'])->middleware('auth')->name('verification.notice');
Route::get('email/verify/{id}/{hash}', [VerifyEmailController::class, 'store'])->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('email/verification-notification', [VerifyEmailController::class, 'update'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('account/{user:username}/followings', [FollowersController::class, 'show'])->middleware('auth');
Route::post('account/{user:username}/followings', [FollowersController::class, 'store'])->middleware('auth');
Route::delete('account/followings/{user:username}', [FollowersController::class, 'destroy'])->middleware('auth');