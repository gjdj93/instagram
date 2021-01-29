<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function show(User $user) {
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;

        $postCount = Cache::remember(
            'count.posts.' . $user->id,
            now()->addSeconds(30),
            function() use ($user) {
                return $user->posts->count();
            }
        );
        $followersCount = Cache::remember(
            'followers.count' . $user->id,
            now()->addSeconds(30),
            function() use ($user) {
                return $user->profile->followers->count();
            }
        );
        $followingCount = Cache::remember(
            'following.count' . $user->id,
            now()->addSeconds(30),
            function() use ($user) {
                return $user->following->count();
            }
        );

        return view('profile.show', compact('user', 'follows', 'postCount', 'followersCount', 'followingCount'));
    }

    public function edit(User $user) {
        $this->authorize('update', $user->profile);
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request, User $user) {

        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'url|nullable',
            'image' => 'image|nullable',
        ]);

        if ($request['image']) {
            $imagePath = $request['image']->store('profile', 'public');

            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000,1000);
            $image->save();
            $imageArr = ['image' => $imagePath];
        }

        if ($request['reset-image']) {
            $validated['image'] = null;
        }

        auth()->user()->profile->update(array_merge($validated, $imageArr ?? []));

        return view('profile.show', compact('user'));
    }
}
