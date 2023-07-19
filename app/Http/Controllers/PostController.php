<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // creer un post
    public function store(Request $request){

        $post = new Post();
        $post->slug = $request->slug;
        $post->content = $request->content;
        $post->save();
    }
}
