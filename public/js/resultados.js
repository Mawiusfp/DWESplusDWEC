async function append_resultado(id) {
    const endpoint = `http://localhost:8000/api/historico/${id}`;
    const container = document.getElementById('body');
    const loader = document.querySelector('.loader-container');

    try {
        if (loader) loader.style.display = 'flex';

        let req = await fetch(endpoint);
        if (!req.ok) throw new Error(`Resultado ${id} no encontrado`);
        
        let response = await req.json();
        
        if (response.status === "success" && response.data) {
            renderResultadoCard(response.data, container);
        }

    } catch (error) {
        console.error(error);
    } finally {
        if (loader) loader.style.display = 'none';
    }
}

function renderResultadoCard(resultado, container) {
    const cardHTML = `
        <div class="card" id="resultado-${resultado.id}">
            <h2>Fecha: ${new Date(resultado.fecha).toLocaleDateString()}</h2>
            <p><strong>Ciclista:</strong> ${resultado.ciclista.nombre} ${resultado.ciclista.apellidos}</p>
            <p><strong>Comentario:</strong> ${resultado.comentario || 'Sin comentarios'}</p>
            <hr>
            <div class="stats">
                <p>Peso: ${resultado.peso} kg</p>
                <p>FTP: ${resultado.ftp} W</p>
                <p>VO2Max: ${resultado.vo2max}</p>
                <p>Grasa Corporal: ${resultado.grasa_corporal}%</p>
                <p>Pulso Reposo: ${resultado.pulso_reposo} ppm</p>
                <p>Pulso Max: ${resultado.pulso_max} ppm</p>
                <p>Potencia Max: ${resultado.potencia_max} W</p>
            </div>
        </div>
    `;

    container.insertAdjacentHTML('beforeend', cardHTML);
}

let count = 0;
const initial_load_count = 2;

document.addEventListener('DOMContentLoaded', async () => {
    for (let i = 1; i <= initial_load_count; i++) {
        await append_resultado(i);
        count = i;
    }
    document.addEventListener('scrollend', async function() {
        count += 1;
        await append_resultado(count);
    });
});