<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Post;

class PostPublished extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    
    
    protected $post;
    protected $name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Post $post, $name)
    {
        $this->post = $post;
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.posts.published', [
            'url' => 'http://127.0.0.1:8000/posts/' . $this->post->slug,
            'name' => $this->name,
            'author' => $this->post->author->name,
        ]);
    }
}
