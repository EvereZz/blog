<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class PostView extends Model
{
    use HasFactory;
    
    public function postView()
    {
        return $this->belongsTo(Post::class);
    }

    public static function createViewLog($post)
    {
        $postViews= new PostView();
        $postViews->post_id = $post->id;
        $postViews->slug = $post->slug;
        $postViews->url = request()->url();
        $postViews->user_id = (auth()->check()) ? auth()->id() : null; 
        $postViews->ip = request()->ip();
        $postViews->agent = request()->header('User-Agent');
        $postViews->save();
    }
}
