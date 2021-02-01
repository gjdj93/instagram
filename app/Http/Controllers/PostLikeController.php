<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostLikeController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Post $post, Request $request)
    {
        if ($post->likedBy(auth()->user())) {
            $post->likes()->delete(['user_id' => auth()->user()->id]);
            return false;
        } else {
            $post->likes()->create(['user_id' => auth()->user()->id]);
            return true;
        }
    }
}
