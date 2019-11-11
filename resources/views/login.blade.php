<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login &ndash; All-in-one Therapy</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
</head>
<body>
<div class="flex-center position-ref full-height">

    <div class="content">
        <div class="title m-b-md">
            Login &ndash; All-in-one Therapy
        </div>

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

    </div>
</div>
</body>
</html>
