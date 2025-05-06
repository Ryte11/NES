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
      element: document.getElementById("cedula"),
      validate: (value) =>
        /^\d{8,11}$/.test(value) || "La cédula debe tener entre 8 y 11 dígitos",
    },
    provincia: {
      element: document.getElementById("provincia"),
      validate: (value) => value !== "" || "Seleccione una provincia",
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

    input.element.addEventListener("input", () => {
      const result = input.validate(input.element.value);
      if (typeof result === "string") {
        errorElement.textContent = result;
        input.element.classList.add("invalid");
      } else {
        errorElement.textContent = "";
        input.element.classList.remove("invalid");
      }
      updateSubmitButton();
    });
  });
}

async function handleSubmit(event) {
  event.preventDefault();
  const form = event.target;
  const submitBtn = form.querySelector('button[type="submit"]');

  if (!validateForm()) {
    showNotification(
      "Por favor, corrija los errores en el formulario",
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
    showNotification(error.message || "Error al enviar la denuncia", "error");
  } finally {
    submitBtn.disabled = false;
    submitBtn.textContent = "Enviar tu Denuncia";
  }
}

function validateForm() {
  const inputs = document.querySelectorAll(
    "#denunciaForm input, #denunciaForm select, #denunciaForm textarea"
  );
  let isValid = true;

  inputs.forEach((input) => {
    const event = new Event("input");
    input.dispatchEvent(event);
    if (input.classList.contains("invalid")) {
      isValid = false;
    }
  });

  return isValid;
}

function updateSubmitButton() {
  const submitBtn = document.querySelector(
    '#denunciaForm button[type="submit"]'
  );
  const hasErrors = document.querySelectorAll(".invalid").length > 0;
  submitBtn.disabled = hasErrors;
}

function showNotification(message, type = "info") {
  const notification = document.createElement("div");
  notification.className = `notification ${type}`;
  notification.textContent = message;

  document.body.appendChild(notification);

  setTimeout(() => {
    notification.classList.add("fade-out");
    setTimeout(() => notification.remove(), 300);
  }, 4000);
}
