@extends('backend.base')
@section('title')
    Login
@endsection
@section ('main')
        <form method="post" action="{{ route('authenticate') }}">
            @csrf
            @if ($errors->has('name'))
                <p class="validation-failed">
                    {{ $errors->first('name') }}<br/>
                    <input class="validation-failed" placeholder="Username" type="text" name="name" value="{{ old('name') }}">
                </p>
            @else
                <p>
                    <input placeholder="Username" type="text" name="name">
                </p>
            @endif
            @if ($errors->has('password'))
                <p class="validation-failed">
                    {{ $errors->first('password') }} <br/>
                    <input class="validation-failed" placeholder="Password" type="password" name="password" >
                </p>
            @else
                <p>
                    <input placeholder="Password" type="password" name="password">
                </p>
            @endif
            <p>
                <button type="submit">Login</button>
                <a href="{{ route('/') }}">Cancel</a>
            </p>
        </form>
@endsection
