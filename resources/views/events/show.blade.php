@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-baseline">
                    <h4>{{ $event->name }}</h4>
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
                    <a href="{{ route('participate.show', $event->id) }}">{{ $event->participates_count }}
                    </a>participant(s)
                    @if ($event->video == NULL)
                  <img src="{{ $event->image }}" style="height: 300px; width: 100%; object-fit: cover;" class="pb-3">
                    @else
                <iframe src="{{ $event->video }}" width="100%" height="300" frameborder="0" allowfullscreen></iframe>
                @endif
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
                    <p><strong>Categorie:</strong> {{ $event->category->name }}</p>
                    <p><strong>Sous categorie(s):</strong>
                        @foreach ($event->eventsubcats as $subcat)
                        {{  $subcat->subcategory->name  }}
                        @endforeach
                    </p>
                    <p>
                        <strong>Adresse:</strong> {{ $event-> address }}
                    </p>
                    <div style="width: 100%">
                        <iframe scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=400&amp;hl=en&amp;q={{ $event->address }}&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed" width="100%" height="600" frameborder="0"></iframe>
                    </div>
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
                        <p class="text-muted text-right">de: <a
                                href="../profile/{{ $comment->user->id }}">{{ $comment->user->name}}</a> posté:
                            {{$comment->updated_at}}
                        </p>
                        
                        @if($event->user == Auth::user())
                        <p>
                            <a href="{{ route('comment.edit', [$comment-> event_id, $comment->id]) }}"
                                class="pr-4">Modifier</a>
                            <form action="{{ route('comment.destroy', [$comment-> event_id, $comment->id])}}"
                                method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Supprimer</button>
                            </form>
                        </p>
                        @endif
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
                            <textarea id="comment" class="form-control @error('comment') is-invalid @enderror"
                                name="comment" required>{{ old('comment') }}</textarea>

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
    $(document).ready(function () {
        $("#comment").emojioneArea();
    });

</script>
@endsection
