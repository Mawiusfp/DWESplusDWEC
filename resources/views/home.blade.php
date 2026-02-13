@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>

                <h1>Mi App de bibicletas</h1>
                {{-- Menú, navbar, etc --}}
                <nav class="main-navbar">

                    <div>
                        <label for="inicio">Inicio</label>

                        <select name="inicio" id="inicio">
                        </select>
                    </div>

                    <div>
                        <label for="planes">Planes</label>

                        <select name="planes" id="planes">
                        </select>
                    </div>

                    <div>
                        <label for="sesiones">Sesiones</label>

                        <select name="sesiones" id="sesiones">
                        </select>
                    </div>

                    <div>
                        <label for="bloques">Bloques</label>

                        <select name="bloques" id="bloques">
                        </select>
                    </div>

                    <div>
                        <label for="resultados">Resultados</label>

                        <select name="resultados" id="resultados">
                        </select>
                    </div>
 
                </nav>

                <div id="body">

                    <!-- HERE IS WHERE THE THINGS SHOULD APPEAR ONCE CLICKED ON ONE OF THE DIVS ABOVE -->

                </div>

                <script src="{{ asset('js/Main_layout.js') }}"></script>
                <link rel="stylesheet" href="{{ asset('css/base.css') }}">

            </div>
        </div>
    </div>
</div>
@endsection
