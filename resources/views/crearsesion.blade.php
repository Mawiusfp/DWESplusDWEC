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
                        <div class="mb-3">
                            <label class="fw-bold">Nombre de la Sesión</label>
                            <input type="text" id="sesion_nombre" class="form-control" placeholder="Ej: Sweet Spot progresivo" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="fw-bold">Fecha</label>
                                <input type="date" id="sesion_fecha" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="fw-bold">Plan de Entrenamiento</label>
                                <select id="sesion_plan" class="form-select" required>
                                    <option value="">Selecciona un plan</option>
                                    </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="fw-bold">Descripción</label>
                            <textarea id="sesion_descripcion" class="form-control" rows="3" placeholder="Trabajo de umbral"></textarea>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" id="sesion_completada" class="form-check-input">
                            <label class="form-check-label fw-bold">¿Completada?</label>
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
    loadPlans();
});

async function loadPlans() {
    try {
        const response = await fetch('http://localhost:8000/api/plan');
        const result = await response.json();
        
        // Ajustado a la estructura de tu API: result.success y result.data
        if (result.success) {
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
    
    // Mapeo exacto a los campos del Modelo: id_plan, fecha, nombre, descripcion, completada
    const data = {
        nombre: document.getElementById('sesion_nombre').value,
        id_plan: parseInt(document.getElementById('sesion_plan').value),
        fecha: document.getElementById('sesion_fecha').value,
        descripcion: document.getElementById('sesion_descripcion').value,
        completada: document.getElementById('sesion_completada').checked
    };

    try {
        const response = await fetch('http://localhost:8000/api/sesion', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(data)
        });

        const result = await response.json();

        if (response.ok && result.status === "success") {
            alert("¡Sesión guardada con éxito!");
            window.location.href = '/sesiones';
        } else {
            alert("Error: " + (result.message || "No se pudo guardar"));
        }

    } catch (error) {
        console.error("Error:", error);
        alert("No se pudo conectar con el servidor.");
    }
});
</script>
@endsection