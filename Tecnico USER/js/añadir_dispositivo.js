// Esperar a que cargue el DOM
document.addEventListener("DOMContentLoaded", function () {
    const btnAgregar = document.getElementById("btnAgregar");
    const modal = document.getElementById("modalConfirmacion");
    const btnCancelar = document.getElementById("btnCancelar");
    const btnConfirmar = document.getElementById("btnConfirmar");

    btnAgregar.addEventListener("click", () => {
        modal.style.display = "block";
    });

    btnCancelar.addEventListener("click", () => {
        modal.style.display = "none";
    });

    btnConfirmar.addEventListener("click", () => {
        const password = document.getElementById("confirmPassword").value;

        if (password.trim() === "") {
            alert("Por favor, ingresa tu contraseña.");
            return;
        }

        // Obtener geolocalización
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition((position) => {
                const lat = position.coords.latitude;
                const lng = position.coords.longitude;

                // Enviar datos al backend
                fetch("guardar_dispositivo.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        password: password,
                        latitud: lat,
                        longitud: lng
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.exito) {
                        alert("Dispositivo registrado exitosamente.");
                        modal.style.display = "none";
                        location.reload(); // opcional
                    } else {
                        alert("Error: " + data.mensaje);
                    }
                });
            }, () => {
                alert("No se pudo obtener tu ubicación.");
            });
        } else {
            alert("Tu navegador no soporta geolocalización.");
        }
    });
});


//coordenadas

document.addEventListener("DOMContentLoaded", function () {
    const siBtn = document.getElementById("siBtn");
    const popupConfirmar = document.getElementById("popupConfirmar");
    const cerrarPopup = document.getElementById("cerrarPopup");
    const guardarBtn = document.getElementById("guardarBtn");

    let latitud = null;
    let longitud = null;

    siBtn.addEventListener("click", () => {
        // Obtener la ubicación
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition((position) => {
                latitud = position.coords.latitude;
                longitud = position.coords.longitude;

                // Mostrar el popup para ingresar la contraseña
                popupConfirmar.style.display = "flex";
            }, () => {
                alert("No se pudo obtener la ubicación.");
            });
        } else {
            alert("Tu navegador no soporta geolocalización.");
        }
    });

    cerrarPopup.addEventListener("click", () => {
        popupConfirmar.style.display = "none";
    });

    guardarBtn.addEventListener("click", () => {
        const password = document.getElementById("password").value;

        if (!password) {
            alert("Debes ingresar tu contraseña.");
            return;
        }

        // Enviar los datos a PHP
        const formData = new FormData();
        formData.append("password", password);
        formData.append("latitud", latitud);
        formData.append("longitud", longitud);

        fetch("guardar_dispositivo.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            if (data.success) {
                popupConfirmar.style.display = "none";
                document.getElementById("password").value = "";
            }
        })
        .catch(error => {
            console.error("Error:", error);
        });
    });
});
