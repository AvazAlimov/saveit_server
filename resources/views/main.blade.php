<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SaveIt</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <script src="{{ asset('js/tether.min.js') }}"></script>
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <style>
        .bg-main {
            background-color: #009688;
        }
        .navbar {
            box-shadow: 0 0 8px #888;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-main">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler"
                aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        {{--<a class="navbar-brand" href="/">--}}
        {{--<img src="{{ asset('/Resources/Logo.svg') }}" width="40" height="40" alt="">--}}
        {{--</a>--}}
        <div class="expend navbar-collapse" id="navbarToggler">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="#register">Аъзо бўлиш<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#about">Биз ҳақимизда</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contacts">Боғланиш</a>
                </li>
            </ul>
            <ul class="navbar-nav my-2 my-lg-0">
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Кириш</a>
                </li>
            @else
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                       data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        {{ \Illuminate\Support\Facades\Auth::user()->username }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            Logout
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </a>
                    </div>
                </li>
            @endguest
            </ul>
        </div>
    </div>
</nav>
</body>
</html>
