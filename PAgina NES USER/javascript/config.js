// Funciones para el modal de configuración
function openConfigModal() {
    const modal = document.getElementById('configModal');
    modal.style.display = 'block';
    
    // Cargar datos actuales del usuario
    fetch('php/obtener_usuario.php')
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert('Debes iniciar sesión para acceder a esta función');
                window.location.href = 'index.html';
                return;
            }
            
            document.getElementById('configNombre').value = data.nombre || '';
            document.getElementById('configEmail').value = data.email || '';
        })
        .catch(error => {
            console.error('Error al cargar datos del usuario:', error);
            alert('Error al cargar datos. Verifica tu conexión o inicia sesión nuevamente.');
        });
}

function closeConfigModal() {
    document.getElementById('configModal').style.display = 'none';
}

function saveConfig(event) {
    event.preventDefault();
    
    const formData = new FormData(document.getElementById('configForm'));
    
    fetch('php/actualizar_usuario.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            alert('Datos actualizados correctamente');
            closeConfigModal();
        } else {
            alert('Error al actualizar los datos: ' + (data.message || 'Error desconocido'));
        }
    })
    .catch(error => {
        console.error('Error al actualizar datos:', error);
        alert('Error al procesar la solicitud. Verifica tu conexión.');
    });
    
    return false;
}

function cerrarSesion() {
    fetch('php/cerrar_sesion.php')
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                window.location.href = 'index.html';
            }
        })
        .catch(error => {
            console.error('Error al cerrar sesión:', error);
            window.location.href = 'index.html'; // Redirigir de todos modos
        });
}

// Cerrar el modal si se hace clic fuera de él
window.onclick = function(event) {
    const modal = document.getElementById('configModal');
    if (event.target == modal) {
        modal.style.display = 'none';
    }
}