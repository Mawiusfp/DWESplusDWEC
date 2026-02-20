async function append_plan(id) {
    const endpoint = `http://localhost:8000/api/plan/${id}`;
    const container = document.getElementById('body');
    const loader = document.querySelector('.loader-container');

    try {
        if (loader) loader.style.display = 'flex';

        let req = await fetch(endpoint);
        if (!req.ok) throw new Error(`Plan ${id} no encontrado`);
        
        let response = await req.json();
        
        if (response.success && response.data) {
            renderPlanCard(response.data, container);
        }

    } catch (error) {
        console.error(error);
    } finally {
        if (loader) loader.style.display = 'none';
    }
}

function renderPlanCard(plan, container) {
    const cardHTML = `
        <div class="card" id="plan-${plan.id}">
            <h2>${plan.nombre || 'Sin nombre'}</h2>
            <p><strong>Descripción:</strong> ${plan.descripcion || 'Sin descripción'}</p>
            <hr>
            <div class="stats">
                <p>Objetivo: ${plan.objetivo || 'No definido'}</p>
                <p>Ciclista: ${plan.ciclista ? plan.ciclista.nombre : 'No asignado'}</p>
            </div>
            <h3>Sesiones incluidas:</h3>
            <ul>
                ${plan.sesiones && plan.sesiones.length > 0 ? plan.sesiones.map(sesion => `
                    <li>
                        <strong>${sesion.nombre}</strong>
                        <br>
                        <small>Fecha: ${new Date(sesion.fecha).toLocaleDateString()}</small>
                        <br>
                        <small>Estado: ${sesion.completada ? 'Completada' : 'Pendiente'}</small>
                    </li>
                `).join('') : '<li>No hay sesiones asignadas</li>'}
            </ul>
        </div>
    `;

    container.insertAdjacentHTML('beforeend', cardHTML);
}

let planCount = 0;
const initial_load_count = 2;

document.addEventListener('DOMContentLoaded', async () => {
    for (let i = 1; i <= initial_load_count; i++) {
        await append_plan(i);
        planCount = i;
    }
    document.addEventListener('scrollend', async function() {
        planCount += 1;
        await append_plan(planCount);
    });
});