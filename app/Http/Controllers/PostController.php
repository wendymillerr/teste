<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Página inicial: lista de posts com filtros
    public function index(Request $request)
    {
            $query = Post::query();

        // Filtro por título
        if (request('search')) {
            $query->where('title', 'LIKE', '%' . request('search') . '%');
        }

        if (request('tag')) {
            $query->whereJsonContains('tags', request('tag'));
        }

        // Filtro por data
        if (request('date')) {
            $query->whereDate('created_at', request('date'));
        }

        // Carregar posts com número de comentários
        $posts = $query->withCount('comments')->paginate(30);

        // Gerar lista de tags para o select
        $tags = Post::pluck('tags')
                    ->flatten()
                    ->unique()
                    ->sort()
                    ->values();

        return view('posts.index', compact('posts', 'tags'));
    }

    // Detalhes de um post
    public function show($id)
    {
        $post = Post::with('comments')->findOrFail($id);
        return view('posts.show', compact('post'));
    }
}
