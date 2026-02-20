@extends('layouts.app')

@section('content')
<div class="container py-4">
    <meta name="user-id" content="{{ Auth::check() ? Auth::user()->id : '' }}">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0">
                <div class="card shadow-lg border-0 mt-5">
                    <div class="card-header bg-success text-white text-center">
                        <h4 class="mb-0 py-2">Crear Nuevo Plan de Entrenamiento</h4>
                    </div>

                    <div class="card-body p-4">
                        <form id="form-crear-plan">
                            <div class="row">
                                <div class="col-md-8 mb-3">
                                    <label class="fw-bold">Nombre del Plan</label>
                                    <input type="text" id="plan_nombre" class="form-control" placeholder="Ej: Plan de Verano 2023" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="fw-bold">Estado</label>
                                    <select id="plan_estado" class="form-select" required>
                                        <option value="pendiente">Pendiente</option>
                                        <option value="activo">Activo</option>
                                        <option value="completado">Completado</option>
                                        <option value="pausado">Pausado</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="fw-bold">Descripción</label>
                                <textarea id="plan_descripcion" class="form-control" rows="3" placeholder="Descripción del plan de entrenamiento"></textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold">Fecha de Inicio</label>
                                    <input type="date" id="plan_fecha_inicio" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold">Fecha de Fin</label>
                                    <input type="date" id="plan_fecha_fin" class="form-control" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="fw-bold">Objetivo</label>
                                <input type="text" id="plan_objetivo" class="form-control" placeholder="Objetivo del plan">
                            </div>

                            <div class="mb-3">
                                <label class="fw-bold">Bloques del Plan</label>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" value="1" id="bloque_1">
                                    <label class="form-check-label" for="bloque_1">Bloque 1</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" value="2" id="bloque_2">
                                    <label class="form-check-label" for="bloque_2">Bloque 2</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" value="3" id="bloque_3">
                                    <label class="form-check-label" for="bloque_3">Bloque 3</label>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-secondary" onclick="window.history.back()">Volver</button>
                                <button type="submit" class="btn btn-success">Crear Plan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('form-crear-plan').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const data = {
        id_ciclista: {{ Auth::check() ? Auth::user()->id : 'null' }},
        nombre: document.getElementById('plan_nombre').value,
        descripcion: document.getElementById('plan_descripcion').value,
        fecha_inicio: document.getElementById('plan_fecha_inicio').value,
        fecha_fin: document.getElementById('plan_fecha_fin').value,
        objetivo: document.getElementById('plan_objetivo').value,
        activo: true
    };

    if (!data.nombre || !data.fecha_inicio || !data.fecha_fin) {
        alert("Por favor, rellena los campos obligatorios (nombre, fecha de inicio y fin).");
        return;
    }

    try {
        const endpoint = 'http://localhost:8000/api/plan/crear';
        const response = await fetch(endpoint, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(data)
        });

        const result = await response.json();

        if (response.ok && result.success) {
            alert("¡Plan guardado con éxito!");
            window.location.href = '/planes'; 
        } else {
            if (result.errors) {
                const errores = Object.values(result.errors).flat().join('\n');
                alert("Errores:\n" + errores);
            } else {
                alert("Error: " + (result.message || "No se pudo guardar"));
            }
        }

    } catch (error) {
        console.error("Error en la conexión:", error);
        alert("No se pudo conectar con el servidor.");
    }
});
</script>
@endsection