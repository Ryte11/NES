<?php
<<<<<<< HEAD
session_start();
require 'php/conexion.php';

// Obtener todos los dispositivos
$sql = "SELECT * FROM dispositivos";
$stmt = $pdo->query($sql);
$dispositivos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Mapa de Dispositivos</title>
    <style>
        #map {
            height: 600px;
            width: 100%;
=======
    session_start();
    if (!isset($_SESSION['usuario'])) {
        header("Location: index.php");
        exit();
    }

    require 'php/conexion.php';

    // Obtener el ID del técnico desde la sesión
    $id_tecnico = $_SESSION['id'];
    $nombre_completo = $_SESSION['nombre_completo'];

    // Consultar la cantidad de dispositivos instalados
    $sql_count = "SELECT COUNT(*) AS total FROM dispositivos WHERE id_tecnico = ?";
    $stmt_count = $conn->prepare($sql_count);
    $stmt_count->bind_param("i", $id_tecnico);
    $stmt_count->execute();
    $result_count = $stmt_count->get_result();
    $total_dispositivos = $result_count->fetch_assoc()['total'];

    // Consultar los dispositivos instalados
    $sql_dispositivos = "SELECT id_dispositivo, fecha_instalacion FROM dispositivos WHERE id_tecnico = ?";
    $stmt_dispositivos = $conn->prepare($sql_dispositivos);
    $stmt_dispositivos->bind_param("i", $id_tecnico);
    $stmt_dispositivos->execute();
    $result_dispositivos = $stmt_dispositivos->get_result();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapa general</title>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 0;
            margin: 0;
            background-color: #f3f3f3;
        }

        header {
            background: #004aad;
            color: white;
            padding: 1em;
            text-align: center;
        }

        #btnAgregar {
            margin: 20px;
            padding: 15px 25px;
            background: #28a745;
            color: white;
            border: none;
            font-size: 16px;
            cursor: pointer;
            border-radius: 8px;
        }

        #mapa,
        #mapaPersonal {
            height: 500px;
            width: 95%;
            margin: 0 auto;
            border: 2px solid #ddd;
            border-radius: 10px;
        }

        .popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            background: rgba(0, 0, 0, 0.6);
            justify-content: center;
            align-items: center;
        }

        .popup-content {
            background: white;
            padding: 2em;
            border-radius: 10px;
            text-align: center;
            max-width: 400px;
            width: 90%;
        }

        .popup-content input {
            padding: 10px;
            margin: 10px;
            width: 90%;
>>>>>>> 9d6718ae2c90670f587fc7cc331cec67857e0bea
        }
    </style>
</head>

<body>

<<<<<<< HEAD
    <h2>Mapa de Dispositivos Instalados</h2>

    <div id="map"></div>

    <br>
    <a href="dashboard.php">← Volver al dashboard</a>

    <script>
        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: { lat: 18.7357, lng: -70.1627 }, // Centro República Dominicana
                zoom: 7
            });

            var dispositivos = <?php echo json_encode($dispositivos); ?>;

            dispositivos.forEach(function (dispositivo) {
                var marker = new google.maps.Marker({
                    position: { lat: parseFloat(dispositivo.latitud), lng: parseFloat(dispositivo.longitud) },
                    map: map,
                    title: dispositivo.id_dispositivo + " - " + dispositivo.ubicacion_geografica
                });
            });
        }
    </script>

    <!-- Llamar a la API de Google Maps -->
    <script src="https://maps.googleapis.com/maps/api/js?key=TU_API_KEY&callback=initMap" async defer></script>

=======
    <main>
        <button id="btnAgregar">➕ Agregar dispositivo</button>
        <div id="mapa"></div>
    </main>

    <!-- Pop-up -->
    <div class="popup" id="popupConfirmar">
        <div class="popup-content">
            <h3>¿Confirmas que se ha instalado el dispositivo?</h3>
            <form id="formConfirmar" method="POST">
                <input type="password" name="clave_confirmacion" placeholder="Confirma tu contraseña" required />
                <button type="submit">Sí, confirmar</button>
                <button type="button" onclick="cerrarPopup()">Cancelar</button>
            </form>
        </div>
    </div>



    <script>



        // form y no se que mapaPersonal
        document.getElementById('formConfirmar').addEventListener('submit', function (e) {
            e.preventDefault(); // ⚡️ Evita que se mande el formulario normal

            const clave = this.clave_confirmacion.value;

            if (!clave) {
                alert("Debes poner tu contraseña.");
                return;
            }

            if (!navigator.geolocation) {
                alert("Geolocalización no soportada.");
                return;
            }

            navigator.geolocation.getCurrentPosition(function (position) {
                const lat = position.coords.latitude;
                const lng = position.coords.longitude;

                const formData = new FormData();
                formData.append('clave', clave);
                formData.append('lat', lat);
                formData.append('lng', lng);

                fetch('guardar_dispositivo.php', {
                    method: 'POST',
                    body: formData
                })
                    .then(res => res.text())
                    .then(data => {
                        console.log(data); // Para que veas qué responde el PHP
                        if (data.trim() === "ok") {
                            alert("Dispositivo guardado correctamente!");
                            cerrarPopup();
                            location.reload(); // Recargar para que aparezca en el mapa
                        } else {
                            alert("Error: " + data);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert("Hubo un error.");
                    });

            }, function () {
                alert("No se pudo obtener tu ubicación.");
            });
        });

        document.getElementById('btnAgregar').addEventListener('click', () => {
            document.getElementById('popupConfirmar').style.display = 'flex';
        });

        function cerrarPopup() {
            document.getElementById('popupConfirmar').style.display = 'none';
        }

        // Mostrar mapa y cargar dispositivos
        const map = L.map('mapa').setView([18.7357, -70.1627], 8); // RD por defecto

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        fetch('obtener_dispositivos.php')
            .then(res => res.json())
            .then(data => {
                data.forEach(d => {
                    L.marker([d.latitud, d.longitud])
                        .addTo(map)
                        .bindPopup(`<b>ID:</b> ${d.id_dispositivo}<br><b>Zona:</b> ${d.zona_referencia} <br><b>Fecha de Instalación:</b></br> ${d.fecha_instalacion} <br><b>Nombre del instalador:</b></br> ${d.nombre_instalador}`);
                });
            });
    </script>
>>>>>>> 9d6718ae2c90670f587fc7cc331cec67857e0bea
</body>

</html>