@extends('base')

@section('title', 'Login')

@section('main')
    {{-- Login-Formular --}}
    <form method="post" action="{{ route('authenticate') }}">
        @csrf
        <p><input type="text" name="name" placeholder="Benutzer"></p>
        <p><input type="password" name="password" placeholder="Passwort"></p>
        <p><button type="submit">Login</button></p>
    </form>
@endsection
