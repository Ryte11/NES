/// este code es para el menu hamburguesa
const nav = document.querySelector("#nav");
const abrir = document.querySelector("#abrir");
const cerrar = document.querySelector("#cerrar");
const logo = document.getElementsByClassName("logo");

abrir.addEventListener("click", () => {
  nav.classList.add("visible");
});
cerrar.addEventListener("click", () => {
  nav.classList.remove("visible");
});

//kmkefneikfne

document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("form");
  const mensajeInput = document.getElementById("Mensaje");

  if (form) {
    form.addEventListener("submit", function (e) {
      e.preventDefault();

      const mensaje = mensajeInput.value.trim();
      if (!mensaje) {
        alert("Por favor, escribe un mensaje");
        return;
      }

      // Aquí podrías agregar una llamada a un servidor si lo necesitas
      // Por ahora, solo mostraremos una respuesta básica
      alert("Mensaje enviado: " + mensaje);

      // Limpiar el campo después de enviar
      mensajeInput.value = "";
    });
  }
});

function validar() {
  const nombre = document.getElementById("Nombre").value;
  const email = document.getElementById("Email").value;
  const mensaje = document.getElementById("Mensaje").value;

  if (!nombre || !email || !mensaje) {
    alert("Por favor, completa todos los campos");
    return false;
  }

  // Validación básica de email
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailRegex.test(email)) {
    alert("Por favor, ingresa un email válido");
    return false;
  }

  return true;
}
