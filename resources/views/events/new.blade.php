@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Créer un événement') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('events.create') }}" enctype="multipart/form-data" >
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nom') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="image" id="image" class="col-md-4 col-form-label text-md-right">Post Image</label>
                            
                                <input type="text" 
                                        name="image" 
                                        class="form-control{{ $errors->has('image') ? 'is-invalid' : '' }}"
                                        id="image" 
                                        value="form-control{{ old('image') }}"
                                        autocomplete="image" autofocus>
                        </div>

                        </div>
                            <div class="row">
                                <label for="image" id="image" class="col-md-4 col-form-label text-md-right">Post Image</label>
                                <input type="file" class="form-controle-file" id='image' name='image'>

                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" required>{{ old('description') }}</textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Date') }}</label>

                            <div class="col-md-6">
                                <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date') }}">

                                @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email"  class="col-md-4 col-form-label text-md-right">{{ __('Category') }}</label>

                                <div class="col-md-6" >
                                    <select name="category" id="category"type="string" class="form-control @error('category') is-invalid @enderror" name="category" value="{{ old('category') }}">
                                    <option value="Show">Show</option>
                                    <option value="Salon">Salon</option>
                                    <option value="Concert">Concert</option>
                                    <option value="Cours">Cours</option>
                                    <option value="Conference">Conference</option>
                                </select>
                                @error('category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Créer') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
