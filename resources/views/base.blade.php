<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="/css/app.css" rel="stylesheet">
</head>
<body>
@section('nav')
    @auth
        <nav class="top-right links navbar navbar-expand-lg navbar-light bg-light">
            <ul class="navbar-nav flex-grow-1">
                <li class="nav-item"><a class="nav-link {{ request()->is('patients') ? "active" : "" }}"
                                        href="{{ route('patients') }}">Patient</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->is('bills') ? "active" : "" }}"
                                        href="{{ route('bills') }}">Rechnung</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->is('slots') ? "active" : "" }}"
                                        href="{{ route('slots') }}">Termin</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->is('documentations') ? "active" : "" }}"
                                        href="{{ route('documentations') }}">Dokumentation</a></li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link {{ request()->is('') ? "active" : "" }}" href="{{ route('/') }}">Frontend</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="{{ route('logout') }}">Logout</a></li>
            </ul>
        </nav>
    @endauth
@show
<div class="content">
    <div class="title m-b-md">
        @yield('title')
    </div>
    @if(session()->has('message'))
        <div class="alert alert-primary" role="alert">
            {{ session('message') }}
        </div>
    @endif
    <main>
        @yield('main')
    </main>
</div>
</body>
</html>
