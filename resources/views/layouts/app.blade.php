<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('titleicon.ico') }}">
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage">
    <meta name="theme-color" content="#ffffff">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>HotelCloud</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="{{ asset('/fonts.gstatic.com') }}">
    <link href="https://fonts.googleapis.com/css?family=Prompt" rel="stylesheet" type="text/css">
    <link href="{{ asset('lib/fontawesome-pro-5.6.1/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

    <!-- Styles -->
    {{--<link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
</head>
<style>
    table{
        width:100%
    }
</style>
<body>
<div id="app">
    {{--<nav class="navbar navbar-expand-md navbar-light navbar-laravel">--}}
    {{--<div class="container">--}}
    {{--<a class="navbar-brand" href="{{ url('/') }}">--}}
    {{--{{ config('app.name', 'Laravel') }}--}}
    {{--</a>--}}
    {{--<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">--}}
    {{--<span class="navbar-toggler-icon"></span>--}}
    {{--</button>--}}

    {{--<div class="collapse navbar-collapse" id="navbarSupportedContent">--}}
    {{--<!-- Left Side Of Navbar -->--}}
    {{--<ul class="navbar-nav mr-auto">--}}

    {{--</ul>--}}

    {{--<!-- Right Side Of Navbar -->--}}
    {{--<ul class="navbar-nav ml-auto">--}}
    {{--<!-- Authentication Links -->--}}
    {{--@guest--}}
    {{--<li class="nav-item">--}}
    {{--<a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>--}}
    {{--</li>--}}
    {{--@if (Route::has('register'))--}}
    {{--<li class="nav-item">--}}
    {{--<a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>--}}
    {{--</li>--}}
    {{--@endif--}}
    {{--@else--}}
    {{--<li class="nav-item dropdown">--}}
    {{--<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>--}}
    {{--{{ Auth::user()->name }} <span class="caret"></span>--}}
    {{--</a>--}}

    {{--<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">--}}
    {{--<a class="dropdown-item" href="{{ route('logout') }}"--}}
    {{--onclick="event.preventDefault();--}}
    {{--document.getElementById('logout-form').submit();">--}}
    {{--{{ __('Logout') }}--}}
    {{--</a>--}}

    {{--<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">--}}
    {{--@csrf--}}
    {{--</form>--}}
    {{--</div>--}}
    {{--</li>--}}
    {{--@endguest--}}
    {{--</ul>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</nav>--}}

    <main class="py-4">
        @yield('content')
    </main>
</div>
</body>
</html>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
{{--<script src="{{ asset('js/pusher.min.js') }}"></script>--}}
{{--<script type="application/javascript">--}}
{{--$.ajaxSetup({--}}
{{--headers: {--}}
{{--'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
{{--}--}}
{{--})--}}

{{--$(document).ready(function () {--}}
{{--$.get("{{ route('api.province.index') }}", function (data) {--}}
{{--console.info(data)--}}
{{--})--}}
{{--})--}}

{{--Pusher.logToConsole = true--}}

{{--var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {--}}
{{--cluster: '{{ env('PUSHER_APP_CLUSTER') }}',--}}
{{--forceTLS: true--}}
{{--})--}}

{{--var channel = pusher.subscribe('my-channel')--}}
{{--channel.bind('my-event', function (data) {--}}
{{--alert(JSON.stringify(data))--}}
{{--})--}}
{{--</script>--}}
