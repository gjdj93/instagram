@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <img class="img-fluid" src="/storage/{{$post->image}}" alt="">
            </div>
            <div class="col-md-4">
                <div class="d-flex align-items-center">
                    <div style="max-width: 40px;" class="mr-3">
                        <img src="{{ $user->profile->profileImage() }}" class="rounded-circle img-fluid">
                    </div>
                    <h5 class="d-inline-block my-0 font-weight-bold"><a class="text-dark" href="{{ route('profile.show', $post->user->username) }}">{{ $post->user->username }}</a></h5>
                    @cannot('update', $post->user->profile)
                        <span class="px-3">&bull;</span>
                        <a href="#">Follow</a>
                    @endcannot
                </div>
                <hr>
                <p><span class="font-weight-bold mr-2"><a class="text-dark" href="{{ route('profile.show', $post->user->username) }}">{{ $post->user->username }}</a></span>{{ $post->caption }}</p>
            </div>
        </div>

    </div>
@endsection
