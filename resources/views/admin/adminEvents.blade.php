@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row pb-5">
        <h1>Panneau d'administration</h1>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-baseline pt-4">


            <div>

                <a name="options" id="ownEvents" class="btn btn-primary" href="{{ route('admin.event.show') }}">
                    Evenements</a>

                <a name="options" id="futureEvents" class="btn btn-primary" href="{{ route('admin.users.show')}}"> utilisateurs </a>

            </div>
            
            <a class="btn btn-primary" href="{{ route('events.create') }}">Créer un nouvel événement</a>


        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <tr class="thead-light">
                    <th scope="col">Nom</th>
                    <th scope="col">Créateur</th>
                    <th scope="col">Date</th>
                    <th scope="col">Categorie</th>
                    <th scope="col">Actions</th>
                </tr>
                @foreach ($events->sortBy('date') as $event)
                <tr>
                    <td><a href="{{ route('admin.comments.show', $event->id) }}">{{ $event->name }}</a></td>
                    <td><a href="../profile/{{ $event->user->id }}">{{ $event->user->name}}</a></td>
                    <td>{{ date('d-m-Y', strtotime($event->date)) }}</td>
                    <td>{{ $event->category->name }}</td>
                    <td>
                        <a href="{{ route('admin.event.edit', $event->id) }}" class="pr-4">Modifier</a>
                        <form action="{{ route('admin.events.destroy', $event->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Supprimer</button>
                        </form>
                    </td>
                </tr>    
                @endforeach
            </table>
            {{ $events->links() }}
        </div>
    </div>
</div>

@endsection