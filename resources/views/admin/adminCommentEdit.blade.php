@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row pb-5">
        <h1>Panneau d'administration</h1>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Modifier un événement') }}</div>

                <div class="card-body">
                    <form method="post" enctype="multipart/form-data" action="{{ route('admin.comment.update', [$event->id, $comment-> id]) }}">
                        @csrf
                        @method('PUT')
                        

                        <div class="form-group row">
                            <label for="comment" class="col-md-4 col-form-label text-md-right">{{ __('Comment') }}</label>

                            <div class="col-md-6">
                                <textarea id="comment" class="form-control @error('description') is-invalid @enderror" name="comment" required>{{ $comment -> comment }}</textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Valider') }}
                                </button>
                                <a href="{{ route('admin.comments.show', $event-> id) }}">Retour</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection