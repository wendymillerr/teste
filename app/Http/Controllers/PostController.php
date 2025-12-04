<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
   
   public function index(Request $request)
{
    $query = Post::query()->withCount('comments');

    
    $query = Post::applyFilters($query, $request);

    $posts = $query->paginate(30);

    
    $tags = Post::extractTags(Post::query());

    return view('posts.index', compact('posts', 'tags'));
}


    // detalhes de um post
    public function show($id)
    {
        $post = Post::with('comments')->findOrFail($id);
        return view('posts.show', compact('post'));
    }
}