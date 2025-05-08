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



// Variable global para mantener el conjunto de datos actual
let currentData = sistemasData.length > 0 ? sistemasData : [];

// Función para crear una fila de la tabla
function createTableRow(data, index) {
    // Check if it's sound_data
    if (data.db_value !== undefined) {
        return `
                
                <tr class="data-row">
                <td>
                    <div class="alert-item">
                        <div class="alert-icon">i</div>
                        <div class="alert-info">
                            <div>${data.id_dispositivo || 'N/A'}</div>
                            <div class="code">${data.db_value || 'N/A'}</div>
                        </div>
                    </div>
                </td>
                <td>${data.zona || 'N/A'}</td>
                <td><span class="tag">${data.db_value || 'N/A'}</span></td>
                <td>
                    <button class="view-btn">
                        ${data.timestamp || 'N/A'}
                    </button>
                </td>
            </tr>`;
    }
    
    // Original format for sistemas data
    return `
    
        <tr class="data-row">
            <td>
                <div class="alert-item">
                    <div class="alert-icon">i</div>
                    <div class="alert-info">
                        <div>${data.nombre || 'N/A'}</div>
                        <div class="code">${data.codigo || 'N/A'}</div>
                    </div>
                </div>
            </td>
            <td>${data.ubicacion || 'N/A'}</td>
            <td><span class="tag">${data.tipo || 'N/A'}</span></td>
            <td>
                <button class="view-btn" onclick="toggleDetails(${data.id})">Vista</button>
            </td>
            
        </tr>`;
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
    
    // Prevenir propagación del evento
    if (event) {
        event.preventDefault();
        event.stopPropagation();
    }
    
    // Obtener el modal de caso
    const caseModal = document.getElementById('caseModal');
    
    // Si existe el modal, mostrarlo
    if (caseModal) {
        caseModal.classList.add('active');
        
        // Buscar el caso y cargar sus detalles
        fetchCaseDetails(id);
    } else {
        console.error('Modal no encontrado');
    }
}



// 2. Función para cargar los detalles del caso
function fetchCaseDetails(id) {
    // Intentar obtener los datos directamente desde la fila
    // Primera opción: buscar por data-id en la fila visible
    let nombreElement = document.querySelector(`tr[data-id="${id}"] .alert-info div:first-child`);
    let cedulaElement = document.querySelector(`tr[data-id="${id}"] .code`);
    let ubicacionElement = document.querySelector(`tr[data-id="${id}"] td:nth-child(2)`);
    let tipoElement = document.querySelector(`tr[data-id="${id}"] .tag`);
    
    // Segunda opción: buscar en la fila expandible
    const descripcionElement = document.querySelector(`#content-${id} .case-description p`);
    const fechaElement = document.querySelector(`#content-${id} .info-item:first-child span`);
    
    // Si encontramos al menos los datos básicos
    if (nombreElement && cedulaElement) {
        const nombre = nombreElement.textContent || '';
        const cedula = cedulaElement.textContent || '';
        const ubicacion = ubicacionElement ? ubicacionElement.textContent : '';
        const tipo = tipoElement ? tipoElement.textContent : '';
        const fecha = fechaElement ? fechaElement.textContent : '';
        const descripcion = descripcionElement ? descripcionElement.textContent : '';
        
        // Actualizar modal con los datos
        document.querySelector('#caseModal .case-title').textContent = `Caso ${cedula}`;
        document.querySelector('#caseModal .case-subtitle').textContent = `Reportado por ${nombre}`;
        
        // Actualizar valores de los info-cards
        const infoCards = document.querySelectorAll('#caseModal .info-card-value');
        if (infoCards.length >= 4) {
            infoCards[0].textContent = fecha;
            infoCards[1].textContent = ubicacion;
            infoCards[2].textContent = tipo;
            infoCards[3].textContent = cedula;
        }
        
        // Actualizar descripción si está disponible
        const descripcionModal = document.querySelector('#caseModal .case-description1 p');
        if (descripcionModal && descripcion) {
            descripcionModal.textContent = descripcion;
        }
    } else {
        // Si no pudimos obtener datos de la interfaz, intentar con AJAX
        console.log("No se encontraron datos en la interfaz, intentando con AJAX...");
        
        // Hacer petición AJAX
        fetch(`get_case_details.php?id=${id}`)
            .then(response => response.json())
            .then(data => {
                if (data) {
                    // Actualizar modal con datos recibidos
                    document.querySelector('#caseModal .case-title').textContent = `Caso ${data.cedula}`;
                    document.querySelector('#caseModal .case-subtitle').textContent = `Reportado por ${data.nombre}`;
                    
                    const infoCards = document.querySelectorAll('#caseModal .info-card-value');
                    if (infoCards.length >= 4) {
                        infoCards[0].textContent = data.fecha;
                        infoCards[1].textContent = data.ubicacion;
                        infoCards[2].textContent = data.tipo;
                        infoCards[3].textContent = data.cedula;
                    }
                    
                    if (data.descripcion) {
                        document.querySelector('#caseModal .case-description1 p').textContent = data.descripcion;
                    }
                }
            })
            .catch(error => {
                console.error('Error al obtener detalles del caso:', error);
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
document.addEventListener('DOMContentLoaded', function() {
    // Configurar botón de cierre del modal
    const closeModalBtns = document.querySelectorAll('.close-modal');
    closeModalBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            document.getElementById('caseModal').classList.remove('active');
        });
    });
    
    // Asignar funciones de botones de aceptar/denegar/resetear
    const btnAccept = document.querySelector('.btn-accept');
    if (btnAccept) {
        btnAccept.addEventListener('click', function() {
            updateStatus('accepted');
        });
    }
    
    const btnDeny = document.querySelector('.btn-deny');
    if (btnDeny) {
        btnDeny.addEventListener('click', function() {
            updateStatus('denied');
        });
    }
    
    const btnReset = document.querySelector('.demo-button');
    if (btnReset) {
        btnReset.addEventListener('click', function() {
            resetStatus();
        });
    }
});
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


// paginacion y filto de busqueda
// Define pagination variables
let currentPage = 1;
const rowsPerPage = 10; // You can adjust this value

// Function to create pagination controls
function createPagination(totalItems, containerId) {
    const totalPages = Math.ceil(totalItems / rowsPerPage);
    const container = document.getElementById(containerId);
    
    if (!container) {
        // Create the container if it doesn't exist
        const table = document.querySelector('.content-card table');
        const paginationDiv = document.createElement('div');
        paginationDiv.id = containerId;
        paginationDiv.className = 'pagination-container';
        if (table && table.parentNode) {
            table.parentNode.insertBefore(paginationDiv, table.nextSibling);
        }
    }
    
    const paginationContainer = document.getElementById(containerId);
    if (!paginationContainer) return;
    
    paginationContainer.innerHTML = '';
    
    // Create "Previous" button
    const prevBtn = document.createElement('button');
    prevBtn.className = 'pagination-btn';
    prevBtn.textContent = '< Prev';
    prevBtn.disabled = currentPage === 1;
    prevBtn.addEventListener('click', () => {
        if (currentPage > 1) {
            currentPage--;
            updateTableWithPagination();
        }
    });
    paginationContainer.appendChild(prevBtn);
    
    // Create page number buttons (up to 5 pages)
    const startPage = Math.max(1, currentPage - 2);
    const endPage = Math.min(totalPages, startPage + 4);
    
    for (let i = startPage; i <= endPage; i++) {
        const pageBtn = document.createElement('button');
        pageBtn.className = 'pagination-btn' + (i === currentPage ? ' active' : '');
        pageBtn.textContent = i;
        pageBtn.addEventListener('click', () => {
            currentPage = i;
            updateTableWithPagination();
        });
        paginationContainer.appendChild(pageBtn);
    }
    
    // Create "Next" button
    const nextBtn = document.createElement('button');
    nextBtn.className = 'pagination-btn';
    nextBtn.textContent = 'Next >';
    nextBtn.disabled = currentPage === totalPages;
    nextBtn.addEventListener('click', () => {
        if (currentPage < totalPages) {
            currentPage++;
            updateTableWithPagination();
        }
    });
    paginationContainer.appendChild(nextBtn);
    
    // Add page info
    const pageInfo = document.createElement('span');
    pageInfo.className = 'pagination-info';
    pageInfo.textContent = `Page ${currentPage} of ${totalPages}`;
    paginationContainer.appendChild(pageInfo);
}

// Enhanced function to update the table with pagination
function updateTableWithPagination() {
    // If no data, return
    if (!currentData || currentData.length === 0) {
        const tbody = document.getElementById('tabla-contenido');
        if (tbody) tbody.innerHTML = '<tr><td colspan="5">No hay datos disponibles</td></tr>';
        
        // Create empty pagination
        createPagination(0, 'paginationControls');
        return;
    }
    
    // Calculate start and end indices for current page
    const startIndex = (currentPage - 1) * rowsPerPage;
    const endIndex = Math.min(startIndex + rowsPerPage, currentData.length);
    
    // Get data for current page
    const currentPageData = currentData.slice(startIndex, endIndex);
    
    // Update table with current page data
    const tbody = document.getElementById('tabla-contenido');
    if (!tbody) return;
    
    tbody.innerHTML = '';
    currentPageData.forEach((item, index) => {
        tbody.innerHTML += createTableRow(item, index);
    });
    
    // Create pagination controls
    createPagination(currentData.length, 'paginationControls');
}

// Fix for the sistema-btn to properly show the systems table
document.addEventListener('DOMContentLoaded', () => {
    // Add CSS for pagination
    const style = document.createElement('style');
    style.textContent = `
        .pagination-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 20px 0;
            gap: 5px;
        }
        .pagination-btn {
            padding: 8px 12px;
            background-color: #f0f0f0;
            border: 1px solid #ddd;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.3s;
        }
        .pagination-btn:hover {
            background-color: #e0e0e0;
        }
        .pagination-btn.active {
            background-color: #007bff;
            color: white;
            border-color: #007bff;
        }
        .pagination-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
        .pagination-info {
            margin-left: 10px;
            color: #666;
        }
    `;
    document.head.appendChild(style);
    
    // Create placeholder for pagination controls if it doesn't exist
    if (!document.getElementById('paginationControls')) {
        const paginationDiv = document.createElement('div');
        paginationDiv.id = 'paginationControls';
        paginationDiv.className = 'pagination-container';
        
        const table = document.querySelector('.content-card table');
        if (table && table.parentNode) {
            table.parentNode.insertBefore(paginationDiv, table.nextSibling);
        }
    }
    
    // Override the original updateTable function to use pagination
    window.updateTable = function(data) {
        // Store the current data globally
        currentData = data;
        
        // Reset to first page when data changes
        currentPage = 1;
        
        // Update the table with pagination
        updateTableWithPagination();
    };
    
    // Fix for sistemas-btn
    const sistemasBtn = document.getElementById('sistemas-btn');
    if (sistemasBtn) {
        sistemasBtn.addEventListener('click', function() {
            sistemasBtn.removeEventListener('click', arguments.callee);
            
            // Add proper event handler
            sistemasBtn.addEventListener('click', function() {
                document.querySelectorAll('.stat-button').forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
                
                // If sistemasData doesn't exist or is empty, try loading from the server
                if (!window.sistemasData || window.sistemasData.length === 0) {
                    // Fallback to try using PHP data already in the table
                    const tableRows = document.querySelectorAll('#tabla-contenido tr.data-row');
                    if (tableRows.length > 0) {
                        currentData = Array.from(tableRows).map(row => {
                            // Extract data from the row
                            const nameElement = row.querySelector('.alert-info div:first-child');
                            const codeElement = row.querySelector('.alert-info .code');
                            const ubicacionElement = row.querySelector('td:nth-child(2)');
                            const tipoElement = row.querySelector('td:nth-child(3) .tag');
                            const vista = row.querySelector('td:nth-child(4) .view-btn');
                            
                            // Create object from row data
                            return {
                                id: row.getAttribute('data-id') || Math.random().toString(36).substr(2, 9),
                                nombre: nameElement ? nameElement.textContent : 'N/A',
                                codigo: codeElement ? codeElement.textContent : 'N/A',
                                ubicacion: ubicacionElement ? ubicacionElement.textContent : 'N/A',
                                tipo: tipoElement ? tipoElement.textContent : 'N/A',
                                 vista: `<button class="view-btn" onclick="viewDetails(${id})">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                        <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                    </svg>
                                    Vista
                                </button>`,
                                fecha: 'N/A' 
                            };
                        });
                        
                        // Update table with extracted data
                        updateTableWithPagination();
                    } else {
                        // Try loading from server
                        fetch('./get_case_details.php')
                            .then(response => response.json())
                            .then(data => {
                                if (Array.isArray(data)) {
                                    window.sistemasData = data;
                                    currentData = data;
                                    updateTableWithPagination();
                                }
                            })
                            .catch(error => {
                                console.error('Error loading systems data:', error);
                                // Show original PHP-rendered content by doing nothing
                                currentData = [];
                                updateTableWithPagination();
                            });
                    }
                } else {
                    // Use existing sistemasData
                    currentData = window.sistemasData;
                    updateTableWithPagination();
                }
            });
            
            sistemasBtn.click();
        });
        
        // Initial click to setup and load sistema data
        sistemasBtn.click();
    }
    
    // Enhanced dispositivos button handler
    const dispositivosBtn = document.getElementById('dispositivos-btn');
    if (dispositivosBtn) {
        dispositivosBtn.addEventListener('click', function() {
            document.querySelectorAll('.stat-button').forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
            // Clear search input
            const searchInput = document.getElementById('searchInput');
            if (searchInput) searchInput.value = '';
            
            // Fetch sound data with loading indicator
            const tableBody = document.getElementById('tabla-contenido');
            if (tableBody) {
                tableBody.innerHTML = '<tr><td colspan="5" style="text-align:center">Cargando datos...</td></tr>';
            }
            
            fetchSoundData();
        });
    }
    
    // Initialize with sistema data on page load (default view)
    if (sistemasBtn) {
        sistemasBtn.click();
    }
});

// Enhanced fetchSoundData function with error handling and pagination
function fetchSoundData() {
    fetch('get_sound_data.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (Array.isArray(data)) {
                currentData = data;
                updateTableWithPagination();
            } else {
                console.error('Data received is not an array:', data);
                currentData = [];
                updateTableWithPagination();
            }
        })
        .catch(error => {
            console.error('Error fetching sound data:', error);
            const tbody = document.getElementById('tabla-contenido');
            if (tbody) {
                tbody.innerHTML = '<tr><td colspan="5">Error al cargar datos de dispositivos. Por favor intente más tarde.</td></tr>';
            }
            currentData = [];
            createPagination(0, 'paginationControls');
        });
}



// Add these CSS styles
const style = document.createElement('style');
style.textContent = `
    .loading {
        text-align: center;
        padding: 20px;
        color: #666;
    }
    .error {
        text-align: center;
        padding: 20px;
        color: #f44336;
    }
    .no-data {
        text-align: center;
        padding: 20px;
        color: #666;
        font-style: italic;
    }
`;
document.head.appendChild(style);

function toggleHeaders(showSistemas) {
    const sistemasHeaders = document.getElementById('sistema-headers');
    const dispositivosHeaders = document.getElementById('dispositivos-headers');
    
    if (sistemasHeaders && dispositivosHeaders) {
        sistemasHeaders.style.display = showSistemas ? 'table-row' : 'none';
        dispositivosHeaders.style.display = showSistemas ? 'none' : 'table-row';
    }
}

// Al cargar la página, asegurarse que se muestren los headers de sistema por defecto
document.addEventListener('DOMContentLoaded', () => {
    toggleHeaders(true);
    
    if (sistemasBtn) {
        sistemasBtn.classList.add('active');
    }
});



