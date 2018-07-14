<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Codeline Films</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
        
        <style>
            *{
                font-family: 'Open Sans'
            }
        </style>

    </head>
    <body>
        {{-- <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif
        </div> --}}

		<nav class="navbar navbar-light bg-light justify-content-center shadow-sm">
            <a class="navbar-brand pointer" href="{{route('home')}}">Codeline Films</a>
        </nav>

        <div class="container">
            <div class="row justify-content-center mt-3">
                <div class="col-md-10">
                    @if(Session::has('msg'))
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-{{Session::get('type')}}">
                                    @foreach(Session::get('msg') as $msg)
                                        <div>{{$msg}}</div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            @yield('content')
        </div>

	    <script src="https://use.fontawesome.com/1d3102576f.js"></script>
    </body>
</html>
