<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostView;

class PostController extends Controller
{
    public function index() 
    {   
        return view('posts.index', [
            "posts" => Post::latest()->filter(
                request(['search', 'category', 'author'])
                )->paginate(6)->withQueryString()
        ]);
    }
    
    public function show(Post $post) 
    {   
        if (! $post->checkViews() ) {
            PostView::createViewLog($post);
            $post->increment('views');
        }
            
        return view("posts.show", [
            "post" => $post
        ]);
    }
}
