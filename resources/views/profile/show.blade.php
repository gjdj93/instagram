@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row py-4">
        <div class="col-md-3 p-5">
            <img src="{{ $user->profile->profileImage() }}" alt="" class="img-fluid rounded-circle">
        </div>
        <div class="col-md-9 pt-5">
            <div class="d-flex flex-column d-sm-flex flex-sm-row align-items-sm-center justify-content-sm-between justify-content-md-start">
                <h2 class="m-0">{{ $user->username }}</h2>
                <div class="d-flex mx-n2 pl-md-5 flex-wrap">
                    @can('update', $user->profile)
                        <div class="px-2"><a href="{{ route('posts.create', $user->username) }}" class="btn btn-primary">Add New Post</a></div>
                        <div class="px-2"><a href="{{ route('profile.edit', $user->username) }}" class="btn btn-outline-primary">Edit Profile</a></div>
                    @else
                        <follow-button user-id="{{ $user->id }}" follows="{{ $follows }}"></follow-button>
                    @endcan
                </div>
            </div>
            <div class="d-flex flex-column d-sm-flex flex-sm-row my-4">
                <div class="mr-5"><strong>{{ $user->posts->count() }}</strong> posts</div>
                <div class="mr-5"><strong>{{ $user->profile->followers->count() }}</strong> followers</div>
                <div><strong>{{ $user->following->count() }}</strong> following</div>
            </div>
            <div class="mt-4 font-weight-bold">
                <span>{{ $user->profile->title }}</span>
            </div>
            <p>{{ $user->profile->description }}</p>
            <p><a href="{{ $user->profile->url }}" target="_blank">{{ $user->profile->url }}</a></p>
        </div>
    </div>
    <div class="row">
        @foreach ($user->posts as $post)
            <div class="col-4 py-3">
                <div>
                    <a href="{{$user->username}}/posts/{{ $post->id }}">
                        <img class="img-fluid" src="/storage/{{ $post->image }}" alt="{{ $post->caption }}"/>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
