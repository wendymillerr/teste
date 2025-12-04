<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request; 

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

   public function posts($id, Request $request)
{
    $user = User::findOrFail($id);

    $query = Post::where('user_id', $id)->withCount('comments');

    // Reaproveita filtros do model
    $query = Post::applyFilters($query, $request);

    $posts = $query->paginate(30);

    // Extrair tags só desse usuário
    $tags = Post::extractTags(Post::where('user_id', $id));

    return view('users.posts', compact('user', 'posts', 'tags'));
}

}
