@extends('backend.base')

@section('title')
    Home
@endsection
@section ('main')
    <div style="width:400px; margin-left: auto; margin-right: auto">
        <h1>Willkommen, {{ auth()->user()->name }}!</h1>

        <p>
        Sie haben aufgrund Ihrer Rolle(n) {{ implode(", ", auth()->user()->getRoleNames()) }} die folgenden
        Berechtigungen:
        </p>

        <ul style="text-align: left;">
            @foreach(auth()->user()->getPermissionNames() as $permissionName)
                <li>{{ $permissionName }}</li>
            @endforeach
        </ul>

        <p>
            Bitte nutzen Sie diese weise.
        </p>
    </div>
@endsection
