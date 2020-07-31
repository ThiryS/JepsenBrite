@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('profile.update', $user->id) }}" enctype="multipart/form-data" method="POST">
    @csrf
    @method('PUT')

        <div class="row">
            <div class="col-8 offset-2 pt-3">

                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nom d'utilsateur') }}</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $user->profile->name}}" autocomplete="name" autofocus>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="image" class="col-md-4 col-form-label text-md-right">Image de profil</label>

                    <div class="col-md-6">
                        <input id="form-control-file" type="file" name="image" value="{{ old('image') ?? $user->profile->image }}">
                    </div>

                    @if($errors->has('image'))
                        {{ $errors->first('image') }}
                    @endif

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Valider') }}
                        </button>
                        <a href="{{ route('profile.update', $user->id) }}" class="pl-4">Retour</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <form action="{{ route('profile.destroy', $user->id)}}" method="post">
             @csrf
            @method('DELETE')
            <div class="col-md-6 offset-md-7 pt-2">
                <button class="btn btn-danger" type="submit">Supprimer le profil</button>
            </div>
    </form>


</div>
@endsection
