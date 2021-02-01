@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-6 offset-3">
            @foreach ($posts as $post)
                <div class="card mb-5">
                    <div class="card-header bg-white d-flex align-items-center px-4">
                        <div class="d-flex align-items-center">
                            <div style="max-width: 40px;" class="mr-3">
                                <img src="{{ $post->user->profile->profileImage() }}" class="rounded-circle img-fluid">
                            </div>
                            <h5 class="d-inline-block my-0 font-weight-bold"><a class="text-dark" href="{{ route('profile.show', $post->user->username) }}">{{ $post->user->username }}</a></h5>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="">
                            <a href="/posts/{{ $post->id }}">
                                <img class="img-fluid" src="/storage/{{$post->image}}" alt="">
                            </a>
                        </div>
                        <div class="py-3 px-4">
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
                            <div><small class="text-muted">{{ $post->created_at->diffForHumans() }}</small></div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
