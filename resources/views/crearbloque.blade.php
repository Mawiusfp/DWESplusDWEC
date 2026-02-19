@extends('layouts.app')

@section('content')
<div class="container py-4">
    <meta name="user-id" content="{{ Auth::check() ? Auth::user()->id : '' }}">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0">
                <div class="card shadow-lg border-0 mt-5">
                    <div class="card-header bg-success text-white text-center">
                        <h4 class="mb-0 py-2">Crear Nuevo Bloque de Entrenamiento</h4>
                    </div>

                    <div class="card-body p-4">
                        <form id="form-crear-bloque">
                            <div class="row">
                                <div class="col-md-8 mb-3">
                                    <label class="fw-bold">Nombre del Bloque</label>
                                    <input type="text" id="bloque_nombre" class="form-control" placeholder="Ej: Calentamiento Pro" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="fw-bold">Tipo</label>
                                    <select id="bloque_tipo" class="form-select" required>
                                        <option value="rodaje">Rodaje</option>
                                        <option value="intervalos">Intervalos</option>
                                        <option value="fuerza">Fuerza</option>
                                        <option value="recuperacion">Recuperación</option>
                                        <option value="test">Test</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="fw-bold">Descripción</label>
                                <textarea id="bloque_descripcion" class="form-control" rows="2" placeholder="¿En qué consiste este bloque?"></textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="fw-bold">Duración (HH:MM:SS)</label>
                                    <input type="text" id="bloque_duracion" class="form-control" placeholder="00:15:00" value="00:00:00">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="fw-bold">Potencia Min (%)</label>
                                    <input type="number" id="bloque_pot_min" class="form-control" placeholder="50">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="fw-bold">Potencia Max (%)</label>
                                    <input type="number" id="bloque_pot_max" class="form-control" placeholder="70">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold">Pulso Max (%)</label>
                                    <input type="number" id="bloque_pulso_max" class="form-control" placeholder="85">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold">Pulso Reserva (%)</label>
                                    <input type="number" id="bloque_pulso_reserva" class="form-control" placeholder="60">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="fw-bold">Comentario Interno</label>
                                <input type="text" id="bloque_comentario" class="form-control" placeholder="Notas para el entrenador...">
                            </div>

                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-success btn-lg rounded-pill">
                                    <i class="bi bi-plus-circle me-2"></i>Crear Bloque
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/crear_bloque.js') }}"></script>
@endsection