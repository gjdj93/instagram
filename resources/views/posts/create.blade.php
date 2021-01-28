@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('posts.store', $user->username) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="row">
                        <h1>Add New Post</h1>
                    </div>
                    <div class="form-group row">
                        <label for="caption" class="col-md-4 col-form-label text-md-right">Caption</label>
                        <div class="col-md-8">
                            <input type="text" id="caption" name="caption" class="form-control @error('caption') is-invalid @enderror" value="{{ old('caption') }}" required autocomplete="caption" autofocus>
                            @error('caption')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="image" class="col-md-4 col-form-label text-md-right">Image</label>
                        <div class="col-md-8">
                            <input type="file" id="image" name="image" class="form-control-file col-form-label @error('image') is-invalid @enderror" value="{{ old('image') }}" required autocomplete="image" autofocus>
                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-8 offset-md-4">
                            <button class="btn btn-primary" type="submit">Add New Post</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
