@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $event->name }} @if ($event->user->id === Auth::user()->id) <a href="{{ route('events.edit', $event->id) }}">Modifier</a>
                  <form action="{{ route('events.destroy', $event->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Supprimer</button>
                  </form>
                @endif
              </div>

                <div class="card-body">
                  {{ $event->description }}
                  {{ $event->category }}
                </div>
            </div>
            @foreach ($event->comments as $comment)
            <p>
              Commentaire: {{$comment->comment}} de: {{ $comment->user->name}} posté: {{$comment->updated_at}}
            </p>
            @endforeach
            @auth
            <form method="POST" action="{{ route('comments.create', $event->id) }}">
                @csrf

                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Commentaire') }}</label>

                    <div class="col-md-6">
                        <textarea id="comment" class="form-control @error('comment') is-invalid @enderror" name="comment" required>{{ old('comment') }}</textarea>

                        @error('comment')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Commenter') }}
                        </button>
                    </div>
                </div>
            </form>
            @endauth
        </div>
    </div>
</div>
@endsection
