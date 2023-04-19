<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\Likes;
use App\Models\Subscription;
use Illuminate\Support\Collection;
use Livewire\Component;

//PAGE QUI AFFICHE TOUT LES POSTS DES ABONNEMENTS DE LA PERSONNE CONNECTEE
class FeedListing extends Component
{
    public $posts;
    public $pageNumber = 1;

    public $hasMorePages;
    public $subscriptions;
    protected $listeners = ['loadMore'];

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

    public function loadMore()
    {
        $this->loadPosts();
    }

    public function loadPosts()
    {
        $subscriptions = Subscription::where('following_id', auth()->user()->id)->get();
        $followed = [];
        foreach ($subscriptions as $subscription) {
            $followed[] = $subscription->followed_id;
        }
        $posts = Post::whereIn('user_id', $followed)->orderBy('created_at', 'desc')->paginate(5, ['*'], 'page', $this->pageNumber);
        $this->hasMorePages = $posts->hasMorePages();
        $this->posts = $this->posts->merge($posts->items()); // Utilisez la méthode merge() pour fusionner les nouveaux posts
        $this->pageNumber += 1;
    }
    
    public function mount()
    {
        $this->posts = new Collection();
        $this->subscriptions = Subscription::where('following_id', auth()->user()->id)->get();

        $this->loadPosts();
    }

    public function render()
    {
        return view('feed')->layout('layouts.explore');
    }
}