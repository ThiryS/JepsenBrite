@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                  @auth
                      <a href="{{ route('events.new') }}">Créer un événement</a>
                  @endauth
                  @foreach ($events as $event)
                    <p>
                      This is event <a href="{{ route('events.show', $event->id) }}">{{ $event->name }}</a>
                       user: {{ $event->user->name}} Quand ? {{ $event->date }}
                    </p>
                  @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
