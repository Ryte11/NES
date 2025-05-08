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
