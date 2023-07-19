<?php

namespace App\Http\Controllers;

use App\Models\Beat;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
        // like un post
        public function likePost($slug){
            $post = Post::whereSlug($slug)->likes();
        
            $like = new Like(); // une instance de like
            $like->user_id = Auth::user()->id; // user authentifier
            $like->likeable_id = $post->id;
            $like->likeable_type = "post";
            $like->save();
            

            return response()->json($like);
        }

        public function likeBeat($slug){
            $post = Beat::whereSlug($slug)->likes();
        
            $like = new Like();
            $like->user_id = Auth::user()->id; // user authentifier
            $like->likeable_id = $post->id;
            $like->likeable_type = "beat";
            $like->save();
            
            return response()->json($like);
        }
}
