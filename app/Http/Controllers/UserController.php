<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;

class UserController extends Controller
{
    // Perfil do usuário
    public function show($id)
    {
        $user = User::withCount('posts')->findOrFail($id);

        // busca posts do usuário com contagem de comentários
        $posts = Post::where('user_id', $id)
            ->withCount('comments')
            ->paginate(10);

        return view('users.show', compact('user', 'posts'));
    }

    // posts de um usuário
    public function posts($id)
    {
        
        $user = User::withCount('posts')->findOrFail($id);

        $posts = Post::where('user_id', $id)
            ->withCount('comments')
            ->paginate(30);

        return view('users.posts', compact('user', 'posts'));
    }
}
