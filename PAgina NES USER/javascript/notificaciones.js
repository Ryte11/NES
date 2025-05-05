// Script para manejar las notificaciones
document.addEventListener('DOMContentLoaded', function() {
    // Si el usuario está logueado, cargamos sus notificaciones
    if (window.usuarioLogueado) {
        cargarNotificaciones();
        
        // Configuramos que se recarguen las notificaciones cada 60 segundos
        setInterval(cargarNotificaciones, 60000);
        
        // Configuración del icono de notificaciones
        const notificacionesBtn = document.getElementById('Notificaciones');
        if (notificacionesBtn) {
            notificacionesBtn.addEventListener('click', function(e) {
                e.preventDefault();
                marcarNotificacionesComoLeidas();
            });
        }
        
        // También asignamos evento al botón del menú lateral
        const menuNotificaciones = document.getElementById('menuNotificaciones');
        if (menuNotificaciones) {
            menuNotificaciones.addEventListener('click', function(e) {
                e.preventDefault();
                marcarNotificacionesComoLeidas();
            });
        }
    }
});

// Función para cargar notificaciones desde el servidor
function cargarNotificaciones() {
    fetch('php/obtener_notificaciones.php')
        .then(response => response.json())
        .then(data => {
            actualizarContenedorNotificaciones(data);
            actualizarContadorNotificaciones(data.length);
        })
        .catch(error => console.error('Error al obtener notificaciones:', error));
}

// Función para actualizar el contenedor de notificaciones
function actualizarContenedorNotificaciones(notificaciones) {
    const contenedor = document.querySelector('.notificaciones-container');
    if (!contenedor) return;
    
    // Mantenemos el título "Notificaciones recientes"
    let html = '<p class="recientes">Notificaciones recientes</p>';
    
    // Si no hay notificaciones
    if (notificaciones.length === 0) {
        html += '<div class="sin-notificaciones">No tienes notificaciones nuevas</div>';
        contenedor.innerHTML = html;
        return;
    }
    
    // Mostramos hasta 4 notificaciones recientes
    const maxNotificaciones = Math.min(notificaciones.length, 4);
    
    for (let i = 0; i < maxNotificaciones; i++) {
        const notificacion = notificaciones[i];
        let claseBola = `circulo${i > 0 ? '-' + (i + 1) : ''}`;
        
        html += `
        <div class="noti-${i + 1}" data-id="${notificacion.id}" data-tipo="${notificacion.tipo}" data-datos='${notificacion.datos_adicionales}'>
            <img src="IMG/circle-noti.png" alt="notificacion" class="${claseBola}">
            <p class="p1">${getTipoNotificacion(notificacion.tipo)}</p>
            <p class="p2">${notificacion.mensaje}</p>
        </div>`;
    }
    
    contenedor.innerHTML = html;
    
    // Añadimos eventos a las notificaciones de contacto
    document.querySelectorAll('[data-tipo^="contacto_"]').forEach(element => {
        element.addEventListener('click', function() {
            mostrarDetalleNotificacion(this);
        });
    });
}

// Función para formatear el tipo de notificación para mostrar
function getTipoNotificacion(tipo) {
    switch (tipo) {
        case 'contacto_visto':
            return 'Contacto: Visto';
        case 'contacto_respondido':
            return 'Contacto: Respondido';
        case 'alerta':
            return 'Alerta: Dispositivo';
        default:
            return 'Notificación';
    }
}

// Función para actualizar el contador de notificaciones
function actualizarContadorNotificaciones(cantidad) {
    // Aquí podrías actualizar un badge o indicador visual del número de notificaciones
    // Por ejemplo, si tienes un span con id="notificacion-contador"
    const contadorElement = document.getElementById('notificacion-contador');
    if (contadorElement) {
        contadorElement.textContent = cantidad > 0 ? cantidad : '';
        contadorElement.style.display = cantidad > 0 ? 'block' : 'none';
    }
}

// Función para marcar notificaciones como leídas
function marcarNotificacionesComoLeidas() {
    fetch('php/marcar_notificaciones_leidas.php', {
        method: 'POST'
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log('Notificaciones marcadas como leídas');
        }
    })
    .catch(error => console.error('Error al marcar notificaciones como leídas:', error));
}

// Función para mostrar el detalle de una notificación de contacto
function mostrarDetalleNotificacion(elemento) {
    const tipo = elemento.getAttribute('data-tipo');
    const datos = JSON.parse(elemento.getAttribute('data-datos') || '{}');
    
    if (tipo === 'contacto_respondido' && datos.respuesta) {
        // Crear y mostrar un modal con la respuesta
        mostrarModalRespuesta(datos.respuesta);
    } else if (tipo === 'contacto_visto') {
        // Simplemente mostrar un mensaje de confirmación
        alert('Tu mensaje ha sido revisado por el equipo.');
    }
}

// Función para mostrar un modal con la respuesta
function mostrarModalRespuesta(respuesta) {
    // Comprobamos si existe el modal, si no, lo creamos
    let modal = document.getElementById('modal-container');
    if (!modal) {
        modal = document.createElement('div');
        modal.id = 'modal-container';
        document.body.appendChild(modal);
    }
    
    modal.innerHTML = `
    <div id="modal-content">
        <p class="textocontenet">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" 
                class="circle-fill" viewBox="0 0 16 16" color="green">
                <circle cx="8" cy="8" r="8" />
            </svg>
            Respuesta a tu mensaje: <br/><br/>
            ${respuesta}
        </p>
        <span class="close-btn" onclick="closeModal()"><p>Cerrar</p></span>
    </div>`;
    
    modal.style.display = 'block';
    
    // Definimos la función para cerrar el modal si no existe
    if (typeof closeModal !== 'function') {
        window.closeModal = function() {
            document.getElementById('modal-container').style.display = 'none';
        };
    }
}