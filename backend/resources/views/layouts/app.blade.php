<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/login.css')}}">

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top py-4"
        style="background-image: linear-gradient(rgba(0, 0, 0, 0.648), rgba(255, 255, 255, 0));">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span style="color: white;" class="fa-solid fa-bars fa-xl mb-4"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <li class="nav-item">
                        <a href="{{ url('/') }}"><img class="nav-logo" src="{{asset('img/logo.png')}}"
                                alt="logo"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" style="color:white;" aria-current="page" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" style="color:white;" aria-current="page"
                            href="{{ url('/') }}#Clients">Clients</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" style="color:white;" aria-current="page" href="{{ url('/') }}#Contact">Contact</a>
                    </li>
                    @guest
                    @else
                    <li class="nav-item">
                        <a class="nav-link active" style="color:white;" aria-current="page" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                    </li>
                    @endguest
                </ul>

            </div>
        </div>
    </nav>
        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <script src="https://kit.fontawesome.com/d2d3f16619.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</body>
</html>
