<?php
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
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel del Técnico</title>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <style>
        .logout-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: #dc3545;
            /* Rojo */
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .logout-btn:hover {
            background-color: #a71d2a;
            /* Rojo más oscuro */
        }
    </style>
</head>

<body>
    <header>
        <h2>Bienvenido, <?php echo htmlspecialchars($nombre_completo); ?></h2>
        <form action="php/logout.php" method="POST" style="display: inline;">
            <button type="submit" class="logout-btn">Cerrar sesión</button>
        </form>
    </header>

    <div class="dashboard">
        <h2>Resumen de Instalaciones</h2>
        <div class="stats">
            <div>
                <h3>Dispositivos Instalados</h3>
                <p><?php echo $total_dispositivos; ?></p>
            </div>
            <div>
                <h3>Nombre Completo</h3>
                <p><?php echo htmlspecialchars($nombre_completo); ?></p>
            </div>
        </div>

        <h3>Lista de Dispositivos Instalados</h3>
        <table>
            <thead>
                <tr>
                    <th>ID del Dispositivo</th>
                    <th>Fecha de Instalación</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result_dispositivos->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id_dispositivo']); ?></td>
                        <td><?php echo htmlspecialchars($row['fecha_instalacion']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <button class="btn-azul" id="btnAgregar">➕ Añadir dispositivo</button>
    </div>

    <div id="mapa"></div>

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

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Panel del Técnico. Todos los derechos reservados.</p>
    </footer>

    <script>
        // Mostrar mapa y cargar dispositivos
        const map = L.map('mapa').setView([18.7357, -70.1627], 8); // RD por defecto

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        fetch('obtener_dispositivos.php?id_tecnico=<?php echo $id_tecnico; ?>')
            .then(res => res.json())
            .then(data => {
                data.forEach(d => {
                    L.marker([d.latitud, d.longitud])
                        .addTo(map)
                        .bindPopup(`<b>ID:</b> ${d.id_dispositivo}<br><b>Zona:</b> ${d.zona_referencia} <br><b>Fecha de Instalación:</b> ${d.fecha_instalacion}`);
                });
            });

        document.getElementById('btnAgregar').addEventListener('click', () => {
            document.getElementById('popupConfirmar').style.display = 'flex';
        });

        document.getElementById('formConfirmar').addEventListener('submit', function (e) {
            e.preventDefault();

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
                        if (data.trim() === "ok") {
                            alert("Dispositivo guardado correctamente!");
                            cerrarPopup();
                            location.reload();
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

        function cerrarPopup() {
            document.getElementById('popupConfirmar').style.display = 'none';
        }
    </script>
</body>

</html>