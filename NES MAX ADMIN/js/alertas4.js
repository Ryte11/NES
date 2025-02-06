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



let currentData = []; // Datos actuales mostrados en la tabla

// Función para inicializar datos preexistentes

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
                    <p>${data.descripcion || "No hay descripción disponible."}</p>
                </div>
                <button class="view-case-btn" onclick="openModal(${index})">Ver caso</button>
            </td>
        </tr>
    `;
}
// funcion view




// Función para renderizar la tabla
function renderTable() {
    const tableBody = document.getElementById("tabla-contenido");
    tableBody.innerHTML = ""; // Limpiar tabla
    currentData.forEach((data, index) => {
        tableBody.innerHTML += createTableRow(data, index);
    });
}

// Función para manejar la expansión de filas
function toggleDetails(index) {
    const contentRowById = document.getElementById(`content-${index}`);
    const contentRowsByData = document.querySelectorAll(`[data-content="${index}"]`);
    
    if (contentRowById) {
        contentRowById.style.display = contentRowById.style.display === "none" || !contentRowById.style.display ? "table-row" : "none";
    } else if (contentRowsByData.length > 0) {
        contentRowsByData.forEach(row => {
            row.style.display = row.style.display === "none" || !row.style.display ? "table-row" : "none";
        });
    } else {
        console.error(`No se encontró contenido expandible para el índice ${index}`);
    }
}

document.addEventListener("DOMContentLoaded", () => {
});


function openModal(index) {
    const modal = document.getElementById("caseModal");
    if (!modal) {
        console.error("Modal no encontrado");
        return;
    }

    let caseData;
    if (sistemasBtn.classList.contains('active')) {
        caseData = serverData[index];
    } else {
        caseData = dispositivosData2[index];
    }

    if (!caseData) {
        console.error("Datos del caso no encontrados");
        return;
    }

    modal.querySelector(".case-title").textContent = `Caso ${caseData.codigo}`;
    modal.querySelector(".case-subtitle").textContent = `Reportado por ${caseData.nombre}`;
    
    const infoValues = modal.querySelectorAll(".info-card-value");
    infoValues[0].textContent = caseData.fecha;
    infoValues[1].textContent = caseData.ubicacion;
    infoValues[2].textContent = caseData.tipo;
    infoValues[3].textContent = caseData.codigo;

    modal.classList.add("active");

    loadSavedStatus();
}

// Función para cerrar el modal
document.querySelector('.close-modal').addEventListener('click', function() {
    document.getElementById('caseModal').classList.remove('active');
});

window.addEventListener('click', function(event) {
    const modal = document.getElementById('caseModal');
    if (event.target === modal) {
        modal.classList.remove('active');
    }
});

// Función para agregar nuevos datos desde un formulario
function addNewData(formData) {
    const newEntry = {
        id: currentData.length + 1,
        nombre: formData.get("nombre"),
        codigo: `COD-${Date.now()}`, 
        ubicacion: formData.get("ubicacion"),
        tipo: formData.get("tipo"),
        fecha: new Date().toLocaleDateString(),
        direccion: formData.get("direccion"),
        email: formData.get("email"),
        descripcion: formData.get("descripcion"),
    };

    currentData.push(newEntry); 
    renderTable(); 
}
document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("denunciaForm");
    if (form) {
        form.addEventListener("submit", function (e) {
            e.preventDefault();
            const formData = new FormData(e.target);
            addNewData(formData);
            e.target.reset();
        });
    } else {
        console.error('Formulario con id "form" no encontrado.');
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const formulario = document.getElementById("denunciaForm");

    if (formulario) {
        formulario.addEventListener("submit", function (e) {
            e.preventDefault(); // Prevenir envío por defecto
            const formData = new FormData(e.target);
            addNewData(formData);
            e.target.reset(); // Reiniciar formulario
        });
    } else {
        console.error("Formulario no encontrado. Verifica la ruta y el ID.");
    }
});



// Get the search input element
const searchInput = document.getElementById('searchInput');

// Function to filter table rows
function filterTable() {
    const rows = document.querySelectorAll('.data-row');
    const searchTerm = searchInput.value.toLowerCase();

    rows.forEach(row => {
        const nameElement = row.querySelector('.alert-info div:first-child');
        const name = nameElement ? nameElement.textContent.toLowerCase() : '';
        
        const expandableRow = row.nextElementSibling;
        
        if (name.includes(searchTerm)) {
            // Show matching rows
            row.style.display = '';
            if (expandableRow && expandableRow.classList.contains('expandable-content')) {
                // Keep expanded state if it was expanded
                expandableRow.style.display = expandableRow.style.display === 'table-row' ? 'table-row' : 'none';
            }
        } else {
            // Hide non-matching rows
            row.style.display = 'none';
            if (expandableRow && expandableRow.classList.contains('expandable-content')) {
                expandableRow.style.display = 'none';
            }
        }
    });
}

// Add event listener for input changes
searchInput.addEventListener('input', filterTable);


// Datos de ejemplo
const sistemasData2 = [
    {
        id: 1,
        nombre: "NES LFT213",
        codigo: "123-4567891-1",
        ubicacion: "Santo Domingo ESTE",
        tipo: "Ruidos Por Parlantes",
        fecha: "13/2/2024",
        direccion: "La caleta, boca chica ITLA",
        email: "Luisangelgamer@gmail.com"
    },
    
];


const dispositivosData2 = [
    {
        id: 10,
        nombre: "NES-T500 Ultra",
        codigo: "456-7891234-2",
        ubicacion: "Santiago",
        tipo: "Vibraciones excesivas en horario nocturno",
        fecha: "14/2/2024",
        direccion: "Calle Principal #123"
    },
    {
        id: 11,
        nombre: "NES-R750 Elite",
        codigo: "789-1234567-3",
        ubicacion: "La Romana",
        tipo: "Picos de ruido superiores a 95dB",
        fecha: "15/2/2024",
        direccion: "Calle Segunda #78"
    },
    {
        id: 2,
        nombre: "NES-M200 Plus",
        codigo: "987-6543210-2",
        ubicacion: "Santiago",
        tipo: "Ruido constante sobre 75dB",
        fecha: "17/1/2025",
        direccion: "Calle 12, sector El Sol"
    },
    {
        id: 3,
        nombre: "NES-P300 Advanced",
        codigo: "456-1234567-3",
        ubicacion: "Punta Cana",
        tipo: "Contaminación sonora nocturna",
        fecha: "18/1/2025",
        direccion: "Av. Principal #45"
    },
    {
        id: 4,
        nombre: "NES-C400 Premium",
        codigo: "987-6543210-4",
        ubicacion: "San Francisco de Macorís",
        tipo: "Reverberación excesiva en zona residencial",
        fecha: "19/1/2025",
        direccion: "Calle 3, sector Las Vegas"
    },
    {
        id: 5,
        nombre: "NES-L600 Smart",
        codigo: "654-3210987-5",
        ubicacion: "Moca",
        tipo: "Frecuencias graves perturbadoras",
        fecha: "20/1/2025",
        direccion: "Calle 8, sector El Faro"
    },
    {
        id: 6,
        nombre: "NES-F800 Pro",
        codigo: "789-1234567-6",
        ubicacion: "La Vega",
        tipo: "Ruido intermitente de alto impacto",
        fecha: "21/1/2025",
        direccion: "Calle 6, sector Villa Hermosa"
    },
    {
        id: 7,
        nombre: "NES-S900 Elite",
        codigo: "321-6549877-7",
        ubicacion: "San Pedro de Macorís",
        tipo: "Resonancia estructural por bajas frecuencias",
        fecha: "22/1/2025",
        direccion: "Calle 9, sector El Progreso"
    },
    {
        id: 8,
        nombre: "NES-V100 Max",
        codigo: "987-3216549-8",
        ubicacion: "Higuey",
        tipo: "Exposición prolongada a ruido >80dB",
        fecha: "23/1/2025",
        direccion: "Calle 2, sector El Valle"
    },
    {
        id: 9,
        nombre: "NES-D250 Ultra",
        codigo: "456-9876540-9",
        ubicacion: "Puerto Plata",
        tipo: "Ondas sonoras de baja frecuencia persistentes",
        fecha: "24/1/2025",
        direccion: "Calle 5, sector El Cortecito"
    }
];

// Variable global para mantener el conjunto de datos actual
let currentData2 = sistemasData2;

// Función para crear una fila de la tabla




// Get reference to the buttons
const dispositivosBtn = document.getElementById('dispositivos-btn');
const sistemasBtn = document.getElementById('sistemas-btn');

// Function to load server data from PHP
function loadServerData() {
    const serverRows = Array.from(document.querySelectorAll('.data-row')).map(row => {
        return {
            nombre: row.querySelector('.alert-info div:first-child').textContent,
            codigo: row.querySelector('.code').textContent,
            ubicacion: row.querySelector('td:nth-child(2)').textContent,
            tipo: row.querySelector('.tag').textContent,
            // Get data from expandable content
            fecha: row.nextElementSibling.querySelector('.info-item:nth-child(1) span').textContent,
            direccion: row.nextElementSibling.querySelector('.info-item:nth-child(2) span').textContent,
            email: row.nextElementSibling.querySelector('.info-item:nth-child(3) span').textContent
        };
    });
    return serverRows;
}

// Variable to store the initial server data
let serverData = [];

// Function to render table with given data
function renderTable(data) {
    const tableBody = document.getElementById('tabla-contenido');
    tableBody.innerHTML = '';
    
    data.forEach((item, index) => {
        tableBody.innerHTML += createTableRow(item, index);
    });
}

// Function to initialize the table system
function initializeTableSystem() {
    serverData = loadServerData();
    
    dispositivosBtn.addEventListener('click', () => {
        dispositivosBtn.classList.add('active');
        sistemasBtn.classList.remove('active');
        renderTable(dispositivosData2);
    });

    sistemasBtn.addEventListener('click', () => {
        sistemasBtn.classList.add('active');
        dispositivosBtn.classList.remove('active');
        renderTable(serverData);
    });
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    initializeTableSystem();
    
    const searchInput = document.getElementById('searchInput');
    searchInput.addEventListener('input', () => {
        const searchTerm = searchInput.value.toLowerCase();
        const currentData2 = sistemasBtn.classList.contains('active') ? serverData : dispositivosData2;
        
        const filteredData = currentData2.filter(item => 
            item.nombre.toLowerCase().includes(searchTerm)
        );
        
        renderTable(filteredData);
    });
});

// Function to toggle details (expandable content)


// modal j

let currentStatus = 'pending';

        function updateStatus(status) {
            const statusBadge = document.querySelector('.status-badge');
            statusBadge.className = 'status-badge';

            if (status === 'accepted') {
                statusBadge.textContent = 'Aceptado';
                statusBadge.classList.add('accepted');
            } else if (status === 'denied') {
                statusBadge.textContent = 'Denegado';
                statusBadge.classList.add('denied');
            }

            currentStatus = status;
            localStorage.setItem('caseStatus', status);
        }


        // Cargar el estado guardado cuando se abre el modal
        function loadSavedStatus() {
            const savedStatus = localStorage.getItem('caseStatus');
            if (savedStatus) {
                updateStatus(savedStatus);
            }
        }

        // Limpiar el estado (para demostración)
        function resetStatus() {
            localStorage.removeItem('caseStatus');
            const statusBadge = document.querySelector('.status-badge');
            statusBadge.className = 'status-badge';
            statusBadge.textContent = 'En proceso';
}
        








// js ashley
// Cargar notificaciones desde el servidor
async function cargarNotificaciones() {
    try {
        const response = await fetch('Alertas.php'); // Ruta al archivo PHP
        const notificaciones = await response.json();

        const container = document.querySelector('.notificaciones-container');
        container.innerHTML = ''; // Limpiar notificaciones anteriores

        notificaciones.forEach(notificacion => {
            const item = document.createElement('div');
            item.className = 'notificacion-item';
            item.innerHTML = `
                <div class="notificacion-titulo">📌 ${notificacion.nombre} - ${notificacion.tipo}</div>
                <div class="notificacion-mensaje">
                    <strong>Ubicación:</strong> ${notificacion.ubicacion}<br>
                    <strong>Descripción:</strong> ${notificacion.descripcion}
                </div>
                <div class="notificacion-fecha">📅 ${new Date(notificacion.fecha).toLocaleString()}</div>
            `;
            container.appendChild(item);
        });
    } catch (error) {
        console.error('Error al cargar notificaciones:', error);
    }
}

// Llamar a la función al cargar la página
document.addEventListener('DOMContentLoaded', cargarNotificaciones);