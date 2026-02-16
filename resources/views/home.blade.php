@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
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

                <h1>Mi App de bicicletas</h1>

                <nav class="main-navbar">
                    <div>
                        <label for="inicio">Inicio</label>
                        <select name="inicio" id="inicio"></select>
                    </div>

                    <div>
                        <label for="planes">Planes</label>
                        <select name="planes" id="planes"></select>
                    </div>

                    <div>
                        <label for="sesiones">Sesiones</label>
                        <select name="sesiones" id="sesiones"></select>
                    </div>

                    <div>
                        <label for="bloques">Bloques</label>
                        <select name="bloques" id="bloques"></select>
                    </div>

                    <div>
                        <label for="resultados">Resultados</label>
                        <select name="resultados" id="resultados"></select>
                    </div>
                </nav>

                <div id="body">
                    <!-- Aquí aparecerá el contenido al hacer click en los selects -->
                </div>

            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/Main_layout.js') }}"></script>
@endsection
