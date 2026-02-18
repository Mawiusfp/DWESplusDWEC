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

                <h1>SOY EL BLADE DE LO RESULTADOS</h1>

                <div id="body">
                </div>

            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/Main_layout.js') }}"></script>
@endsection
