@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Panel de Sesiones') }}</div>

                <div id="body" class="card-body">
                    <a href="./CrearSesion" class="link">Crear Sesion</a>
                    
                    <hr>

                    <div class="loader-container">
                        <div class="loader"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/Main_layout.js') }}"></script>
<script src="{{ asset('js/sesiones.js') }}"></script>
@endsection