<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\Likes;
use App\Models\User;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Livewire\Component;

class WallUsers extends Component
{

    public $user;
    public $posts;
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

    public function deleteSub($userId, $subscriptionId)
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
    
        $this->subscriptions = Subscription::where('following_id', auth()->user()->id)->get();
        $this->user = $user;
        $this->posts = $posts;
    }
    public function render()
    {
        return view('wallUsers');
    }    
}
