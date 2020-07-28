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
                @can('update', $user->profile)
                    <a href="/profile/{{ $user->id }}/edit">Modify profile</a>
                @endcan
            </div>
            <p>{{ $user->events->count() }} events</p>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-baseline pt-4">
            <h4>Events created</h4>
            @can('update', $user->profile)
                <a href="#">Create new event</a>
            @endcan
        </div>
            <div class="card-body">
                @foreach($user->events as $event)
                    <div class="col-4 p-3">image</div>
                    <div class="col-7">
                        <h5>{{ $event->name }}</h5>
                        <p>{{ $event->date }}</p>
                        <p>{{ $event->description }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
