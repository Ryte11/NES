// js para filtrar el menu

document.getElementById("menuSearch").addEventListener("input", function () {
    const searchValue = this.value.toLowerCase(); 
    const menuItems = document.querySelectorAll(".menu-item"); 

    menuItems.forEach((item) => {
        const itemText = item.textContent.toLowerCase(); 
        if (itemText.includes(searchValue)) {
            item.style.display = ""; 
        } else {
            item.style.display = "none"; 
        }
    });
});

// js de las notificaciones

const notificacionesButton = document.querySelector('.Notificaciones');
const menuNotificacionesButton = document.querySelector('#menuNotificaciones');
const notificacionesContainer = document.querySelector('.notificaciones-container');

function toggleNotificaciones(event) {
    event.preventDefault(); // Prevenir el comportamiento por defecto del enlace
    notificacionesContainer.classList.toggle('active');
}

notificacionesButton.addEventListener('click', toggleNotificaciones);
menuNotificacionesButton.addEventListener('click', toggleNotificaciones);

document.addEventListener('click', (event) => {
    const isClickInsideNotifications = notificacionesContainer.contains(event.target) || 
                                     notificacionesButton.contains(event.target) ||
                                     menuNotificacionesButton.contains(event.target);
    
    if (!isClickInsideNotifications && notificacionesContainer.classList.contains('active')) {
        notificacionesContainer.classList.remove('active');
    }
});


// cambiar foto y nombre
const perfilButton = document.querySelector('.perfil');
const perfilModal = document.getElementById('perfilModal');
const closePerfilBtn = document.querySelector('.close-perfil');
const cambiarFotoBtn = document.getElementById('cambiarFotoBtn');
const perfilImagen = document.getElementById('perfilImagen');
const perfilPreview = document.getElementById('perfilPreview');
const nombreUsuario = document.getElementById('nombreUsuario');
const guardarPerfilBtn = document.getElementById('guardarPerfil');
const nombreDisplay = document.querySelector('.perfil h2'); 
const perfilImagenDisplay = document.querySelector('.perfil img'); 

/// Función para abrir el modal
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
    }, 300);
}

// Abrir modal
perfilButton.addEventListener('click', openModal);
closePerfilBtn.addEventListener('click', closeModalWithAnimation);
window.addEventListener('click', (e) => {
    if (e.target === perfilModal) {
        closeModalWithAnimation();
    }
});

// Modificar el evento de guardar para incluir la animación
guardarPerfilBtn.addEventListener('click', () => {
    nombreDisplay.textContent = nombreUsuario.value;
    
    if (perfilPreview.src) {
        perfilImagenDisplay.src = perfilPreview.src;
    }
    
    closeModalWithAnimation();
    setTimeout(() => {
        alert('Cambios guardados correctamente');
    }, 300);
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
guardarPerfilBtn.addEventListener('click', () => {

    nombreDisplay.textContent = nombreUsuario.value;
    
    if (perfilPreview.src) {
        perfilImagenDisplay.src = perfilPreview.src;
    }
    
    perfilModal.style.display = 'none';
    
    alert('Cambios guardados correctamente');
});




// funcionalidad de apartado de usuario y form
        document.querySelector('.add-button').addEventListener('click', function() {
            console.log('Agregar nuevo usuario');
        });

        document.querySelectorAll('.more-options').forEach(button => {
            button.addEventListener('click', function() {
                console.log('Mostrar opciones');
            });
        });



// funcion para el modal de agregar usuarios

        const modal = document.getElementById('userModal');
        const addButton = document.querySelector('.add-button');
        
        addButton.addEventListener('click', () => {
            modal.style.display = 'block';
        });

        // Cerrar modal al hacer clic fuera
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.style.display = 'none';
            }
        });

        // Validación del formulario
        const userForm = document.getElementById('userForm');
        const inputs = {
            usuario: document.getElementById('usuario'),
            email: document.getElementById('email'),
            password: document.getElementById('password')
        };

        const errors = {
            usuario: document.getElementById('usuarioError'),
            email: document.getElementById('emailError'),
            password: document.getElementById('passwordError')
        };

        function validateForm(e) {
            e.preventDefault();
            let isValid = true;
        
            // Validaciones
            if (inputs.usuario.value.length < 3) {
                errors.usuario.style.display = 'block';
                isValid = false;
            } else {
                errors.usuario.style.display = 'none';
            }
        
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(inputs.email.value)) {
                errors.email.style.display = 'block';
                isValid = false;
            } else {
                errors.email.style.display = 'none';
            }
        
            if (inputs.password.value.length < 6) {
                errors.password.style.display = 'block';
                isValid = false;
            } else {
                errors.password.style.display = 'none';
            }
        
            if (isValid) {
                const formData = new FormData();
                formData.append('nombre', inputs.usuario.value);
                formData.append('email', inputs.email.value);
                formData.append('password', inputs.password.value);
        
                fetch('./php/user.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Usuario creado correctamente');
                        modal.style.display = 'none';
                        userForm.reset();
                        // Aquí podrías actualizar la tabla de usuarios
                    } else {
                        alert('Error: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al crear el usuario');
                });
            }
        }
        
        // Asegúrate de agregar el event listener
        userForm.addEventListener('submit', validateForm);

        


// submenu 3 puntos
 document.addEventListener("DOMContentLoaded", () => {
            // Seleccionar todos los botones de opciones
            const moreOptionsButtons = document.querySelectorAll(".more-options");

            moreOptionsButtons.forEach(button => {
                button.addEventListener("click", (event) => {
                    // Ocultar cualquier otro menú abierto
                    document.querySelectorAll(".show-menu").forEach(el => {
                        if (el !== button.parentNode) {
                            el.classList.remove("show-menu");
                        }
                    });

                    // Alternar el submenú
                    button.parentNode.classList.toggle("show-menu");
                });
            });

            // Cerrar menú al hacer clic fuera
            document.addEventListener("click", (event) => {
                if (!event.target.closest(".more-options") && !event.target.closest(".options-menu")) {
                    document.querySelectorAll(".show-menu").forEach(el => el.classList.remove("show-menu"));
                }
            });
        });