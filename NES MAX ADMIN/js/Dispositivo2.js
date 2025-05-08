

function showOptions(id) {
    const menu = document.getElementById(`options-${id}`);
    const allMenus = document.querySelectorAll('.options-menu');
    
    // Ocultar todos los menús abiertos
    allMenus.forEach(m => {
        if (m.id !== `options-${id}`) {
            m.style.display = 'none';
        }
    });
    
    // Mostrar/ocultar el menú seleccionado
    menu.style.display = menu.style.display === 'none' ? 'block' : 'none';
}

function editDevice(id) {
    // Implementar lógica de edición
    console.log('Editar dispositivo:', id);
}

function deleteDevice(id) {
    if (confirm('¿Está seguro de que desea eliminar este dispositivo?')) {
        fetch(`php/eliminar_dispositivo.php?id=${id}`, {
            method: 'DELETE'
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error al eliminar el dispositivo');
            }
        });
    }
}

function viewDetails(id) {
    // Implementar lógica para ver detalles
    console.log('Ver detalles del dispositivo:', id);

    
}


// paginacion y filto de busqueda
// Variables para la paginación
let currentPage = 1;
const rowsPerPage = 5; // Número de filas por página
let filteredRows = []; // Para almacenar filas filtradas

// Función para implementar la búsqueda
document.addEventListener('DOMContentLoaded', function() {
    // Obtener todas las filas de la tabla
    const table = document.querySelector('table');
    const rows = Array.from(table.querySelectorAll('tbody tr'));
    filteredRows = rows; // Inicialmente todas las filas están disponibles

    // Configurar el input de búsqueda - Cambiar a búsqueda por clase
    const searchInput = document.querySelector('.search-input');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            
            // Filtrar las filas según el término de búsqueda
            filteredRows = rows.filter(row => {
                // Obtener el texto de las celdas relevantes
                const cells = row.querySelectorAll('td');
                return Array.from(cells).some(cell => {
                    const text = cell.textContent.toLowerCase();
                    return text.includes(searchTerm);
                });
            });

            // Resetear a la primera página cuando se busca
            currentPage = 1;
            
            // Mostrar las filas filtradas y actualizar la paginación
            displayRows();
            updatePaginationControls();
        });
    } else {
        console.error('No se encontró el input de búsqueda');
    }

    // Inicializar la paginación
    createPaginationControls();
    displayRows();
});

// Función para mostrar las filas correspondientes a la página actual
function displayRows() {
    const table = document.querySelector('table');
    const tbody = table.querySelector('tbody');
    const rows = Array.from(tbody.querySelectorAll('tr'));
    
    // Ocultar todas las filas
    rows.forEach(row => {
        row.style.display = 'none';
    });
    
    // Calcular índices para la página actual
    const startIndex = (currentPage - 1) * rowsPerPage;
    const endIndex = Math.min(startIndex + rowsPerPage, filteredRows.length);
    
    // Mostrar solo las filas de la página actual
    for (let i = startIndex; i < endIndex; i++) {
        filteredRows[i].style.display = '';
    }
}

// Función para crear los controles de paginación
function createPaginationControls() {
    // Crear contenedor para los controles de paginación si no existe
    let paginationContainer = document.querySelector('.pagination-container');
    if (!paginationContainer) {
        paginationContainer = document.createElement('div');
        paginationContainer.className = 'pagination-container';
        
        // Insertar después de la tabla
        const table = document.querySelector('table');
        table.parentNode.insertBefore(paginationContainer, table.nextSibling);
    }
    
    updatePaginationControls();
}

// Actualizar los controles de paginación
function updatePaginationControls() {
    const paginationContainer = document.querySelector('.pagination-container');
    paginationContainer.innerHTML = ''; // Limpiar contenido existente
    
    // Calcular el número total de páginas
    const totalPages = Math.ceil(filteredRows.length / rowsPerPage);
    
    // Si no hay páginas, no mostrar controles
    if (totalPages <= 1) {
        return;
    }
    
    // Botón "Anterior"
    const prevButton = document.createElement('button');
    prevButton.textContent = 'Anterior';
    prevButton.className = 'pagination-btn';
    prevButton.disabled = currentPage === 1;
    prevButton.addEventListener('click', () => {
        if (currentPage > 1) {
            currentPage--;
            displayRows();
            updatePaginationControls();
        }
    });
    paginationContainer.appendChild(prevButton);
    
    // Números de página
    const maxVisiblePages = 5; // Máximo de botones de página visibles
    let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
    let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);
    
    // Ajustar si estamos cerca del final
    if (endPage - startPage + 1 < maxVisiblePages) {
        startPage = Math.max(1, endPage - maxVisiblePages + 1);
    }
    
    // Crear botones de página
    for (let i = startPage; i <= endPage; i++) {
        const pageButton = document.createElement('button');
        pageButton.textContent = i;
        pageButton.className = 'pagination-btn' + (i === currentPage ? ' active' : '');
        pageButton.addEventListener('click', () => {
            currentPage = i;
            displayRows();
            updatePaginationControls();
        });
        paginationContainer.appendChild(pageButton);
    }
    
    // Botón "Siguiente"
    const nextButton = document.createElement('button');
    nextButton.textContent = 'Siguiente';
    nextButton.className = 'pagination-btn';
    nextButton.disabled = currentPage === totalPages;
    nextButton.addEventListener('click', () => {
        if (currentPage < totalPages) {
            currentPage++;
            displayRows();
            updatePaginationControls();
        }
    });
    paginationContainer.appendChild(nextButton);
    
    // Información de página actual
    const pageInfo = document.createElement('span');
    pageInfo.textContent = `Página ${currentPage} de ${totalPages}`;
    pageInfo.className = 'pagination-info';
    paginationContainer.appendChild(pageInfo);
}