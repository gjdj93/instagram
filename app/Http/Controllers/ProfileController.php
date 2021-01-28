<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function show(User $user) {
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;
        return view('profile.show', compact('user', 'follows'));
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
