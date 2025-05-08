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

// js del primer grafico

      

// js segundo grafico
 const ctx2 = document.getElementById('denunciasChart').getContext('2d');
        new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'],
                datasets: [
                    {
                        label: 'Denuncias',
                        data: [1, 0, 0, 2, 1, 0, 0],
                        backgroundColor: '#000080',
                        barPercentage: 0.8,
                        categoryPercentage: 0.7
                    },
                    {
                        label: 'Dispositivos',
                        data: [0, 0, 18, 0, 0, 0, 0],
                        backgroundColor: '#00BCD4',
                        barPercentage: 0.8,
                        categoryPercentage: 0.7
                    },
                   
                    
                    
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 30,
                        ticks: {
                            stepSize: 5,
                            font: {
                                size: 11
                            }
                        },
                        grid: {
                            color: '#e5e5e5',
                            drawBorder: false
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                size: 11
                            }
                        }
                    }
                }
            }
        });



// js de guia de usuario

// JavaScript
let currentSlide = 1;
const totalSlides = 2;

function toggleGuide() {
    const guide = document.getElementById('guide');
    
    if (guide.style.display === 'none' || !guide.style.display) {
        // Crear y mostrar el overlay
        const overlay = document.createElement('div');
        overlay.id = 'guide-overlay';
        overlay.className = 'overlay';
        document.body.appendChild(overlay);
        
        // Mostrar y posicionar la guía
        guide.style.display = 'block';
        guide.classList.add('modal-container');
    } else {
        // Eliminar el overlay
        const overlay = document.getElementById('guide-overlay');
        if (overlay) {
            overlay.remove();
        }
        
        // Ocultar la guía
        guide.style.display = 'none';
        guide.classList.remove('modal-container');
    }
}

function showNext() {
    document.getElementById(`slide${currentSlide}`).classList.add('hidden');
    currentSlide = currentSlide === totalSlides ? 1 : currentSlide + 1;
    document.getElementById(`slide${currentSlide}`).classList.remove('hidden');
}

function showPrevious() {
    document.getElementById(`slide${currentSlide}`).classList.add('hidden');
    currentSlide = currentSlide === 1 ? totalSlides : currentSlide - 1;
    document.getElementById(`slide${currentSlide}`).classList.remove('hidden');
}



// cambiar foto y nombre
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