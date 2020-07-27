@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/profile/{{ $user->id }}" method="POST">
    @csrf
    @method('PATCH')

    <div class="row">
        <div class="col-8 offset-2">

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $user->name}}" autocomplete="name" autofocus>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="image" class="col-md-4 col-form-label text-md-right">Profile image</label>

                <div class="col-md-6">
                    <input id="form-control-file" type="file" name="image" id="image">
                </div>

                @if($errors->has('image'))
                {{ $errors->first('image') }}
                @endif
            </div>

            <div class="form-group row mb-0">
                 <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        Save profile
                    </button>
                </div>
            </div>
        </div>
    <d/div>

</div>
@endsection
