<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\Likes;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Livewire\Component;

class WallUsers extends Component
{

    public $user;
    public $posts;
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
                $post['likes'] = array_filter($post['likes']->toArray(), function ($like) use ($likeId) {
                    return $like['id'] != $likeId;
                });
            }
            return $post;
        });        
    }
    public function mount(Request $request)
    {
        $id = $request->route('id');
        $user = User::find($id);
        $posts = Post::where('user_id', $id)->orderBy('created_at', 'desc')->get();
    
        $this->user = $user;
        $this->posts = $posts;
    }
    public function render()
    {
        return view('wallUsers');
    }    
}
