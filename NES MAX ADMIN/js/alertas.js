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
const nombreDisplay = document.querySelector('.perfil h2'); 
const perfilImagenDisplay = document.querySelector('.perfil img'); 

// Función para abrir el modal de perfil
function openPerfilModal(event) {
    event.stopPropagation(); // Detener la propagación del evento
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

// Abrir modal de perfil
perfilButton.addEventListener('click', openPerfilModal);

// Cerrar modal de perfil
closePerfilBtn.addEventListener('click', closeModalWithAnimation);

// Cerrar modal de perfil al hacer clic fuera
window.addEventListener('click', (e) => {
    if (e.target === perfilModal) {
        closeModalWithAnimation();
    }
});

// Guardar cambios de perfil
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

// Variable global para almacenar el ID del caso actual
let currentCaseId = null;

// Datos de sistemas (asumiendo que está definido en otra parte o incluye estos datos de ejemplo)
// Si no está definido, creamos un array vacío para evitar errores
if (typeof sistemasData === 'undefined') {
    var sistemasData = [];
}

// Datos de dispositivos
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
let currentData = sistemasData.length > 0 ? sistemasData : [];

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
                <button class="view-btn" onclick="toggleDetails(${data.id})">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                        <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                    </svg>
                    Vista
                </button>
            </td>
            <td><button class="more-btn" data-tooltip="Más opciones">...</button></td>
        </tr>
        <tr class="expandable-content" id="content-${data.id}" data-content="${data.id}" style="display: none;">
            <td colspan="5">
                <div class="info-grid">
                    <div class="info-item">
                        <i>📅</i>
                        <span>${data.fecha}</span>
                    </div>
                    <div class="info-item">
                        <i>📍</i>
                        <span>${data.direccion || data.ubicacion}</span>
                    </div>
                    <div class="info-item">
                        <i>✉️</i>
                        <span>${data.email || data.nombre}</span>
                    </div>
                </div>
                <div class="case-description">
                    <p>${data.descripcion || 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut laborum...'}</p>
                </div>
                <button class="view-case-btn" onclick="openModal(${data.id})">Ver caso</button>
            </td>
        </tr>
    `;
}

// Función para actualizar la tabla
function updateTable(data) {
    const tbody = document.getElementById('tabla-contenido');
    if (!tbody) return; // Verificar que existe el elemento
    
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
        const codigo = item.codigo.toLowerCase();
        const ubicacion = item.ubicacion.toLowerCase();
        return nombre.includes(searchTerm) || 
               codigo.includes(searchTerm) || 
               ubicacion.includes(searchTerm);
    });
}

// Función para alternar detalles
function toggleDetails(rowId) {
    // Obtener la fila de contenido para este ID específico
    const detailRow = document.getElementById(`content-${rowId}`);
    
    if (detailRow) {
        // Alternar entre display: none y display: table-row
        if (detailRow.style.display === 'none' || !detailRow.style.display) {
            detailRow.style.display = 'table-row';
        } else {
            detailRow.style.display = 'none';
        }
    }
}

// Función para abrir el modal del caso
function openModal(id) {
    // Guardar el ID del caso actual
    currentCaseId = id;
    
    // Prevenir propagación y comportamiento por defecto si es llamado desde un evento
    if (event) {
        event.preventDefault();
        event.stopPropagation();
    }
    
    // Obtener el modal de caso
    const caseModal = document.getElementById('caseModal');
    
    // Si existe el modal, mostrarlo
    if (caseModal) {
        caseModal.classList.add('active');
        
        // Buscar el caso en datos existentes o en la base de datos
        fetchCaseDetails(id);
    }
}

// Función mejorada para cargar detalles del caso
function fetchCaseDetails(id) {
    // Para entornos con PHP, podríamos hacer una petición AJAX para obtener datos
    // Pero para este ejemplo, vamos a trabajar con los datos existentes
    
    let caseData = null;
    
    // Buscar en sistemas
    if (window.sistemasData && sistemasData.length > 0) {
        const sistemasCase = sistemasData.find(item => item.id === id);
        if (sistemasCase) caseData = sistemasCase;
    }
    
    // Buscar en dispositivos si no se encontró en sistemas
    if (!caseData && window.dispositivosData) {
        const dispositivosCase = dispositivosData.find(item => item.id === id);
        if (dispositivosCase) caseData = dispositivosCase;
    }
    
    // Si encontramos el caso, actualizar la información en el modal
    if (caseData) {
        document.querySelector('.case-title').textContent = `Caso ${caseData.codigo}`;
        document.querySelector('.case-subtitle').textContent = `Reportado por ${caseData.nombre}`;
        document.querySelector('.info-card:nth-child(1) .info-card-value').textContent = caseData.fecha;
        document.querySelector('.info-card:nth-child(2) .info-card-value').textContent = caseData.ubicacion;
        document.querySelector('.info-card:nth-child(3) .info-card-value').textContent = caseData.tipo;
        document.querySelector('.info-card:nth-child(4) .info-card-value').textContent = caseData.codigo;
        
        // Actualizar el estado en la interfaz si está disponible
        if (caseData.estado) {
            const statusBadge = document.querySelector('.status-badge');
            statusBadge.textContent = caseData.estado.charAt(0).toUpperCase() + caseData.estado.slice(1);
            
            // Aplicar clase según el estado
            if (caseData.estado === 'aceptado') {
                statusBadge.className = 'status-badge accepted';
            } else if (caseData.estado === 'denegado') {
                statusBadge.className = 'status-badge denied';
            } else {
                statusBadge.className = 'status-badge';
            }
        }
    } else {
        // Si no encontramos el caso en los datos locales, intentar obtenerlo mediante AJAX
        // Este código se ejecutará en un entorno de producción con PHP
        
        // Simulando una llamada AJAX para obtener datos del servidor
        fetch(`get_case_details.php?id=${id}`)
            .then(response => response.json())
            .then(data => {
                if (data) {
                    document.querySelector('.case-title').textContent = `Caso ${data.codigo}`;
                    document.querySelector('.case-subtitle').textContent = `Reportado por ${data.nombre}`;
                    document.querySelector('.info-card:nth-child(1) .info-card-value').textContent = data.fecha;
                    document.querySelector('.info-card:nth-child(2) .info-card-value').textContent = data.ubicacion;
                    document.querySelector('.info-card:nth-child(3) .info-card-value').textContent = data.tipo;
                    document.querySelector('.info-card:nth-child(4) .info-card-value').textContent = data.codigo;
                    
                    // Si hay un campo de descripción en los datos
                    if (data.descripcion) {
                        document.querySelector('.case-description1 p').textContent = data.descripcion;
                    }
                    
                    // Actualizar el estado en la interfaz si está disponible
                    if (data.estado) {
                        const statusBadge = document.querySelector('.status-badge');
                        statusBadge.textContent = data.estado.charAt(0).toUpperCase() + data.estado.slice(1);
                        
                        // Aplicar clase según el estado
                        if (data.estado === 'aceptado') {
                            statusBadge.className = 'status-badge accepted';
                        } else if (data.estado === 'denegado') {
                            statusBadge.className = 'status-badge denied';
                        } else {
                            statusBadge.className = 'status-badge';
                        }
                    }
                }
            })
            .catch(error => {
                console.error('Error fetching case details:', error);
            });
    }
}

// Función para cerrar el modal del caso
function closeModal() {
    const caseModal = document.getElementById('caseModal');
    if (caseModal) {
        caseModal.classList.remove('active');
        // Reiniciar el ID del caso actual
        currentCaseId = null;
    }
}

// Función para actualizar el estado del caso en la base de datos y en la interfaz
function updateStatus(status) {
    if (!currentCaseId) {
        console.error('No hay un caso seleccionado actualmente');
        return;
    }
    
    const statusText = status === 'accepted' ? 'aceptado' : 'denegado';
    const statusBadge = document.querySelector('.status-badge');
    
    // Primero actualizar la interfaz
    if (statusBadge) {
        statusBadge.textContent = status === 'accepted' ? 'Aceptado' : 'Denegado';
        statusBadge.className = 'status-badge ' + status;
    }
    
    // Luego enviar la actualización a la base de datos
    const formData = new FormData();
    formData.append('id', currentCaseId);
    formData.append('status', statusText);
    
    fetch('update_status.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log('Estado actualizado correctamente en la base de datos');
            
            // Opcional: Mostrar mensaje de éxito
            const commentSection = document.querySelector('.comment-section');
            const successMessage = document.createElement('div');
            successMessage.className = 'success-message';
            successMessage.textContent = `Estado cambiado a ${statusText} correctamente`;
            successMessage.style.color = '#4CAF50';
            successMessage.style.padding = '10px 0';
            successMessage.style.textAlign = 'center';
            
            // Insertar mensaje antes de los botones
            commentSection.insertBefore(successMessage, document.querySelector('.button-group'));
            
            // Eliminar mensaje después de 3 segundos
            setTimeout(() => {
                successMessage.remove();
            }, 3000);
            
            // También actualizamos el estado en los datos locales si existen
            if (window.sistemasData) {
                const caseIndex = sistemasData.findIndex(item => item.id === currentCaseId);
                if (caseIndex !== -1) {
                    sistemasData[caseIndex].estado = statusText;
                }
            }
            
            if (window.dispositivosData) {
                const caseIndex = dispositivosData.findIndex(item => item.id === currentCaseId);
                if (caseIndex !== -1) {
                    dispositivosData[caseIndex].estado = statusText;
                }
            }
        } else {
            console.error('Error al actualizar el estado:', data.message);
            
            // Mostrar mensaje de error
            alert('Error al actualizar el estado: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error en la solicitud:', error);
        alert('Error en la comunicación con el servidor');
    });
}

// Función para resetear el estado del caso
function resetStatus() {
    if (!currentCaseId) {
        console.error('No hay un caso seleccionado actualmente');
        return;
    }
    
    const statusBadge = document.querySelector('.status-badge');
    
    // Actualizar interfaz
    if (statusBadge) {
        statusBadge.textContent = 'En proceso';
        statusBadge.className = 'status-badge';
    }
    
    // Enviar actualización a la base de datos
    const formData = new FormData();
    formData.append('id', currentCaseId);
    formData.append('status', 'en proceso');
    
    fetch('update_status.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log('Estado reseteado correctamente en la base de datos');
            
            // Opcional: Mostrar mensaje de éxito
            const commentSection = document.querySelector('.comment-section');
            const successMessage = document.createElement('div');
            successMessage.className = 'success-message';
            successMessage.textContent = 'Estado reseteado correctamente';
            successMessage.style.color = '#4CAF50';
            successMessage.style.padding = '10px 0';
            successMessage.style.textAlign = 'center';
            
            // Insertar mensaje antes de los botones
            commentSection.insertBefore(successMessage, document.querySelector('.button-group'));
            
            // Eliminar mensaje después de 3 segundos
            setTimeout(() => {
                successMessage.remove();
            }, 3000);
            
            // También actualizamos el estado en los datos locales si existen
            if (window.sistemasData) {
                const caseIndex = sistemasData.findIndex(item => item.id === currentCaseId);
                if (caseIndex !== -1) {
                    sistemasData[caseIndex].estado = 'en proceso';
                }
            }
            
            if (window.dispositivosData) {
                const caseIndex = dispositivosData.findIndex(item => item.id === currentCaseId);
                if (caseIndex !== -1) {
                    dispositivosData[caseIndex].estado = 'en proceso';
                }
            }
        } else {
            console.error('Error al resetear el estado:', data.message);
            
            // Mostrar mensaje de error
            alert('Error al resetear el estado: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error en la solicitud:', error);
        alert('Error en la comunicación con el servidor');
    });
}

// Inicialización y configuración de eventos
document.addEventListener('DOMContentLoaded', () => {
    // Actualizar la tabla con los datos iniciales
    if (currentData.length > 0) {
        updateTable(currentData);
    }

    // Configurar el buscador
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('input', (e) => {
            const filteredData = filterData(e.target.value);
            updateTable(filteredData);
        });
    }

    // Configurar botones de cambio
    const sistemasBtn = document.getElementById('sistemas-btn');
    const dispositivosBtn = document.getElementById('dispositivos-btn');
    
    if (sistemasBtn) {
        sistemasBtn.addEventListener('click', function() {
            document.querySelectorAll('.stat-button').forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            currentData = sistemasData;
            if (searchInput) searchInput.value = '';
            updateTable(currentData);
        });
    }
    
    if (dispositivosBtn) {
        dispositivosBtn.addEventListener('click', function() {
            document.querySelectorAll('.stat-button').forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            currentData = dispositivosData;
            if (searchInput) searchInput.value = '';
            updateTable(currentData);
        });
    }
    
    // Configurar botón de cierre del modal de caso
    const closeModalBtn = document.querySelector('.close-modal');
    if (closeModalBtn) {
        closeModalBtn.addEventListener('click', function() {
            closeModal();
        });
    }
    
    // Configurar botón de envío del formulario
    const enviarBtn = document.querySelector('.Enviar');
    if (enviarBtn) {
        enviarBtn.addEventListener('click', function() {
            if (!currentCaseId) {
                alert('No hay un caso seleccionado actualmente');
                return;
            }
            
            // Obtener el comentario
            const commentInput = document.querySelector('.comment-input');
            const commentText = commentInput ? commentInput.value.trim() : '';
            
            if (!commentText) {
                alert('Por favor escribe un comentario antes de enviar');
                return;
            }
            
            // Recopilar datos del caso
            const formData = new FormData();
            formData.append('id', currentCaseId);
            formData.append('comment', commentText);
            
            // Enviar comentario a PHP usando fetch
            fetch('save_comment.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Comentario guardado exitosamente');
                    commentInput.value = ''; // Limpiar el campo
                } else {
                    alert('Error al guardar el comentario: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error en la solicitud:', error);
                alert('Error en la comunicación con el servidor');
            });
        });
    }
});