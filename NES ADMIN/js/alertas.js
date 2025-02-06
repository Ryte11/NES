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






// js de guia de usuario

let currentSlide = 1;
const totalSlides = 2;

function toggleGuide() {
    const guide = document.getElementById('guide');
    
    if (guide.style.display === 'none' || !guide.style.display) {
        const overlay = document.createElement('div');
        overlay.id = 'guide-overlay';
        overlay.className = 'overlay';
        document.body.appendChild(overlay);

        guide.style.display = 'block';
        guide.classList.add('modal-container');
    } else {

        const overlay = document.getElementById('guide-overlay');
        if (overlay) {
            overlay.remove();
        }
        

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
    }, 300); 
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





// Datos de ejemplo
const sistemasData = [
    {
        id: 1,
        nombre: "Manuel Alejandro",
        codigo: "123-4567891-1",
        ubicacion: "Santo Domingo ESTE",
        tipo: "Ruidos Por Parlantes",
        fecha: "13/2/2024",
        direccion: "La caleta, boca chica ITLA",
        email: "Luisangelgamer@gmail.com"
    },
    {
        id: 2,
        nombre: "Luis Martínez",
        codigo: "987-6543210-2",
        ubicacion: "Santiago",
        tipo: "Fallo de Equipo",
        fecha: "17/1/2025",
        direccion: "Calle 12, sector El Sol",
        email: "luis.martinez@email.com"
    },
    {
        id: 3,
        nombre: "Pedro Gómez",
        codigo: "456-1234567-3",
        ubicacion: "Punta Cana",
        tipo: "Falla en la red",
        fecha: "18/1/2025",
        direccion: "Av. Principal #45",
        email: "pedro.gomez@email.com"
    },
    {
        id: 4,
        nombre: "Carla Rodríguez",
        codigo: "987-6543210-4",
        ubicacion: "San Francisco de Macorís",
        tipo: "Error de Sistema",
        fecha: "19/1/2025",
        direccion: "Calle 3, sector Las Vegas",
        email: "carla.rodriguez@email.com"
    },
    {
        id: 5,
        nombre: "María López",
        codigo: "654-3210987-5",
        ubicacion: "Moca",
        tipo: "Fallo de conexión",
        fecha: "20/1/2025",
        direccion: "Calle 8, sector El Faro",
        email: "maria.lopez@email.com"
    },
    {
        id: 6,
        nombre: "José Fernández",
        codigo: "789-1234567-6",
        ubicacion: "La Vega",
        tipo: "Fallo de Equipo",
        fecha: "21/1/2025",
        direccion: "Calle 6, sector Villa Hermosa",
        email: "jose.fernandez@email.com"
    },
    {
        id: 7,
        nombre: "Ana Sánchez",
        codigo: "321-6549877-7",
        ubicacion: "San Pedro de Macorís",
        tipo: "Falla en la red",
        fecha: "22/1/2025",
        direccion: "Calle 9, sector El Progreso",
        email: "ana.sanchez@email.com"
    },
    {
        id: 8,
        nombre: "Ricardo Pérez",
        codigo: "987-3216549-8",
        ubicacion: "Higuey",
        tipo: "Error de Sistema",
        fecha: "23/1/2025",
        direccion: "Calle 2, sector El Valle",
        email: "ricardo.perez@email.com"
    },
    {
        id: 9,
        nombre: "Julio Díaz",
        codigo: "456-9876540-9",
        ubicacion: "Puerto Plata",
        tipo: "Ruidos Por Parlantes",
        fecha: "24/1/2025",
        direccion: "Calle 5, sector El Cortecito",
        email: "julio.diaz@email.com"
    }
];

const dispositivosData = [
    {
        id: 10,
        nombre: "Carlos Rodriguez",
        codigo: "456-7891234-2",
        ubicacion: "Santiago",
        tipo: "Fallo de Equipo",
        fecha: "14/2/2024",
        direccion: "Calle Principal #123",
        email: "carlos.rodriguez@email.com"
    },
    {
        id: 11,
        nombre: "María López",
        codigo: "789-1234567-3",
        ubicacion: "La Romana",
        tipo: "Error de Sistema",
        fecha: "15/2/2024",
        direccion: "Calle Segunda #78",
        email: "maria.lopez@email.com"
    }
];

// Variable global para mantener el conjunto de datos actual
let currentData = sistemasData;

// Función para crear una fila de la tabla
function createTableRow(data, index) {
    return `
        <tr class="data-row">
            <td>
                <div class="alert-item">
                    <div class="alert-icon">i</div>
                    <div class="alert-info">
                        <div>${data.nombre}</div>
                        <div class="code">${data.codigo}</div>
                    </div>
                </div>
            </td>
            <td>${data.ubicacion}</td>
            <td><span class="tag">${data.tipo}</span></td>
            <td>
                <button class="view-btn" onclick="toggleDetails(${index})">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                        <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                    </svg>
                    Vista
                </button>
            </td>
            <td><button class="more-btn" data-tooltip="Más opciones">...</button></td>
        </tr>
        <tr class="expandable-content" data-content="${index}">
            <td colspan="5">
                <div class="info-grid">
                    <div class="info-item">
                        <i>📅</i>
                        <span>${data.fecha}</span>
                    </div>
                    <div class="info-item">
                        <i>📍</i>
                        <span>${data.direccion}</span>
                    </div>
                    <div class="info-item">
                        <i>✉️</i>
                        <span>${data.email}</span>
                    </div>
                </div>
                <div class="case-description">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut laborum...</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut laborum...</p>
                </div>
                <button class="view-case-btn" onclick="document.getElementById('caseModal').classList.add('active'); loadSavedStatus();">Ver caso</button>
            </td>
        </tr>
    `;
}





// Función para actualizar la tabla
function updateTable(data) {
    const tbody = document.getElementById('tabla-contenido');
    tbody.innerHTML = '';
    data.forEach((item, index) => {
        tbody.innerHTML += createTableRow(item, index);
    });
}

// Función para filtrar los datos
function filterData(searchTerm) {
    if (!searchTerm || searchTerm.trim() === '') {
        return currentData;
    }
    searchTerm = searchTerm.toLowerCase().trim();
    return currentData.filter(item => {
        const nombre = item.nombre.toLowerCase();
        return nombre.startsWith(searchTerm);
    });
}

// Función para alternar detalles
function toggleDetails(rowIndex) {
    const allDetails = document.querySelectorAll('.expandable-content');
    allDetails.forEach(detail => {
        if (parseInt(detail.dataset.content) !== rowIndex) {
            detail.classList.remove('active');
        }
    });

    const detailRow = document.querySelector(`.expandable-content[data-content="${rowIndex}"]`);
    if (detailRow) {
        detailRow.classList.toggle('active');
    }
}

// Inicialización y configuración de eventos
document.addEventListener('DOMContentLoaded', () => {
        updateTable(currentData);

    // Configurar el buscador
    const searchInput = document.getElementById('searchInput');
    searchInput.addEventListener('input', (e) => {
        const filteredData = filterData(e.target.value);
        updateTable(filteredData);
    });

    // Configurar botones de cambio
    document.getElementById('sistemas-btn').addEventListener('click', function() {
        document.querySelectorAll('.switch-btn').forEach(btn => btn.classList.remove('active'));
        this.classList.add('active');
        currentData = sistemasData;
        searchInput.value = '';
        updateTable(currentData);
    });

    document.getElementById('dispositivos-btn').addEventListener('click', function() {
        document.querySelectorAll('.switch-btn').forEach(btn => btn.classList.remove('active'));
        this.classList.add('active');
        currentData = dispositivosData;
        searchInput.value = '';
        updateTable(currentData);
    });
});

// Estilos para el botón de más opciones
const style = document.createElement('style');
style.textContent = `
    .more-btn {
        position: relative;
        cursor: pointer;
    }

    .more-btn::before {
        content: attr(data-tooltip);
        position: absolute;
        bottom: 100%;
        left: 50%;
        transform: translateX(-50%);
        padding: 5px 10px;
        background-color: #333;
        color: white;
        font-size: 12px;
        border-radius: 4px;
        white-space: nowrap;
        visibility: hidden;
        opacity: 0;
        transition: opacity 0.2s ease-in-out;
    }

    .more-btn:hover::before {
        visibility: visible;
        opacity: 1;
    }
`;
document.head.appendChild(style);





// Add this script to handle the form submission
document.querySelector('.Enviar').addEventListener('click', function() {
    // Get all the case information
    const caseData = {
        caseNumber: document.querySelector('.case-title').textContent,
        reportedBy: document.querySelector('.case-subtitle').textContent,
        status: document.querySelector('.status-badge').textContent,
        reportDate: document.querySelector('.info-card:nth-child(1) .info-card-value').textContent,
        location: document.querySelector('.info-card:nth-child(2) .info-card-value').textContent,
        complaintType: document.querySelector('.info-card:nth-child(3) .info-card-value').textContent,
        code: document.querySelector('.info-card:nth-child(4) .info-card-value').textContent,
        description: document.querySelector('.case-description1 p').textContent,
        comment: document.querySelector('.comment-input').value
    };

    // Send data to PHP script using fetch
    fetch('save_case.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(caseData)
    })
    .then(response => response.text())
    .then(data => {
        alert('Caso guardado exitosamente');
    })
    .catch((error) => {
        console.error('Error:', error);
        alert('Error al guardar el caso');
    });
});