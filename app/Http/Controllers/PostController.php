<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;

class PostController extends Controller
{
    // Página inicial: lista de posts
    public function index()
    {
        $posts = Post::withCount('comments')->paginate(30);
        //dd($posts); // <-- isso vai mostrar os dados retornados
        return view('posts.index', compact('posts'));
    }


    
    // Detalhes de um post
    public function show($id)
    {
        $post = Post::with('comments')->findOrFail($id);
        return view('posts.show', compact('post'));
    }
}