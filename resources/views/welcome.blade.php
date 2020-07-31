<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Jepsen Brite</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="icon" href="favicon.ico" />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Jepsen Brite
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/events') }}">Events</a>
                        </li>
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('profile.show', Auth::user()->id) }}" onclick="">
                                        {{ __('View profile') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @include('flash-messages')
            @yield('content')
        </main>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                  <img src="unnamed.jpg" alt="bannier">
                    <div class="card" style="margin-bottom: 50px;">
                        <div class="card-header">{{ __('Evenements à venir') }}</div>


                        <div class="card-body" >
                          <div class="row">
                            @foreach ($events as $event)

                                    @if ($event == $loop->first)

                                        <div class="card col-md-12" style="margin-bottom: 1em; margin-top: 1em;">
                                            <img class="card-img-top" src="storage/{{ $event->image }}" alt="Card image cap" style="height: 300px; object-fit: cover;">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $event->name }}</h5>
                                                <p class="card-text">@parsedown($event->description)</p>
                                            </div>
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item">Catégorie: {{ $event->category }}</li>
                                                <li class="list-group-item">Date: {{ date('d-m-Y', strtotime($event->date)) }}</li>
                                            </ul>
                                            <div class="card-body">
                                                <a href="{{ route('events.show', $event->id) }}" class="btn btn-primary">Plus d'infos</a>
                                            </div>
                                        </div>

                                    @endif

                                    @if($event != $loop->first)
                                        <div class="card col-sm-4" style="margin-bottom: 1em; margin-right: : 1rem;">

                                        <img class="card-img-top" src="storage/{{ $event->image }}" alt="Card image cap">

                                        <div class="card-body">
                                            <h5 class="card-title">{{ $event->name }}</h5>
                                            <p class="card-text">@parsedown($event->description)</p>
                                        </div>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">Catégorie: {{ $event->category }}</li>
                                            <li class="list-group-item">Date: {{ date('d-m-Y', strtotime($event->date)) }}</li>
                                        </ul>
                                        <div class="card-body">
                                            <a href="{{ route('events.show', $event->id) }}" class="btn btn-primary">Plus d'infos</a>
                                        </div>
                                        </div>
                                @endif
                              @endforeach
                            </div>
                          {{ $events->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
