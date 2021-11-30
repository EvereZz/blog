<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class RssFeedController extends Controller
{
    public function feed() 
    {
        $posts = Post::where('published', 1)->
        orderBy('created_at', 'desc')->
        limit(20)->get();
        return response()->view('rss.feed', compact('posts'))->header('Content-Type', 'application/xml');
    }
}
