<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use App\Models\Category;
use App\Models\User;
use App\Models\Post;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Mail\PostPublished;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller {

    public function index()
    {
        return view('admin.posts.index', [
            "posts" => Post::paginate(50)
        ]);
    }
    
    public function create() 
    {
        return view("admin.posts.create", [
            'categories' => Category::All()
        ]);
    }

    public function store()
    {   
        $attributes = array_merge($this->validatePost(), [
            'user_id' => auth()->id(),
            'thumbnail' => request()->file('thumbnail')->store('thumbnails')
        ]);
        
        $attributes['published'] == 'Yes' ? $attributes['published'] = 1 : $attributes['published'] = 0;

        $post = Post::create($attributes);
        
        $followers = auth()->user()->followers;
        
        if (! $followers->count() == 0) {
            foreach ($followers->all() as $recipient) {
                Mail::to($recipient->user->email)->send(new PostPublished($post, $recipient->user->name));
            }
        }

        $subscribers = Subscriber::all()->all();

        $arrSubs = array();

        $arrFoll = array();

        if ($subscribers) {
            foreach ($subscribers as $subs) {
                array_push($arrSubs, $subs->email);
            }
        }

        if (!$followers->count() == 0) {
            foreach ($followers->all() as $subs) {
                array_push($arrFoll, $subs->user->email);
            }
        }

        $result = array_diff($arrSubs, $arrFoll);

        if ($result) {
            foreach ($result as $recipient) {
                Mail::to($recipient)->send(new PostPublished($post, 'Subscriber!'));
            }
        }

        return redirect('/')->with('success', 'New post created.');
    }
    
    public function edit(Post $post) 
    {
        return view('admin.posts.edit', [
            'post' => $post,
            'categories' => Category::All(),
            'authors' => User::All()
        ]);    
    }
    
    public function update(Post $post)
    {
        $attributes = $this->validatePost($post);
        
        if ($attributes['thumbnail'] ?? false) {
            $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
        }
        
        $attributes['published'] == 'Yes' ? $attributes['published'] = 1 : $attributes['published'] = 0;
        
        $post->update($attributes);
        
        return back()->with('success', "Post Updated!");
    }
    
    public function destroy(Post $post)
    {
        $post->delete();
         
        return back()->with('success', "Post Deleted!");
    }
    
    protected function validatePost(?Post $post = null) 
    {
        $post ??= new Post();
                
        return request()->validate([
            'title' => 'required',
            'thumbnail' => $post->exists ? ['image'] : ['required', 'image'],
            'slug' => ['required', Rule::unique('posts', 'slug')->ignore($post)],
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')],
            'user_id' => $post->exists ? ['required', Rule::exists('users', 'id')] : '',
            'published' => 'required'
        ]);
    }
}
 