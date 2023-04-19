<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class WallController extends Controller
{

    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect()->back();
    }
    public function show(Request $request)
    {
        // Récupérer l'utilisateur connecté
        $user = auth()->user();

        // Récupérer les posts de l'utilisateur connecté
        $posts = Post::where('user_id', $user->id)->latest()->get();

        return view('wall', ['post' => $posts], ['user' => $user]);
    }
}
