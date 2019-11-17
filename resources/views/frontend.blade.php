@extends('base')
@section('head')
    @parent
@endsection
@section('title', 'All-in-one Therapy')
@section('main')
    <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
            <div class="top-right links">
                @auth
                    <a href="{{ url('/backend') }}">Backend</a> | <a href="{{ route('logout') }}">Logout</a>
                @else
                    <a href="{{ route('login') }}">Login</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
            </div>
        @endif

        <div class="content">
            <div class="title m-b-md">
                All-in-one Therapy
            </div>

            <main>
                <div class="about-us">
                    <a class="btn btn-primary" data-toggle="collapse" href="#aboutus"><h1>Über uns</h1></a>
                    <div class="collapse" id="aboutus"></div>
                </div>
                <div class="services">
                    <a class="btn btn-primary" data-toggle="collapse" href="#services"><h1>Leistungen</h1></a>
                    <div class="collapse" id="services"></div>
                </div>
                <div class="map">
                    <a class="btn btn-primary" data-toggle="collapse" href="#map"><h1>Anfahrt</h1></a>
                    <div class="collapse" id="map"></div>
                </div>
                <div class="contact">
                    <a class="btn btn-primary" data-toggle="collapse" href="#contact"><h1>Kontakt</h1></a>
                    <div class="collapse" id="contact"></div>
                </div>
            </main>
        </div>
    </div>
@endsection
