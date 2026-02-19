@extends('layouts.app')

@section('content')
<div class="container py-4">
    <meta name="user-id" content="{{ Auth::check() ? Auth::user()->id : '' }}">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-dark text-white text-center">
                    <h4 class="mb-0 py-2">Configuración de Perfil</h4>
                </div>

                <div id="body" class="card-body p-4">

                    <form id="form-editar-perfil" class="d-none">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="fw-bold">Nombre</label>
                                <input type="text" id="nombre" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="fw-bold">Apellidos</label>
                                <input type="text" id="apellidos" class="form-control" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="fw-bold">Fecha de Nacimiento</label>
                            <input type="date" id="fecha_nacimiento" class="form-control" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="fw-bold">Peso (kg)</label>
                                <input type="number" id="peso_base" step="0.01" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="fw-bold">Altura (cm)</label>
                                <input type="number" id="altura_base" class="form-control" required>
                            </div>
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill">
                                Guardar Cambios
                            </button>
                            <a href="/home" class="btn btn-link text-muted">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/editar_perfil.js') }}"></script>
@endsection