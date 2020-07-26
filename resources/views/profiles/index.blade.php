@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row pb-5">
        <div class="col-3 pt-4">
            <img src="/storage/{{ $user->profile->image }}" class="rounded-circle w-100">
        </div>
        <div class="col-9 pt-4 pb-3">
            <div class="d-flex justify-content-between align-items-baseline">
                <h1>{{ $user->name }}</h1>
                @auth
                    <a href="/profile/{{ $user->id }}/edit">Modify profile</a>
                @endauth
            </div>
            <div class="d-flex justify-content-between align-items-baseline">
                <p>{{ $user->events->count() }} events</p>
                <a href="#">Create new event</a>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">Events created</div>
            <div class="card-body">
                @foreach($user->events as $event)
                    <div class="col-4 p-3">image</div>
                    <div class="col-7">
                        <h3>{{ $event->name }}</h3>
                        <p>{{ $event->date }}</p>
                        <p>{{ $event->description }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
