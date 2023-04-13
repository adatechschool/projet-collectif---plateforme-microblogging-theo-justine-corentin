<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostUpdateRequest;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;


class FeedController extends Controller
{
    public function index()
    {
        return view('feed')->with('status', 'nothing');
    }

    public function add(PostUpdateRequest $request) {
        $validatedData = $request->validated();
        $post = new Post();
        
        $post->description = $validatedData['description'];
        $post->url_photo = $validatedData['url_photo'];

        if($post->save()){
            return redirect()->route('feed')->with('status', 'updated');
        } else {
            return redirect()->route('feed')->with('status', 'error');
        }
    }
}
