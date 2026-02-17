<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/base.css') }}?v={{ time() }}" rel="stylesheet">
</head>
<body>
<div id="app">

<nav class="navbar-custom">
    <div class="nav-left">
        <a class="navbar-brand-custom" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
    </div>

    @guest
    @else
        <div class="nav-center">
            <a href="{{ route('home') }}" class="nav-btn">Inicio</a>
            <a href="{{ route('planes') }}" class="nav-btn">Planes</a>
            <a href="{{ route('sesiones') }}" class="nav-btn">Sesiones</a>
            <a href="{{ route('bloques') }}" class="nav-btn">Bloques</a>
            <a href="{{ route('resultados') }}" class="nav-btn">Resultados</a>
        </div>

        <div class="nav-right">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    @endguest
</nav>

<main class="py-4">
    @yield('content')
</main>

</div>
</body>
</html>
