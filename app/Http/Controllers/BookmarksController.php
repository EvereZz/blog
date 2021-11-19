<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class BookmarksController extends Controller
{
    public function show(User $user)
    {   
        return view('account.bookmarks', [
            'user' => $user
        ]);
    }
    
    public function store(Post $post, Request $request)
    {
        $post->bookmarks()->create([
            'user_id' => $request->user()->id
        ]);
        
        return back();
    }
    
    public function destroy(Post $post) 
    {
        $bookmark = auth()->user()->bookmarks->where('post_id', $post->id)->first();
        
        $bookmark->delete();
        
        return back()->with('success' , 'Bookmark deleted.');
    }
}
