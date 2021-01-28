@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('profile.update', $user->username) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="row">
                        <h1>Edit Profile</h1>
                    </div>
                    <div class="form-group row">
                        <label for="image" class="col-md-4 col-form-label text-md-right">Profile Pic</label>
                        <div class="col-md-8">
                            <div class="d-flex justify-content-start">
                                <label for="image" class="d-inline m-0" style="max-width: 100px;">
                                    <img src="{{ $user->profile->profileImage() }}" id="profile-pic" class="img-fluid rounded-circle"/>
                                </label>
                                <div>
                                    <input type="checkbox" class="btn-check invisible" name="reset-image" id="reset-image" autocomplete="off">
                                    <label for="reset-image" class="btn btn-outline-primary">Reset Profile Pic</label>
                                </div>
                            </div>
                            <input type="file" id="image" name="image" class="form-control-file col-form-label @error('image') is-invalid @enderror" value="{{ old('title') ?? $user->profile->image }}" title="{{ old('title') ?? $user->profile->image }}" autocomplete="image" autofocus>
                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>
                        <div class="col-md-8">
                            <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') ?? $user->profile->title }}" required autocomplete="title" autofocus>
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-md-4 col-form-label text-md-right">description</label>
                        <div class="col-md-8">
                            <input type="text" id="description" name="description" class="form-control @error('description') is-invalid @enderror" value="{{ old('description') ?? $user->profile->description }}" required autocomplete="description" autofocus>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="url" class="col-md-4 col-form-label text-md-right">url</label>
                        <div class="col-md-8">
                            <input type="text" id="url" name="url" class="form-control @error('url') is-invalid @enderror" value="{{ old('url') ?? $user->profile->url }}" autocomplete="url" autofocus>
                            @error('url')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-8 offset-md-4">
                            <button class="btn btn-primary" type="submit">Save Profile</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const reader = new FileReader();
            const preview = document.querySelector('#profile-pic');
            document.querySelector('#image').addEventListener('change', function(event) {
                let file = event.target.files[0];
                reader.onloadend = function() {
                    preview.src = reader.result;
                    preview.classList.remove('rounded-circle');
                }
                if (file) {
                    reader.readAsDataURL(file);
                }
            });

            document.querySelector('#reset-image').addEventListener('change', function(event) {
                if (event.target.checked) {
                    preview.src = '/storage/profile/no_image.png';
                    document.querySelector('#image').value = null;
                }
            });
        });
    </script>
@endpush
