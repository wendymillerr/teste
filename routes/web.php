<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

// Página inicial
Route::get('/', [PostController::class, 'index'])->name('home');

// Detalhes do post
Route::get('/post/{id}', [PostController::class, 'show'])->name('post.show');

// Perfil do usuário
Route::get('/user/{id}', [UserController::class, 'show'])->name('user.show');

// Posts do usuário
//Route::get('/user/{id}/posts', [UserController::class, 'posts'])->name('user.posts');

Route::get('/user/{id}', [UserController::class, 'show'])->name('users.profile');

Route::get('/user/{id}/likes', [UserController::class, 'likes'])->name('users.likes');
