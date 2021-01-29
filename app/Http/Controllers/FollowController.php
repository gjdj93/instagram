<?php

namespace App\Http\Controllers;

use App\Mail\NewFollowerMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FollowController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function store($id) {
        $user = User::find($id);

        $auth_user = auth()->user();

        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;
        if (!$follows) {
            Mail::to($user->email)->send(new NewFollowerMail($user, $auth_user));
        }
        return auth()->user()->following()->toggle($user->profile);
    }
}
