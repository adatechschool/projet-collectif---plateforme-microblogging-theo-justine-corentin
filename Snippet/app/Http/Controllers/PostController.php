<?php

namespace App\Http\Controllers;
use App\Models\Post;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show', ['post' => $post]);
    }
    public function update(Request $request)
    {
        $routeName = $request->input('page');
        // Valider les données du formulaire
        $request->validate([
            'text' => 'required|max:255',
            'img_url' => 'required|url'
        ]);

        // Gestion d'erreur si l'user na pas ecri de texte ou de photo
        if (empty($request->input('text')) || empty($request->input('img_url'))) {
            return redirect()->route($routeName)->with('error', 'Ecrire un texte ou ajouter une photo');
        }

        // Créer un nouveau post avec les données validées
        $post = new Post([
            'description' => $request->input('text'),
            'img_url' => $request->input('img_url'),
            'user_id' => auth()->user()->id,
        ]);

        // Enregistrer le post dans la base de données
        $post->save();

        return redirect()->to($routeName)->with('success', 'Post créé avec succès');
    }
}
