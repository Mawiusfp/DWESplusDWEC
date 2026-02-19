@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div id="body">
                    <a href="./CrearBloque" class="link">Crear Bloque</a>

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
<script src="{{ asset('js/bloques.js') }}"></script>
@endsection
