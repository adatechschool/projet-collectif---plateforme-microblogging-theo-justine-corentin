<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class ExploreController extends Controller
{

    public function show(Request $request)
    {
        $post = Post::all();
        return view('explore', ['post' => $post]);
    }
}
