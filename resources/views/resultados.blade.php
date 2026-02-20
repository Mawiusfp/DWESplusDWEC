@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Historial de Resultados') }}</div>

                <div id="body" class="card-body">
                    
                    <hr>

                    <div class="loader-container" style="display: none;">
                        <div class="loader"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <script src="{{ asset('js/Main_layout.js') }}"></script> -->
<script src="{{ asset('js/resultados.js') }}"></script>
@endsection