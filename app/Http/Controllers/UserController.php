<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;

class UserController extends Controller
{
    // Perfil do usuário
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    // Posts de um usuário
    public function posts($id)
    {
        $posts = Post::where('user_id', $id)->withCount('comments')->paginate(30);
        return view('users.posts', compact('posts'));
    }
}
