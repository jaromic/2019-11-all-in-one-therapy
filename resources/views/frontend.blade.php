@extends('base')

@section('nav')
    <nav class="top-right links navbar navbar-expand-lg navbar-light bg-light">
        @auth
            <ul class="navbar-nav flex-grow-1">
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/backend') }}">Backend</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                </li>
            </ul>
        @else
            <ul class="navbar-nav flex-grow-1">
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>
            </ul>
        @endauth
    </nav>
@endsection

@section('title')
    Praxis "A &amp; B"
@endsection

@section('main')
    <main>
        <div class="about-us">
            <h1>Über uns</h1>
            <div></div>
        </div>
        <div class="services">
            <h1>Leistungen</h1>
            <div></div>
        </div>
        <div class="map">
            <h1>Anfahrt</h1>
            <div></div>
        </div>
        <div class="contact">
            <h1>Kontakt</h1>
            <div></div>
        </div>
    </main>
@endsection
