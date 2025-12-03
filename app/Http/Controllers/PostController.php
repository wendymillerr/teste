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

       
        if (request('search')) {
            $query->where('title', 'LIKE', '%' . request('search') . '%');
        }

        if (request('tag')) {
            $query->whereJsonContains('tags', request('tag'));
        }

      
        if (request('date')) {
            $query->whereDate('created_at', request('date'));
        }

        
        $posts = $query->withCount('comments')->paginate(30);

        
        $tags = Post::pluck('tags')
            ->map(function ($t) {
                if (is_array($t)) {
                    return $t;
                }

                if (is_string($t)) {
                    return ;
                }

                return [];
            })
            ->flatten()
            ->unique()
            ->sort()
            ->values();


        return view('posts.index', compact('posts', 'tags'));
    }

    // detalhes de um post
    public function show($id)
    {
        $post = Post::with('comments')->findOrFail($id);
        return view('posts.show', compact('post'));
    }
}