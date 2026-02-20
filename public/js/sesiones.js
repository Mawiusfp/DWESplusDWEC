async function append_sesion_bloque(id) {
    const endpoint = `http://localhost:8000/api/sesionbloque/${id}`;
    const container = document.getElementById('body');
    const loader = document.querySelector('.loader-container');

    try {
        if (loader) loader.style.display = 'flex';

        let req = await fetch(endpoint);
        if (!req.ok) throw new Error(`Sesion-Bloque ${id} no encontrado`);
        
        let response = await req.json();
        
        if (response.success && response.data) {
            renderSesionCard(response.data, container);
        }

    } catch (error) {
        console.error(error);
    } finally {
        if (loader) loader.style.display = 'none';
    }
}

function renderSesionCard(item, container) {
    const sesion = item.sesion;
    const bloque = item.bloque;

    const cardHTML = `
        <div class="card" id="sesion-bloque-${item.id}">
            <h2>${sesion.nombre}</h2>
            <p><strong>Estado:</strong> ${sesion.completada ? 'Completada' : 'Pendiente'}</p>
            <p><strong>Descripcion sesion:</strong> ${sesion.descripcion || 'Sin descripcion'}</p>
            <p><strong>Fecha:</strong> ${new Date(sesion.fecha).toLocaleDateString()}</p>
            <hr>
            <div>
                <h4>Bloque: ${bloque.nombre}</h4>
                <p>Orden: ${item.orden} | Repeticiones: ${item.repeticiones}</p>
                <p>Descripcion bloque: ${bloque.descripcion}</p>
                <div class="stats">
                    <p>Tipo: ${bloque.tipo}</p>
                    <p>Duracion: ${bloque.duracion_estimada}</p>
                    <p>Potencia: ${bloque.potencia_pct_min}% - ${bloque.potencia_pct_max}%</p>
                    <p>Pulso Max: ${bloque.pulso_pct_max}%</p>
                </div>
                <p>Comentario: ${bloque.comentario}</p>
            </div>
        </div>
    `;

    container.insertAdjacentHTML('beforeend', cardHTML);
}

let count = 0;
const initial_load_count = 2;

document.addEventListener('DOMContentLoaded', async () => {
    for (let i = 1; i <= initial_load_count; i++) {
        await append_sesion_bloque(i);
        count = i;
    }
    document.addEventListener('scrollend', async function() {
        count += 1;
        await append_sesion_bloque(count);
    });
});