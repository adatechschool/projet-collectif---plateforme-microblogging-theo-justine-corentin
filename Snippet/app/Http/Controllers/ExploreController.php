<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class ExploreController extends Controller
{
    public function show(Request $request)
    {

        $postsPerPage = 100; // Nombre de posts par page, vous pouvez ajuster cette valeur
        $post = Post::paginate($postsPerPage);
        return view('explore', ['post' => $post]);
    }
}
