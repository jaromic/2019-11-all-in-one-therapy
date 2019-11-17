@extends('base')
@section('title')@parent
&ndash; Backend &ndash; AIOT
@endsection
@section('head')
    @parent
@endsection
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
            <a href="{{ route('slots') }}">Termin</a>
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
