// Función para abrir el modal de notificaciones
function openModal() {
  document.getElementById("modal-container").style.display = "flex";
}

// Función para cerrar el modal de notificaciones
function closeModal() {
  document.getElementById("modal-container").style.display = "none";
}

// Función para abrir el modal del formulario
function openModalform() {
  document.getElementById("denunciaModal").classList.add("active");
}

// Función para cerrar el modal del formulario
function closeModalform() {
  document.getElementById("denunciaModal").classList.remove("active");
}

// Validación del formulario
function handleSubmit(event) {
  event.preventDefault();
  let isValid = true;

  // Validar nombre
  const nombre = document.getElementById("nombre");
  if (!nombre.value.trim()) {
    showError("nombre-error", "El nombre es requerido");
    isValid = false;
  }

  // Validar cédula
  const cedula = document.getElementById("Cedula");
  if (!cedula.value.trim() || !/^\d{11}$/.test(cedula.value.trim())) {
    showError("Cedula-error", "Ingrese una cédula válida (11 dígitos)");
    isValid = false;
  }

  // Validar provincia
  const provincia = document.getElementById("provincia");
  if (!provincia.value) {
    showError("provincia-error", "Seleccione una provincia");
    isValid = false;
  }

  // Validar ubicación
  const ubicacion = document.getElementById("ubicacion");
  if (!ubicacion.value.trim()) {
    showError("ubicacion-error", "La dirección es requerida");
    isValid = false;
  }

  // Validar tipo de denuncia
  const tipo = document.getElementById("tipo");
  if (!tipo.value) {
    showError("tipo-error", "Seleccione un tipo de denuncia");
    isValid = false;
  }

  // Validar descripción
  const descripcion = document.getElementById("descripcion");
  if (!descripcion.value.trim()) {
    showError("descripcion-error", "La descripción es requerida");
    isValid = false;
  }

  if (isValid) {
    document.getElementById("denunciaForm").submit();
  }
}

function showError(elementId, message) {
  const errorElement = document.getElementById(elementId);
  if (errorElement) {
    errorElement.textContent = message;
    errorElement.style.display = "block";
  }
}
