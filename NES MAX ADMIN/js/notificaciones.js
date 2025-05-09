// En c:\xampp\htdocs\NES\NES MAX ADMIN\js\PanelControl.js (o js\notificaciones.js)

document.addEventListener("DOMContentLoaded", function () {
  const notificacionesIconContainer = document.getElementById("Notificaciones"); // El div que contiene el SVG y el badge
  const notificacionesDropdown = notificacionesIconContainer
    ? notificacionesIconContainer.querySelector(".notificaciones-container")
    : null;
  const notificationCountBadge = document.getElementById(
    "notificationCountBadge"
  );
  const notifCountDispositivoEl = document.getElementById(
    "notifCountDispositivo"
  );
  const notifCountSistemaEl = document.getElementById("notifCountSistema");

  // Elementos de categoría para hacerlos clickables
  const categoryDispositivo = document.getElementById("categoryDispositivo");
  const categorySistema = document.getElementById("categorySistema");

  function fetchNotificationCounts() {
    if (
      !notificationCountBadge ||
      !notifCountDispositivoEl ||
      !notifCountSistemaEl
    ) {
      // Si los elementos no existen en la página actual, no hacer nada.
      // Esto puede pasar si alguna página no tiene la estructura completa de notificaciones.
      // console.warn("Elementos de notificación no encontrados en esta página.");
      return;
    }

    fetch("php/obtener_conteos_notificaciones.php")
      .then((response) => {
        if (!response.ok) {
          throw new Error("Respuesta de red no fue ok: " + response.statusText);
        }
        return response.json();
      })
      .then((data) => {
        if (data.success) {
          const totalGeneral = data.total_general || 0;
          const totalDispositivo = data.total_dispositivo || 0;
          const totalSistema = data.total_sistema || 0;

          notificationCountBadge.textContent =
            totalGeneral > 99 ? "99+" : totalGeneral;
          notificationCountBadge.style.display =
            totalGeneral > 0 ? "inline-block" : "none";

          notifCountDispositivoEl.textContent = `(${totalDispositivo})`;
          notifCountSistemaEl.textContent = `(${totalSistema})`;
        } else {
          console.error(
            "Error al obtener conteos de notificaciones:",
            data.message
          );
          notificationCountBadge.style.display = "none";
        }
      })
      .catch((error) => {
        console.error("Error en fetch para notificaciones:", error);
        if (notificationCountBadge)
          notificationCountBadge.style.display = "none";
      });
  }

  if (notificacionesIconContainer && notificacionesDropdown) {
    // Cargar conteos al inicio
    fetchNotificationCounts();

    // Toggle para mostrar/ocultar el dropdown
    notificacionesIconContainer.addEventListener("click", function (event) {
      event.stopPropagation();
      notificacionesIconContainer.classList.toggle("active");
    });

    // Cerrar dropdown si se hace clic fuera
    document.addEventListener("click", function (event) {
      if (
        notificacionesIconContainer.classList.contains("active") &&
        !notificacionesIconContainer.contains(event.target)
      ) {
        notificacionesIconContainer.classList.remove("active");
      }
    });

    // Navegación al hacer clic en las categorías (opcional, puedes adaptarlo)
    if (categoryDispositivo) {
      categoryDispositivo.addEventListener("click", function () {
        window.location.href = "Dispositivo.php"; // O la página que muestre detalles de dispositivos
      });
    }

    if (categorySistema) {
      categorySistema.addEventListener("click", function () {
        window.location.href = "Alertas.php"; // O la página que muestre detalles de denuncias/alertas del sistema
      });
    }
  } else {
    // console.log("Contenedor de notificaciones o dropdown no encontrado. La funcionalidad de notificaciones no se activará en esta página.");
  }

  // Si tienes un enlace de "Notificaciones" en el menú lateral que también debe abrir esto:
  const menuNotificacionesLink = document.getElementById("menuNotificaciones");
  if (menuNotificacionesLink && notificacionesIconContainer) {
    menuNotificacionesLink.addEventListener("click", function (event) {
      event.preventDefault();
      notificacionesIconContainer.classList.toggle("active");
      // Opcional: scroll hacia la parte superior para ver el header si es necesario
      // window.scrollTo(0, 0);
    });
  }

  // Actualizar notificaciones periódicamente (opcional, descomentar si lo necesitas)
  // setInterval(fetchNotificationCounts, 30000); // Cada 30 segundos
});
