// Función para manejar el icono de configuración
document.addEventListener('DOMContentLoaded', function() {
    // Agregar el evento al ícono de configuración si existe
    const configIcon = document.querySelector('.iconoconfiguracion');
    if (configIcon) {
        configIcon.addEventListener('click', function() {
            if (window.usuarioLogueado) {
                openConfigModal();
            } else {
                alert('Debes iniciar sesión para acceder a esta función');
                window.location.href = 'index.html';
            }
        });
    }
    
    // Mostrar indicador de sesión si hay un usuario logueado
    if (window.usuarioLogueado && window.nombreUsuario) {
        // Si existe un elemento para mostrar el nombre del usuario, actualizarlo
        const userNameDisplay = document.getElementById('userNameDisplay');
        if (userNameDisplay) {
            userNameDisplay.textContent = window.nombreUsuario;
        }
        
        // Actualizar iconos o elementos visuales que indiquen sesión activa
        const configIcons = document.querySelectorAll('.iconoconfiguracion');
        configIcons.forEach(icon => {
            icon.classList.add('active-session');
        });
    }
});