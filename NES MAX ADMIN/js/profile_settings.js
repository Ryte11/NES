document.addEventListener('DOMContentLoaded', function() {
    // Seleccionar elementos del perfil modal
    const perfilButton = document.querySelector('.perfil');
    const perfilModal = document.getElementById('perfilModal');
    const closePerfilBtn = document.querySelector('.close-perfil');
    
    // Elementos comunes entre modal y sección inline
    const cambiarFotoBtn = document.getElementById('cambiarFotoBtn');
    const perfilImagen = document.getElementById('perfilImagen');
    const perfilPreview = document.getElementById('perfilPreview');
    const nombreUsuario = document.getElementById('nombreUsuario');
    const nombreDisplay = document.querySelector('.perfil h2'); // El h2 que muestra el nombre
    const perfilImagenDisplay = document.querySelector('.perfil img'); // La imagen del perfil en el header
    
    // Botones de guardar (uno para el modal y otro para la sección inline)
    const guardarPerfilBtn = document.getElementById('guardarPerfil');
    const guardarPerfilInlineBtn = document.getElementById('guardarPerfilInline');

    // Cargar datos del perfil al iniciar
    cargarPerfilUsuario();

    // Función para abrir el modal
    function openModal() {
        perfilModal.style.display = 'block';
        perfilModal.classList.remove('closing');
    }

    // Función para cerrar el modal con animación
    function closeModalWithAnimation() {
        perfilModal.classList.add('closing');
        setTimeout(() => {
            perfilModal.style.display = 'none';
            perfilModal.classList.remove('closing');
        }, 300); // Este tiempo debe coincidir con la duración de la animación
    }

    // Función para cargar datos del perfil del usuario
    function cargarPerfilUsuario() {
        fetch('php/get_user_profile.php')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Actualizar los campos con los datos del usuario en ambos lugares
                    const nombreInputs = document.querySelectorAll('#nombreUsuario');
                    nombreInputs.forEach(input => input.value = data.data.nombre);
                    
                    nombreDisplay.textContent = data.data.nombre;
                    
                    // Actualizar imagen de perfil en ambos lugares
                    const imagenUrl = `uploads/profile/${data.data.imagen_perfil}`;
                    const perfilPreviews = document.querySelectorAll('#perfilPreview');
                    perfilPreviews.forEach(preview => preview.src = imagenUrl);
                    
                    perfilImagenDisplay.src = imagenUrl;
                    
                    // Si hay campo de email, actualizarlo también
                    const emailInput = document.getElementById('emailUsuario');
                    if (emailInput && data.data.email) {
                        emailInput.value = data.data.email;
                    }
                } else {
                    console.error('Error al cargar perfil:', data.message);
                }
            })
            .catch(error => {
                console.error('Error en la solicitud:', error);
            });
    }

    // Función para guardar cambios en el perfil
    function guardarCambiosPerfil() {
        // Determinar qué campo de nombre usar (el del modal o el de la sección inline)
        const nombreValue = document.activeElement.closest('.perfil-form')?.querySelector('#nombreUsuario')?.value || nombreUsuario.value;
        
        const formData = new FormData();
        formData.append('nombre', nombreValue);
        
        // Agregar email si existe el campo
        const emailInput = document.getElementById('emailUsuario');
        if (emailInput) {
            formData.append('email', emailInput.value);
        }
        
        // Agregar imagen si se seleccionó una nueva
        if (perfilImagen.files.length > 0) {
            formData.append('imagen', perfilImagen.files[0]);
        }

        fetch('php/update_profile.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Actualizar la interfaz con los nuevos datos
                nombreDisplay.textContent = data.data.nombre;
                
                if (data.data.imagen_perfil) {
                    const nuevaImagenUrl = `uploads/profile/${data.data.imagen_perfil}`;
                    const perfilPreviews = document.querySelectorAll('#perfilPreview');
                    perfilPreviews.forEach(preview => preview.src = nuevaImagenUrl);
                    perfilImagenDisplay.src = nuevaImagenUrl;
                }
                
                // Si se activó desde el modal, cerrarlo
                if (perfilModal.style.display === 'block') {
                    closeModalWithAnimation();
                }
                
                // Mostrar mensaje de éxito
                setTimeout(() => {
                    alert('Cambios guardados correctamente');
                }, 300);
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error en la solicitud:', error);
            alert('Error al guardar los cambios');
        });
    }

    // Event listeners para el modal (mantener la funcionalidad existente)
    if (perfilButton) {
        perfilButton.addEventListener('click', openModal);
    }
    
    if (closePerfilBtn) {
        closePerfilBtn.addEventListener('click', closeModalWithAnimation);
    }

    // Cerrar modal al hacer clic fuera
    window.addEventListener('click', (e) => {
        if (e.target === perfilModal) {
            closeModalWithAnimation();
        }
    });

    // Manejar la subida de imágenes (para ambos lugares)
    const cambiarFotoBtns = document.querySelectorAll('#cambiarFotoBtn');
    cambiarFotoBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            perfilImagen.click();
        });
    });

    // Previsualizar imagen seleccionada en ambos lugares
    if (perfilImagen) {
        perfilImagen.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const perfilPreviews = document.querySelectorAll('#perfilPreview');
                    perfilPreviews.forEach(preview => preview.src = e.target.result);
                };
                reader.readAsDataURL(file);
            }
        });
    }

    // Asignar evento guardar al botón del modal
    if (guardarPerfilBtn) {
        guardarPerfilBtn.addEventListener('click', guardarCambiosPerfil);
    }
    
    // Asignar evento guardar al botón de la sección inline
    if (guardarPerfilInlineBtn) {
        guardarPerfilInlineBtn.addEventListener('click', guardarCambiosPerfil);
    }
});