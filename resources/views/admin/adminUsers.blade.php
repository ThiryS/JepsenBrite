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
            


        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <tr class="thead-light">
                    <th scope="col">Nom</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Type d'utilisateur</th>
                    <th scope="col">Actions</th>
                </tr>
                @foreach ($users -> sortBy('name') as $user)
                <tr>
                    <td><a href="../profile/{{ $user->id }}">{{ $user->name}}</a></td>
                    <td>{{ $user-> email}}</td>
                    <td>{{ $user-> type}}</td>
                    <td>
                        <a href="{{ route('admin.user.edit', $user->id) }}" class="pr-4">Modifier</a>
                        <form action="{{ route('admin.users.destroy', $user->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Supprimer</button>
                        </form>
                    </td>
                </tr>    
                @endforeach
            </table>
            {{ $users->links() }}
        </div>
    </div>
</div>

@endsection