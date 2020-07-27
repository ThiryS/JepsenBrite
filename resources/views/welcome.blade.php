<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Jepsen Brite</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="icon" href="favicon.ico" />

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                    <a href="{{ url('/events') }}">Events</a>
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Jepsen Brite
                </div>


            </div>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Tous des événemets') }}</div>

                        <div class="card-body">
                          <table class="table table-bordered">
                            <tr class="thead-light">
                              <th scope="col">Nom</th>
                              <th scope="col">Date</th>
                              <th scope="col">Categorie</th>
                              <th scope="col">Createur</th>
                            </tr>
                            @foreach ($events->sortBy('date') as $event)
                            @if ($event->date >= now())
                            <tr>
                              <td><a href="{{ route('events.show', $event->id) }}">{{ $event->name }}</a></td>
                              <td>{{ date('d-m-Y', strtotime($event->date)) }}</td>
                              <td>{{ $event->category }}</td>
                              <td>{{ $event->user->name}}</td>
                            </tr>
                            @endif
                            @endforeach
                          </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
