<?php

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Auth;

Route::get('/', [PostController::class, 'getPosts']);

Route::get('/posts/{id}', [PostController::class, 'getSinglePost']);

Route::get('/posts', [PostController::class, 'getposts']);
Route::post('/posts', [PostController::class, 'postPosts']);

Route::get('/create', [Auth::class, 'getCreate']);
Route::post('/create', [Auth::class, 'postCreate']);

Route::post('/comment', [CommentController::class, 'postComment']);


Route::get('/login', [Auth::class, 'getLogin'])->name('login');
Route::post('/login', [Auth::class, 'postLogin']);

Route::post('/logout', [Auth::class, 'logout']);

Route::get('/forgot-password', [Auth::class, 'getForgotPassword']);
Route::post('/forgot-password', [Auth::class, 'postForgotPassword'])->name('password.email');

Route::get('/forgot-password/{token}', [Auth::class, 'getForgotPasswordWToken'])->name('password.reset');
Route::post('/forgot-password/{token}', [Auth::class, 'postForgotPasswordWToken'])->name('password.update');