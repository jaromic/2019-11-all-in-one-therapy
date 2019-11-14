<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title') &ndash; Backend &ndash; All-in-one Therapy</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="/css/app.css" rel="stylesheet">
</head>
<body>
<nav class="links">
    @if (auth()->user()->hasPermission('patient'))
    <a href="{{ route('patients') }}">Patient</a>
    @endif
    @if (auth()->user()->hasPermission('rechnung'))
    <a href="{{ route('/') }}">Rechnung</a>
    @endif
    @if (auth()->user()->hasPermission('calendar'))
    <a href="{{ route('/') }}">Termin</a>
    @endif
    @if (auth()->user()->hasPermission('documentation'))
    <a href="{{ route('documentations') }}">Dokumentation</a>
    @endif
    |
    <a href="{{ route('/') }}">Frontend</a>
    <a href="{{ route('logout') }}">Logout</a>
</nav>
<div class="content">
    <div class="title m-b-md">
        @yield('title') &ndash; Backend &ndash; All-in-one Therapy
    </div>
    @if(session()->has('message'))
        <div class="message">
            {{ session('message') }}
        </div>
    @endif
    <main>
        @yield('main')
    </main>
</div>
</body>
</html>
