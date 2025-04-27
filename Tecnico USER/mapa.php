<?php
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
        }
    </style>
</head>

<body>

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

</body>

</html>