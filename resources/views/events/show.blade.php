@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row"> 
        <div class="card" style="width: 18rem;">
            {{ $event->image }}
            <div class="card-body">
                <h5 class="card-title">{{ $event->name }}</h5>
                <p class="card-text">{{ $event->description }}</p>
                <p class="card-text">{{ $event->category }}</p>
                <a href="#" class="btn btn-primary">Modify</a>
            </div>
        </div>
    </div>
</div>
@endsection

