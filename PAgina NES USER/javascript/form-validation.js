document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("denunciaForm");
  if (!form) return;

  const validadores = {
    nombre: {
      validacion: (valor) => {
        if (!valor.trim()) return "El nombre es requerido";
        if (valor.trim().length < 3)
          return "El nombre debe tener al menos 3 caracteres";
        return true;
      },
    },
    cedula: {
      validacion: (valor) => {
        if (!valor.trim()) return "La cédula es requerida";
        if (!/^\d{8,11}$/.test(valor.trim()))
          return "La cédula debe tener entre 8 y 11 dígitos";
        return true;
      },
    },
    provincia: {
      validacion: (valor) => {
        if (!valor.trim()) return "Debe seleccionar una provincia";
        return true;
      },
    },
    direccion: {
      validacion: (valor) => {
        if (!valor.trim()) return "La dirección es requerida";
        if (valor.trim().length < 10)
          return "La dirección debe ser más específica (mínimo 10 caracteres)";
        return true;
      },
    },
    tipo: {
      validacion: (valor) => {
        const tiposValidos = ["bocinas", "vehiculos", "construccion", "ruido"];
        if (!valor) return "Debe seleccionar un tipo de denuncia";
        if (!tiposValidos.includes(valor)) return "Tipo de denuncia inválido";
        return true;
      },
    },
    descripcion: {
      validacion: (valor) => {
        if (!valor.trim()) return "La descripción es requerida";
        if (valor.trim().length < 20)
          return "La descripción debe tener al menos 20 caracteres";
        return true;
      },
    },
  };

  // Validación en tiempo real
  Object.keys(validadores).forEach((nombreCampo) => {
    const elemento = document.getElementById(
      nombreCampo === "cedula" ? "Cedula" : nombreCampo
    );
    const errorSpan = document.getElementById(`${nombreCampo}-error`);

    if (elemento && errorSpan) {
      ["input", "blur", "change"].forEach((evento) => {
        elemento.addEventListener(evento, () => {
          validarCampo(nombreCampo, elemento, errorSpan);
        });
      });
    }
  });

  function validarCampo(nombreCampo, elemento, errorSpan) {
    const validador = validadores[nombreCampo];
    const resultado = validador.validacion(elemento.value);

    if (resultado !== true) {
      elemento.classList.add("invalid");
      errorSpan.textContent = resultado;
      errorSpan.style.display = "block";
      return false;
    } else {
      elemento.classList.remove("invalid");
      errorSpan.textContent = "";
      errorSpan.style.display = "none";
      return true;
    }
  }

  function validarFormulario() {
    let formValido = true;
    const errores = {};

    Object.keys(validadores).forEach((nombreCampo) => {
      const elemento = document.getElementById(
        nombreCampo === "cedula" ? "Cedula" : nombreCampo
      );
      const errorSpan = document.getElementById(`${nombreCampo}-error`);

      if (elemento && errorSpan) {
        const esValido = validarCampo(nombreCampo, elemento, errorSpan);
        if (!esValido) {
          formValido = false;
          errores[nombreCampo] = errorSpan.textContent;
        }
      }
    });

    return { valido: formValido, errores };
  }

  form.addEventListener("submit", async (e) => {
    e.preventDefault();

    // Validar todos los campos antes de enviar
    const { valido, errores } = validarFormulario();

    if (!valido) {
      mostrarMensaje(
        "Por favor, complete todos los campos correctamente",
        "error"
      );
      return;
    }

    const submitBtn = form.querySelector('button[type="submit"]');
    submitBtn.disabled = true;
    submitBtn.textContent = "Enviando...";

    try {
      const formData = new FormData(form);
      const response = await fetch("guardar_denuncia.php", {
        method: "POST",
        body: formData,
      });

      if (!response.ok) {
        throw new Error("Error en la conexión con el servidor");
      }

      const resultado = await response.json();

      if (resultado.success) {
        mostrarMensaje("Denuncia enviada correctamente", "success");
        form.reset();
        closeModalform();
      } else {
        if (resultado.errors) {
          // Mostrar errores específicos en cada campo
          Object.entries(resultado.errors).forEach(([campo, mensaje]) => {
            const errorSpan = document.getElementById(`${campo}-error`);
            const elemento = document.getElementById(
              campo === "cedula" ? "Cedula" : campo
            );
            if (errorSpan && elemento) {
              errorSpan.textContent = mensaje;
              errorSpan.style.display = "block";
              elemento.classList.add("invalid");
            }
          });
        }
        throw new Error(resultado.message || "Error al procesar la denuncia");
      }
    } catch (error) {
      mostrarMensaje(error.message, "error");
      console.error("Error:", error);
    } finally {
      submitBtn.disabled = false;
      submitBtn.textContent = "Enviar tu Denuncia";
    }
  });

  function mostrarMensaje(mensaje, tipo = "info") {
    const notificacion = document.createElement("div");
    notificacion.className = `notification ${tipo}`;
    notificacion.textContent = mensaje;
    notificacion.style.position = "fixed";
    notificacion.style.top = "20px";
    notificacion.style.right = "20px";
    notificacion.style.padding = "15px";
    notificacion.style.borderRadius = "5px";
    notificacion.style.backgroundColor =
      tipo === "error" ? "#f44336" : "#4CAF50";
    notificacion.style.color = "white";
    notificacion.style.zIndex = "1000";

    document.body.appendChild(notificacion);

    setTimeout(() => {
      notificacion.style.opacity = "0";
      setTimeout(() => notificacion.remove(), 300);
    }, 3000);
  }
});
