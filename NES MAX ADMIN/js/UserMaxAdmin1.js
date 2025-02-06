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





const modal = document.getElementById('userModal');

function showModal() {
    modal.style.display = 'block';
    setTimeout(() => {
        modal.classList.add('show');
    }, 10);
}

function hideModal() {
    modal.classList.remove('show');
    setTimeout(() => {
        modal.style.display = 'none';
    }, 300);
}

// cerrer el sicario modal al tocar fuera
window.onclick = function(event) {
    if (event.target === modal) {
        hideModal();
    }
}

const adminForm = document.getElementById('adminForm');
const inputs = {
    usuario: document.getElementById('usuario'),
    email: document.getElementById('email'),
    cedula: document.getElementById('cedula'),
    password: document.getElementById('password'),
    telefono: document.getElementById('telefono'),
    confirmPassword: document.getElementById('confirmPassword')
};

const errors = {
    usuario: document.getElementById('usuarioError'),
    email: document.getElementById('emailError'),
    cedula: document.getElementById('cedulaError'),
    password: document.getElementById('passwordError'),
    telefono: document.getElementById('telefonoError'),
    confirmPassword: document.getElementById('confirmPasswordError')
};

function validateForm(e) {
    e.preventDefault();
    let isValid = true;

    // Reset all error messages
    Object.values(errors).forEach(error => error.style.display = 'none');

    // Validaciones
    if (inputs.usuario.value.length < 3) {
        errors.usuario.textContent = 'El usuario debe tener al menos 3 caracteres';
        errors.usuario.style.display = 'block';
        isValid = false;
    }

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(inputs.email.value)) {
        errors.email.textContent = 'Por favor ingrese un correo electrónico válido';
        errors.email.style.display = 'block';
        isValid = false;
    }

    if (inputs.password.value.length < 6) {
        errors.password.textContent = 'La contraseña debe tener al menos 6 caracteres';
        errors.password.style.display = 'block';
        isValid = false;
    }

    if (inputs.password.value !== inputs.confirmPassword.value) {
        errors.confirmPassword.textContent = 'Las contraseñas no coinciden';
        errors.confirmPassword.style.display = 'block';
        isValid = false;
    }

    if (isValid) {
        const formData = new FormData();
        formData.append('nombre', inputs.usuario.value);
        formData.append('email', inputs.email.value);
        formData.append('password', inputs.password.value);

        // Debug: Mostrar los datos que se están enviando
        console.log('Datos a enviar:');
        for (let pair of formData.entries()) {
            console.log(pair[0] + ': ' + pair[1]);
        }

        fetch('./php/usermax.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`Error del servidor: ${response.status}`);
            }
            return response.text().then(text => {
                // Debug: ver la respuesta exacta del servidor
                console.log('Respuesta del servidor:', text);
                try {
                    return JSON.parse(text);
                } catch (e) {
                    console.error('Error al parsear JSON:', text);
                    throw new Error('La respuesta del servidor no es JSON válido');
                }
            });
        })
        .then(data => {
            console.log('Respuesta procesada:', data); // Debug
            if (data.success) {
                alert('Usuario creado correctamente');
                adminForm.reset();
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al crear el usuario: ' + error.message);
        });
    }
}

// Add form submit event listener
adminForm.addEventListener('submit', validateForm);

// Optional: Add input event listeners to clear errors when user starts typing
Object.entries(inputs).forEach(([key, input]) => {
    input.addEventListener('input', () => {
        errors[key].style.display = 'none';
    });
});

document.getElementById('cedula').addEventListener('input', function(e) {
    this.value = this.value.replace(/[^0-9]/g, '').slice(0, 11);
});

document.getElementById('telefono').addEventListener('input', function(e) {
    this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);
});




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