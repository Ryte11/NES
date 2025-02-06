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

        const ctx = document.getElementById('myChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [33.33, 33.33, 33.33],
                    backgroundColor: [
                        '#4B0082',
                        '#00BCD4',
                        '#FF4444'
                    ],
                    borderWidth: 0,
                    cutout: '80%'
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    }
                },
                responsive: true,
                maintainAspectRatio: true
            }
        });

// js segundo grafico
 const ctx2 = document.getElementById('denunciasChart').getContext('2d');
        new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'],
                datasets: [
                    {
                        label: 'M',
                        data: [35, 33, 29, 25, 23, 25, 25],
                        backgroundColor: '#000080',
                        barPercentage: 0.8,
                        categoryPercentage: 0.7
                    },
                    {
                        label: 'F',
                        data: [28, 30, 27, 15, 15, 25, 15],
                        backgroundColor: '#00BCD4',
                        barPercentage: 0.8,
                        categoryPercentage: 0.7
                    }
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
                        max: 50,
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
    }, 300); // Este tiempo debe coincidir con la duración de la animación
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

// Modificar el evento de guardar para incluir la animación
guardarPerfilBtn.addEventListener('click', () => {
    // Actualizar nombre
    nombreDisplay.textContent = nombreUsuario.value;
    
    // Actualizar imagen
    if (perfilPreview.src) {
        perfilImagenDisplay.src = perfilPreview.src;
    }
    
    // Cerrar modal con animación
    closeModalWithAnimation();
    
    // Opcional: Mostrar mensaje de éxito
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
    // Actualizar nombre
    nombreDisplay.textContent = nombreUsuario.value;
    
    // Actualizar imagen
    if (perfilPreview.src) {
        perfilImagenDisplay.src = perfilPreview.src;
    }
    
    // Cerrar modal
    perfilModal.style.display = 'none';
    
    // Opcional: Mostrar mensaje de éxito
    alert('Cambios guardados correctamente');
});