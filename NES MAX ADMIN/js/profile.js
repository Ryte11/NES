// Este archivo debe guardarse como profile.js

document.addEventListener('DOMContentLoaded', function() {
    // Seleccionar elementos
    const perfilButton = document.querySelector('.perfil');
    const perfilModal = document.getElementById('perfilModal');
    const closePerfilBtn = document.querySelector('.close-perfil');
    const cambiarFotoBtn = document.getElementById('cambiarFotoBtn');
    const perfilImagen = document.getElementById('perfilImagen');
    const perfilPreview = document.getElementById('perfilPreview');
    const nombreUsuario = document.getElementById('nombreUsuario');
    const guardarPerfilBtn = document.getElementById('guardarPerfil');
    const nombreDisplay = document.querySelector('.perfil h2'); // El h2 que muestra el nombre
    const perfilImagenDisplay = document.querySelector('.perfil img'); // La imagen del perfil en el header

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
                    // Actualizar los campos con los datos del usuario
                    nombreUsuario.value = data.data.nombre;
                    nombreDisplay.textContent = data.data.nombre;
                    
                    // Actualizar imagen de perfil
                    const imagenUrl = `uploads/profile/${data.data.imagen_perfil}`;
                    perfilPreview.src = imagenUrl;
                    perfilImagenDisplay.src = imagenUrl;
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
        const formData = new FormData();
        formData.append('nombre', nombreUsuario.value);
        
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
                    perfilImagenDisplay.src = nuevaImagenUrl;
                }
                
                // Cerrar modal con animación
                closeModalWithAnimation();
                
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

    // Abrir modal
    perfilButton.addEventListener('click', openModal);

    // Cerrar modal
    closePerfilBtn.addEventListener('click', closeModalWithAnimation);

    // Cerrar modal al hacer clic fuera
    window.addEventListener('click', (e) => {
        if (e.target === perfilModal) {
            closeModalWithAnimation();
        }
    });

    // Activar input de archivo al hacer clic en el botón de cambiar foto
    cambiarFotoBtn.addEventListener('click', () => {
        perfilImagen.click();
    });

    // Previsualizar imagen seleccionada
    perfilImagen.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                perfilPreview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });

    // Guardar cambios
    guardarPerfilBtn.addEventListener('click', guardarCambiosPerfil);
});