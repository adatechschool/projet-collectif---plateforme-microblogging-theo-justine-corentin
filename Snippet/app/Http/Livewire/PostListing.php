<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\Likes;
use Illuminate\Support\Collection;
use Livewire\Component;

class PostListing extends Component
{
    public $posts;
    protected $listeners = ['removePostRequested' => 'removePost'];
    public $pageNumber = 1;

    public $hasMorePages;
    public function removePost($postId)
    {
        $post = Post::find($postId);
        $post->delete();

        $this->posts = $this->posts->filter(function ($post) use ($postId) {
            return $post['id'] != $postId;
        });
    }
    public function addLike($postId)
    {
        $like = new Likes([
            'post_id' => $postId,
            'user_id' => auth()->user()->id,
        ]);

        $like->save();

        // Recharger les posts
        $this->posts = $this->posts->map(function ($post) use ($postId, $like) {
            if ($post['id'] == $postId) {
                $post['likes'][] = $like;
            }
            return $post;
        });
    }

    public function removeLike($postId, $likeId)
    {
        $like = Likes::find($likeId);
        $like->delete();

        // Recharger les posts
        $this->posts = $this->posts->map(function ($post) use ($postId, $likeId) {
            if ($post['id'] == $postId) {
                $post['likes'] = array_filter($post['likes'], function ($like) use ($likeId) {
                    return $like['id'] != $likeId;
                });
            }
            return $post;
        });
    }
    public function mount()
    {
        $this->posts = new Collection();

        $this->loadPosts();
    }

    public function loadPosts()
    {
        $userId = auth()->user()->id;
        
        $posts = Post::with(['user', 'likes'])
        ->orderBy('created_at', 'desc')
        ->paginate(12, ['*'], 'page', $this->pageNumber);

        $this->pageNumber += 1;

        $this->hasMorePages = $posts->hasMorePages();

        $this->posts->push(...$posts->items());
    }
    public function render()
    {
        return view('explore')->layout('layouts.explore');
    }
}