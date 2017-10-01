<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Rishadan') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="app">
    @include('includes.header')

    @if(Auth::user())
        <div id="app" class="authenticated">
            @yield('content')
        </div>
    @else
        <div id="app">
            @yield('content')
        </div>
    @endif

    @include('includes.footer')
</div>
@include('scripts.main')
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
