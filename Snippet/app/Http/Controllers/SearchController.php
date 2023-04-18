<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        // Récupérer la requête de recherche à partir de l'input "query"
        $query = $request->input('query');

        // Recherche de l'utilisateur correspondant à la requête
        $user = User::where('name', 'LIKE', '%' . $query . '%')->first();

        // Si l'utilisateur est trouvé, redirigez vers le mur de la personne (/wall/{id})
        if ($user) {
            return redirect('/wall/' . $user->id);
        } else {
            // Si l'utilisateur n'est pas trouvé, redirigez vers une page d'erreur ou la page précédente avec un message d'erreur
            return redirect()->back()->withErrors(['user_not_found' => 'User not found.']);
        }
    }
}

