<?php
session_start();
require 'php/conexion.php';

// Obtener datos del formulario
$id_tecnico = $_SESSION['id'];
$nombre_instalador = $_SESSION['nombre_completo']; // Obtener el nombre del instalador desde la sesión
$clave = $_POST['clave'];
$lat = $_POST['lat'];
$lng = $_POST['lng'];
$fecha = date('Y-m-d');

// Validar que el técnico existe
$sql = "SELECT * FROM tecnicos WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_tecnico);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows == 1) {
    $fila = $resultado->fetch_assoc();

    // Verificar contraseña
    if (password_verify($clave, $fila['contraseña'])) {
        // Zona simple por ahora (puedes automatizar con API más adelante)
        $zona = "Desconocida";

        // Crear ID único
        $id_unico = "DISP-" . uniqid();

        // Insertar en la base de datos
        // Insertar en la base de datos
        $insert = $conn->prepare("INSERT INTO dispositivos 
            (id_tecnico, nombre_instalador, id_dispositivo, fecha_instalacion, ubicacion_geografica, zona_referencia, estado_dispositivo, latitud, longitud) 
            VALUES (?, ?, ?, ?, ?, ?, 'Instalado', ?, ?)");

        if (!$insert) {
            die("Error en la consulta: " . $conn->error);
        }

        $ubicacion = "Capturada automáticamente";

        // Cadena de tipos corregida: "issssdds"
        $insert->bind_param("issssdds", $id_tecnico, $nombre_instalador, $id_unico, $fecha, $ubicacion, $zona, $lat, $lng);

        if ($insert->execute()) {
            echo "ok";
        } else {
            echo "error al insertar";
        }

    } else {
        echo "clave incorrecta";
    }

} else {
    echo "tecnico no encontrado";
}
?>