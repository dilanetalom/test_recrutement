<?php

namespace App\Http\Controllers;

use App\Models\Beat;
use Illuminate\Http\Request;

class BeatController extends Controller
{
        // creer un beat
        public function store(Request $request){
            $post = new Beat();
            $post->slug = $request->slug;
            $post->title = $request->title;
            $post->premuim_file = $request->premuim_file;
            $post->free_file = $request->free_file;
            $post->save();
        }
}
