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
Route::get('/user/{id}/posts', [UserController::class, 'posts'])->name('users.posts');

// (Opcional) página /posts
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
