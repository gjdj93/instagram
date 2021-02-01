<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostLikeController extends Controller
{

    public function showUsersLikes(User $user) {
        return User::where(['id' => $user->id])->with('likes')->get()->pluck('likes');
    }

    public function showPostLikes(Post $post) {
        return Post::where(['id' => $post->id])->with('likes')->get()->pluck('likes');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Post $post, Request $request)
    {
        if ($post->likedBy($request->user())) {
            $request->user()->likes()->where('post_id', $post->id)->delete();
            return false;
        } else {
            $post->likes()->create(['user_id' => $request->user()->id]);
            return true;
        }
    }
}
