// Enhanced complaint form validation and submission
document.addEventListener("DOMContentLoaded", () => {
  const denunciaForm = document.getElementById("denunciaForm");
  const submitBtn = denunciaForm.querySelector('button[type="submit"]');

  // Initialize form validation
  initializeFormValidation();

  // Handle form submission
  denunciaForm.addEventListener("submit", handleSubmit);
});

function initializeFormValidation() {
  const inputs = {
    nombre: {
      element: document.getElementById("nombre"),
      validate: (value) =>
        value.trim().length >= 3 ||
        "El nombre debe tener al menos 3 caracteres",
    },
    cedula: {
      element: document.getElementById("Cedula"),
      validate: (value) =>
        /^\d{8,11}$/.test(value) || "La cédula debe tener entre 8 y 11 dígitos",
    },
    ubicacion: {
      element: document.getElementById("ubicacion"),
      validate: (value) =>
        value.trim().length >= 10 || "La ubicación debe ser más específica",
    },
    tipo: {
      element: document.getElementById("tipo"),
      validate: (value) => value !== "" || "Seleccione un tipo de denuncia",
    },
    descripcion: {
      element: document.getElementById("descripcion"),
      validate: (value) =>
        value.trim().length >= 20 ||
        "La descripción debe tener al menos 20 caracteres",
    },
  };

  // Add real-time validation
  Object.entries(inputs).forEach(([key, input]) => {
    const errorElement = document.getElementById(`${key}-error`);
    if (!errorElement) return;

    input.element.addEventListener("input", () => {
      validateField(key, input, errorElement);
    });
  });
}

function validateField(key, input, errorElement) {
  const result = input.validate(input.element.value);
  if (typeof result === "string") {
    errorElement.textContent = result;
    input.element.classList.add("invalid");
    return false;
  } else {
    errorElement.textContent = "";
    input.element.classList.remove("invalid");
    return true;
  }
}

async function handleSubmit(event) {
  event.preventDefault();
  const form = event.target;
  const submitBtn = form.querySelector('button[type="submit"]');

  // Validate all fields first
  const isValid = validateAllFields();

  if (!isValid) {
    showNotification(
      "Por favor, complete todos los campos correctamente",
      "error"
    );
    return;
  }

  try {
    submitBtn.disabled = true;
    submitBtn.textContent = "Enviando...";

    const formData = new FormData(form);
    const response = await fetch("guardar_denuncia.php", {
      method: "POST",
      body: formData,
    });

    const result = await response.json();

    if (result.success) {
      showNotification("Denuncia enviada correctamente", "success");
      form.reset();
      closeModalform();
    } else {
      throw new Error(result.message || "Error al procesar la denuncia");
    }
  } catch (error) {
    console.error("Error:", error);
    const errorMessage = error.message || "Error al enviar la denuncia";
    showNotification(errorMessage, "error");

    // Mostrar errores específicos en los campos correspondientes
    const errorElement = document.getElementById("form-errors");
    if (errorElement) {
      errorElement.textContent = errorMessage;
      errorElement.style.display = "block";
    }
  } finally {
    submitBtn.disabled = false;
    submitBtn.textContent = "Enviar tu Denuncia";
  }
}

function validateAllFields() {
  const inputs = {
    nombre: {
      element: document.getElementById("nombre"),
      validate: (value) =>
        value.trim().length >= 3 ||
        "El nombre debe tener al menos 3 caracteres",
    },
    cedula: {
      element: document.getElementById("Cedula"),
      validate: (value) =>
        /^\d{8,11}$/.test(value) || "La cédula debe tener entre 8 y 11 dígitos",
    },
    ubicacion: {
      element: document.getElementById("ubicacion"),
      validate: (value) =>
        value.trim().length >= 10 || "La ubicación debe ser más específica",
    },
    tipo: {
      element: document.getElementById("tipo"),
      validate: (value) => value !== "" || "Seleccione un tipo de denuncia",
    },
    descripcion: {
      element: document.getElementById("descripcion"),
      validate: (value) =>
        value.trim().length >= 20 ||
        "La descripción debe tener al menos 20 caracteres",
    },
  };

  let isValid = true;

  Object.entries(inputs).forEach(([key, input]) => {
    const errorElement = document.getElementById(`${key}-error`);
    if (!errorElement) return;

    const fieldIsValid = validateField(key, input, errorElement);
    if (!fieldIsValid) {
      isValid = false;
      input.element.classList.add("invalid");
    }
  });

  return isValid;
}

function showNotification(message, type = "info") {
  const notification = document.createElement("div");
  notification.className = `notification ${type}`;
  notification.textContent = message;
  notification.style.position = "fixed";
  notification.style.top = "20px";
  notification.style.right = "20px";
  notification.style.padding = "15px";
  notification.style.borderRadius = "5px";
  notification.style.backgroundColor = type === "error" ? "#f44336" : "#4CAF50";
  notification.style.color = "white";
  notification.style.zIndex = "1000";

  document.body.appendChild(notification);

  setTimeout(() => {
    notification.style.opacity = "0";
    setTimeout(() => notification.remove(), 300);
  }, 4000);
}
