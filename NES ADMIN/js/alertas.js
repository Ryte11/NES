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


if (typeof sistemasData === 'undefined') {
    var sistemasData = [];
}
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
}// Función para filtrar los datos
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
    
    // Prevenir propagación del evento si existe
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

// Función para cargar los detalles del caso
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
// Inicialización y configuración de eventos
document.addEventListener('DOMContentLoaded', function() {
    console.log("DOM cargado correctamente");
    
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
    
    // CORREGIDO: Asignar eventos a botones "Ver caso" para abrir el modal
    document.querySelectorAll('.view-case-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            // Obtener el ID del caso del data-id del tr padre
            const rowId = this.closest('tr').getAttribute('data-content');
            console.log("Abriendo modal para caso ID:", rowId);
            openModal(rowId);
        });
    });
    
    // AÑADIDO: Configurar CSS del modal para que funcione con la clase active
    const styleElement = document.createElement('style');
    styleElement.textContent = `
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            z-index: 1000;
            overflow: auto;
        }
        .modal.active {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            width: 80%;
            max-width: 800px;
            position: relative;
        }
    `;
    document.head.appendChild(styleElement);
    
    // Configurar botón de cierre del modal
    const closeModalBtns = document.querySelectorAll('.close-modal');
    closeModalBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            closeModal();
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
    
    // AÑADIDO: Debug para botones Ver caso
    console.log("Botones 'Ver caso' encontrados:", document.querySelectorAll('.view-case-btn').length);
});