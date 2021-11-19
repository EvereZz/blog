<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use App\Models\Post;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

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

        Post::create($attributes);

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
 