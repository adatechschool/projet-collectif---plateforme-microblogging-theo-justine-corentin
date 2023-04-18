<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\Likes;
use App\Models\Subscription;
use Illuminate\Support\Collection;
use Livewire\Component;

class PostListing extends Component
{
    public $posts;
    protected $listeners = ['removePostRequested' => 'removePost'];
    public $pageNumber = 1;
    public $hasMorePages;
    public $subscriptions;

    public function addSub($userId) {
        $sub = new Subscription([
            'followed_id' => $userId,
            'following_id' => auth()->user()->id,
        ]);

        $sub->save();

        // Ajouter le nouvel abonnement à la collection d'abonnements
        $this->subscriptions->push($sub);

        // Émettre un événement pour recharger la page (si nécessaire)
        $this->emit('subscriptionAdded');
    }
    public function deleteSub($subscriptionId)
    {
        // Trouver et supprimer l'abonnement
        $subscription = Subscription::find($subscriptionId);
        $subscription->delete();

        // Mettez à jour cette partie en fonction de votre implémentation
        $this->subscriptions = $this->subscriptions->filter(function ($subscription) use ($subscriptionId) {
            return $subscription['id'] != $subscriptionId;
        });
    }
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

        $this->subscriptions = Subscription::where('following_id', auth()->user()->id)->get();
        $this->loadPosts();
    }

    public function loadPosts()
    {
        $posts = Post::with('user')->orderBy('created_at', 'desc')->paginate(12, ['*'], 'page', $this->pageNumber);

        $this->pageNumber += 1;

        $this->hasMorePages = $posts->hasMorePages();

        $this->posts->push(...$posts->items());
    }
    public function render()
    {
        return view('explore')->layout('layouts.explore');
    }
}