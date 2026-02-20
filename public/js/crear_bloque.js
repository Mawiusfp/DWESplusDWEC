async function crearBloque() {
    console.log("Iniciando creación de bloque...");

    const form = document.getElementById('form-crear-bloque');

    const data = {
        nombre: document.getElementById('bloque_nombre').value,
        descripcion: document.getElementById('bloque_descripcion').value,
        tipo: document.getElementById('bloque_tipo').value,
        duracion_estimada: document.getElementById('bloque_duracion').value,
        potencia_pct_min: document.getElementById('bloque_pot_min').value || null,
        potencia_pct_max: document.getElementById('bloque_pot_max').value || null,
        pulso_pct_max: document.getElementById('bloque_pulso_max').value || null,
        pulso_reserva_pct: document.getElementById('bloque_pulso_reserva').value || null,
        comentario: document.getElementById('bloque_comentario').value
    };

    if (!data.nombre || !data.tipo) {
        alert("Por favor, rellena el nombre y el tipo de bloque.");
        return;
    }

    try {
        const endpoint = 'http://localhost:8000/api/bloque';
        const response = await fetch(endpoint, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify(data)
        });

        const result = await response.json();

        if (response.ok && result.success) {
            alert("¡Bloque guardado con éxito!");
            form.reset();
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
}