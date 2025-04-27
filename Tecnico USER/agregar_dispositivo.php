<?php
session_start();
if (!isset($_SESSION['tecnico_id'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Agregar Dispositivo</title>
    <script>
        // Función para obtener la ubicación automáticamente
        function obtenerUbicacion() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    document.getElementById('latitud').value = position.coords.latitude;
                    document.getElementById('longitud').value = position.coords.longitude;
                }, function (error) {
                    alert('Error al obtener ubicación: ' + error.message);
                });
            } else {
                alert('Tu navegador no soporta geolocalización.');
            }
        }

        window.onload = obtenerUbicacion;
    </script>
</head>

<body>
    <h2>Agregar Nuevo Dispositivo</h2>
    <form action="/php/agregar_dispositivo.php" method="POST">
        <label>ID del dispositivo:</label><br>
        <input type="text" name="id_dispositivo" required><br><br>

        <label>Fecha de instalación:</label><br>
        <input type="date" name="fecha_instalacion" required><br><br>

        <label>Ubicación geográfica (Dirección o Referencia):</label><br>
        <input type="text" name="ubicacion_geografica" required><br><br>

        <label>Zona de referencia:</label><br>
        <input type="text" name="zona_referencia"><br><br>

        <label>Estado del dispositivo:</label><br>
        <select name="estado_dispositivo">
            <option value="Activo">Activo</option>
            <option value="Inactivo">Inactivo</option>
            <option value="En mantenimiento">En mantenimiento</option>
        </select><br><br>

        <label>Comentario:</label><br>
        <textarea name="comentario" rows="4" cols="50"></textarea><br><br>

        <!-- Campos ocultos para latitud y longitud -->
        <input type="hidden" id="latitud" name="latitud" required>
        <input type="hidden" id="longitud" name="longitud" required>

        <button type="submit">Agregar dispositivo</button>
    </form>

    <br><br>
    <a href="dashboard.php">← Volver al dashboard</a>
</body>

</html>