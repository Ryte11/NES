document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('formConfirmar').addEventListener('submit', function(e) {
        e.preventDefault();

        const clave = this.querySelector('[name="clave_confirmacion"]').value;
        const zonaReferencia = this.querySelector('[name="zona_referencia"]').value;

        console.log('Enviando zona:', zonaReferencia); // Debug

        if (!clave || !zonaReferencia) {
            alert("Todos los campos son obligatorios.");
            return;
        }

        if (!navigator.geolocation) {
            alert("Geolocalización no soportada.");
            return;
        }

        navigator.geolocation.getCurrentPosition(function(position) {
            const lat = position.coords.latitude;
            const lng = position.coords.longitude;

            const formData = new FormData();
            formData.append('clave_confirmacion', clave);
            formData.append('zona_referencia', zonaReferencia);
            formData.append('lat', lat);
            formData.append('lng', lng);

            fetch('guardar_dispositivo.php', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                console.log('Respuesta servidor:', data); // Debug
                if (data.status === 'ok') {
                    alert(data.message);
                    location.reload();
                } else {
                    alert("Error: " + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert("Hubo un error al guardar el dispositivo.");
            });
        }, function() {
            alert("No se pudo obtener tu ubicación.");
        });
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
