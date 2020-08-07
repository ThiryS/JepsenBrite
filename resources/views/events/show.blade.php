@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-baseline"><h4>{{ $event->name }}</h4>
                @if($event->user == Auth::user())
                  <div class="d-flex justify-content-between align-items-baseline">
                    <a href="{{ route('events.edit', $event->id) }}" class="pr-4">Modifier</a>
                    <form action="{{ route('events.destroy', $event->id)}}" method="post">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-danger" type="submit">Supprimer</button>
                    </form>
                  </div>
                @endif
              </div>

                <div class="card-body">
                <a href="{{ route('participate.show', $event->id) }}">{{ $event->participates_count }} </a>participants
                  <img src=".{{ $event->image }}" style="height: 300px; width: 100%; object-fit: cover;" class="pb-3">
                  @auth
                  <form action="{{ route('participate.create', $event->id)}}" method="post">
                      @csrf
                      @method('POST')
                      <button class="btn btn-primary" type="submit">Participer</button>
                  </form>
                  <form action="{{ route('participate.destroy', $event->id)}}" method="post">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-danger" type="submit">Ne plus participer</button>
                  </form>
                  @endauth
                  <p><strong>Date:</strong> {{ date('d-m-Y', strtotime($event->date)) }}</p>
                  <p>
                  <strong>Description:</strong> @parsedown($event->description)
                  </p>
                  <strong>Categorie:</strong> {{ $event->category->name }}
                </div>

                <div class="card-footer text-muted text-right">
                  Evénement créé par <a href="../profile/{{ $event->user->id }}">{{ $event->user->name }}</a>
                </div>

            </div>

            <div class="pt-5">
            <h6>Commentaires:</h6>
            @foreach ($event->comments as $comment)
            <ul class="list-group list-group-flush">
              <li class="list-group-item">
                <p>{{$comment->comment}}</p>
                <p class="text-muted text-right">de: <a href="../profile/{{ $comment->user->id }}">{{ $comment->user->name}}</a> posté: {{$comment->updated_at}}</p>
              </li>
            @endforeach
            </div>

            <div class="pt-4 pb-5">
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
</div>
<script type="text/javascript">
  $(document).ready(function() {
    $("#comment").emojioneArea();
  });
</script>
@endsection
