@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Tous des événemets') }}</div>

                <div class="card-body">
                  @auth
                      <a style="margin-bottom: 20px" class="btn btn-primary" href="{{ route('events.new') }}">Créer un événement</a>
                  @endauth
                  <table class="table table-bordered">
                    <tr class="thead-light">
                      <th scope="col">Nom</th>
                      <th scope="col">Date</th>
                      <th scope="col">Categorie</th>
                      <th scope="col">Createur</th>
                    </tr>
                    @foreach ($events->sortBy('date') as $event)
                    <tr>
                      <td><a href="{{ route('events.show', $event->id) }}">{{ $event->name }}</a></td>
                      <td>{{ date('d-m-Y', strtotime($event->date)) }}</td>
                      <td>{{ $event->category }}</td>
                      <td>{{ $event->user->name}}</td>
                    </tr>
                    @endforeach
                  </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
