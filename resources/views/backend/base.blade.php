<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title') &ndash; Backend &ndash; AIOT</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="/css/app.css" rel="stylesheet">
</head>
<body>
<div class="flex-center position-ref full-height">
    <nav class="top-right links">
        @if (App\User::hasPermission('admin-patient'))
            <a href="{{ route('patients') }}">Patient</a>
        @endif
        @if (App\User::hasPermission('admin-patient'))
            <a href="{{ route('backend') }}">Rechnung</a>
        @endif
        @if (App\User::hasPermission('admin-calendar'))
            <a href="{{ route('backend') }}">Termin</a>
        @endif
        @if (App\User::hasPermission('admin-documentation'))
            <a href="{{ route('documentations') }}">Dokumentation</a>
        @endif
        @if (App\User::hasPermission('admin-calendar'))
        {{-- if no admin-calendar, there are probably no menu entries before this --}}
        |
        @endif
        <a href="{{ route('/') }}">Frontend</a>
        <a href="{{ route('logout') }}">Logout</a>
    </nav>
    <div class="content">
        <div class="title m-b-md">
            @yield('title') &ndash; Backend &ndash; AIOT
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
</div>
</body>
</html>
