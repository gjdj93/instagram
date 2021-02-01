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
                        <follow-button user-id="{{ $user->id }}" follows="{{ $follows }}"></follow-button>
                    @endcannot
                </div>
                <hr>
                <p><span class="font-weight-bold mr-2"><a class="text-dark" href="{{ route('profile.show', $post->user->username) }}">{{ $post->user->username }}</a></span>{{ $post->caption }}</p>
                <hr>
                <div class="d-flex mx-n1">
                    <div class="like-button px-1">
                        <like-button post-id="{{ $post->id }}" liked="{{ $post->likedBy(auth()->user()) }}"></like-button>
                    </div>
                    <div class="comment-button px-1">
                        <i class="far fa-comment fa-lg"></i>
                    </div>
                    <div class="share-button px-1">
                        <i class="far fa-share-square fa-lg"></i>
                    </div>
                </div>
                <div class="likes font-weight-bold">{{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count()) }}</div>
                <div><small class="text-muted text-uppercase">{{ $post->created_at->diffForHumans() }}</small></div>
            </div>
        </div>

    </div>
@endsection
