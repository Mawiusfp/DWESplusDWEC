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

    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm py-2">
        <div class="container d-flex justify-content-between align-items-center">

            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>

            <ul class="navbar-nav ml-auto d-flex align-items-center" style="list-style: none; margin: 0; padding: 0;">

                @guest
                    <li class="nav-item">
                        <a class="btn btn-primary mx-1 px-3 py-1" href="{{ route('login') }}">
                            {{ __('Login') }}
                        </a>
                    </li>

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="btn btn-primary mx-1 px-3 py-1" href="{{ route('register') }}">
                                {{ __('Register') }}
                            </a>
                        </li>
                    @endif
                @else

                    <li class="nav-item d-flex align-items-center">

                        <!-- BOTONES DE NAVEGACIÓN -->
                        <nav class="d-flex gap-2 me-3">

                            <a href="{{ route('home') }}" class="btn btn-outline-primary mx-1 px-3 py-1">
                                Inicio
                            </a>

                            <a href="{{ route('planes') }}" class="btn btn-outline-primary mx-1 px-3 py-1">
                                Planes
                            </a>

                            <a href="{{ route('sesiones') }}" class="btn btn-outline-primary mx-1 px-3 py-1">
                                Sesiones
                            </a>

                            <a href="{{ route('bloques') }}" class="btn btn-outline-primary mx-1 px-3 py-1">
                                Bloques
                            </a>

                            <a href="{{ route('resultados') }}" class="btn btn-outline-primary mx-1 px-3 py-1">
                                Resultados
                            </a>

                        </nav>

                        <!-- LOGOUT -->
                        <form id="logout-form"
                              action="{{ route('logout') }}"
                              method="POST"
                              class="d-flex m-0 p-0">
                            @csrf
                            <button type="submit" class="btn btn-primary mx-1 px-3 py-1">
                                Logout
                            </button>
                        </form>

                    </li>

                @endguest

            </ul>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>

</div>
</body>
</html>
