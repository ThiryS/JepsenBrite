@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-baseline"><h4>Participants</h4>
              </div>

                <div class="card-body">
                    <ul>
                        @foreach ($event->participates as $participants)
                        <li> <a href="../../profile/{{ $participants->user->id }}">{{  $participants->user->name  }}</a></li>
                        @endforeach
                    </ul>
                    
                </div>

            </div>

          
        </div>
    </div>
</div>
</script>
@endsection
