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

                <a name="options" id="futureEvents" class="btn btn-primary" href="{{ route('admin.users.show')}}">
                    utilisateurs </a>

            </div>

            <div>
                <p>
                <h4><a href="{{ route('events.show', $event->id) }}">{{ $event->name }}</a></h4> 
                </p> 
            </div>

        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <tr class="thead-light">
                    <th scope="col">Auteur</th>
                    <th scope="col">Commentaire</th>
                    <th scope="col">Date</th>
                    <th scope="col">Actions</th>
                </tr>
                @foreach ($comments -> sortBy('created_at') as $comment)
                <tr>
                    <td><a href="../../../profile/{{ $comment->user_id }}">{{ $comment -> user ->name}}</a></td>
                    <td>{{ $comment-> comment}}</td>
                    <td>{{ $comment-> created_at}}</td>
                    <td>
                        <a href="{{ route('admin.comment.edit', [$comment-> event_id, $comment->id]) }}" class="pr-4">Modifier</a>
                        <form action="{{ route('admin.comment.destroy', [$comment-> event_id, $comment->id])}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Supprimer</button>
                        </form>
                    </td>
                </tr>    
                @endforeach

            </table>
            {{ $comments->links() }}
        </div>
    </div>
</div>

@endsection
