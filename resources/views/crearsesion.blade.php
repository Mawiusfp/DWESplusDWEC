@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-success text-white text-center">
                    <h4 class="mb-0 py-2">Crear Nueva Sesión</h4>
                </div>

                <div class="card-body p-4">
                    <form id="form-crear-sesion">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="fw-bold">Fecha de la Sesión</label>
                                <input type="date" id="sesion_fecha" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="fw-bold">Duración (minutos)</label>
                                <input type="number" id="sesion_duracion" class="form-control" placeholder="Ej: 60" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="fw-bold">Descripción</label>
                            <textarea id="sesion_descripcion" class="form-control" rows="3" placeholder="Descripción de la sesión"></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="fw-bold">Tipo de Sesión</label>
                                <select id="sesion_tipo" class="form-select" required>
                                    <option value="entrenamiento">Entrenamiento</option>
                                    <option value="recovery">Recovery</option>
                                    <option value="competicion">Competicion</option>
                                    <option value="descanso">Descanso</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="fw-bold">Intensidad</label>
                                <select id="sesion_intensidad" class="form-select" required>
                                    <option value="baja">Baja</option>
                                    <option value="media">Media</option>
                                    <option value="alta">Alta</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="fw-bold">Plan de Entrenamiento</label>
                            <select id="sesion_plan" class="form-select">
                                <option value="">Selecciona un plan</option>
                                <!-- Options will be populated by JavaScript -->
                            </select>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" onclick="window.history.back()">Volver</button>
                            <button type="submit" class="btn btn-success">Crear Sesión</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Load plans for dropdown
    loadPlans();
});

async function loadPlans() {
    try {
        const response = await fetch('http://localhost:8000/api/plan', {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });

        const result = await response.json();
        
        if (response.ok && result.success) {
            const planSelect = document.getElementById('sesion_plan');
            result.data.forEach(plan => {
                const option = document.createElement('option');
                option.value = plan.id;
                option.textContent = plan.nombre;
                planSelect.appendChild(option);
            });
        }
    } catch (error) {
        console.error("Error cargando planes:", error);
    }
}

document.getElementById('form-crear-sesion').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const data = {
        id_ciclista: {{ Auth::check() ? Auth::user()->id : 'null' }},
        fecha: document.getElementById('sesion_fecha').value,
        duracion: parseInt(document.getElementById('sesion_duracion').value),
        descripcion: document.getElementById('sesion_descripcion').value,
        tipo: document.getElementById('sesion_tipo').value,
        intensidad: document.getElementById('sesion_intensidad').value,
        id_plan: document.getElementById('sesion_plan').value || null,
        nombre: "Sesión de " + new Date(document.getElementById('sesion_fecha').value).toLocaleDateString('es-ES')
    };

    if (!data.fecha || !data.duracion) {
        alert("Por favor, rellena los campos obligatorios (fecha y duración).");
        return;
    }

    try {
        const endpoint = 'http://localhost:8000/api/sesion';
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
            alert("¡Sesión guardada con éxito!");
            window.location.href = '/sesiones'; // Redirect to sessions page
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