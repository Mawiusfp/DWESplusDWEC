let userId;

async function fill_form(id) {
    const endpoint = `http://localhost:8000/api/ciclista/${id}`;
    
    const loader = document.querySelector('.loader-container'); 
    const form = document.getElementById('form-editar-perfil');

    try {
        let response = await fetch(endpoint);
        if (!response.ok) throw new Error("Error en la conexión");
        
        let result = await response.json();
        
        if (result.status === 'success') {
            const user = result.data;

            document.getElementById('nombre').value = user.nombre;
            document.getElementById('apellidos').value = user.apellidos;
            document.getElementById('peso_base').value = user.peso_base;
            document.getElementById('altura_base').value = user.altura_base;
            document.getElementById('email').value = user.email;

            if (user.fecha_nacimiento) {
                document.getElementById('fecha_nacimiento').value = user.fecha_nacimiento.split('T')[0];
            }

            if (loader) {
                loader.remove(); 
            }

            if (form) {
                form.classList.remove('d-none');
            }
        }

    } catch (error) {
        console.error("Error al llenar el formulario:", error);
    } 
}

document.addEventListener('DOMContentLoaded', () => {
    const metaId = document.querySelector('meta[name="user-id"]');
    userId = metaId ? metaId.getAttribute('content') : null;

    if (userId) {
        fill_form(userId);
    } else {
        console.error("Usuario no identificado");
    }
});

document.getElementById('form-editar-perfil').addEventListener('submit', async (e) => {
    e.preventDefault();
    
    const data = {
        nombre: document.getElementById('nombre').value,
        apellidos: document.getElementById('apellidos').value,
        fecha_nacimiento: document.getElementById('fecha_nacimiento').value,
        peso_base: document.getElementById('peso_base').value,
        altura_base: document.getElementById('altura_base').value
    };

    try {
        const res = await fetch(`http://localhost:8000/api/ciclista/${userId}`, {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data)
        });
        
        if (res.ok) {
            alert("Perfil actualizado correctamente");
            window.location.href = '/home';
        }
    } catch (error) {
        alert("Error al guardar cambios");
    }
});