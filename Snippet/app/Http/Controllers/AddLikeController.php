<?php

namespace App\Http\Controllers;
use App\Models\Likes;


use Illuminate\Http\Request;

class AddLikeController extends Controller
{
    public function show()
    {
    }
    public function create(Request $request)
    {
        $routeName = $request->input('page');

        // Créer un nouveau post avec les données validées
        $post = new Likes([
            'post_id' => $request->input('id_post'),
            'user_id' => auth()->user()->id,
        ]);

        // Enregistrer le post dans la base de données
        $post->save();

        return redirect()->to($routeName)->with('success', 'Like succès');
    }
}
