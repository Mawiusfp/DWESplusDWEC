async function append_bloque(id) {

    const endpoint = `http://localhost:8000/api/bloque/${id}`;
    const container = document.getElementById('body');
    const loader = document.querySelector('.loader-container');

    try {
        if (loader) loader.style.display = 'flex';

        let req = await fetch(endpoint);
        if (!req.ok) throw new Error(`Bloque ${id} no encontrado`);
        
        let data = await req.json();
        
        renderBloqueCard(data, container);

    } catch (error) {
        console.error(error);
    } finally {
        if (loader) loader.style.display = 'none';
    }
}

function renderBloqueCard(bloque, container) {
    // TODO
    //      REMOVE THIS TO PREVENT XSS
    const cardHTML = `
        <div class="card" id="bloque-${bloque.id}">
            <h2>${bloque.nombre}</h2>
            <p><strong>Descripción:</strong> ${bloque.descripcion}</p>
            <hr>
            <div class="stats">
                <p>Tipo: ${bloque.tipo}</p>
                <p>Duración: ${bloque.duracion_estimada}</p>
                <p>Potencia: ${bloque.potencia_pct_min}% - ${bloque.potencia_pct_max}%</p>
                <p>Pulso Máx: ${bloque.pulso_pct_max}%</p>
            </div>
            <p>"${bloque.comentario}"</p>
            <h3>Sesiones:</h3>
            <ul>
                ${bloque.sesiones.map(sesion => `
                    <li>
                        ${sesion.nombre} (${new Date(sesion.fecha).toLocaleDateString()})
                        <br>Orden: ${sesion.pivot.orden} | Repeticiones: ${sesion.pivot.repeticiones}
                    </li>
                `).join('')}
            </ul>
        </div>
    `;

    container.insertAdjacentHTML('beforeend', cardHTML);
}



let count = 0;
const initial_load_count = 2;

document.addEventListener('DOMContentLoaded', async () => {
    for (let i = 1; i <= initial_load_count; i++) {
        await append_bloque(i);
        count = i;
    }
    document.addEventListener('scrollend', async function() {
        // console.log(`Lload: ${count}`);
        await append_bloque(count);
        count+=1;
    });
});