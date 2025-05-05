<?php
session_start();
require 'php/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener datos del formulario
    $id_tecnico = $_SESSION['id'];
    $nombre_instalador = $_SESSION['nombre_completo'];
    $clave = $_POST['clave_confirmacion']; // Changed from 'clave'
    $zona_referencia = $_POST['zona_referencia'];
    $lat = $_POST['lat'];
    $lng = $_POST['lng'];
    $fecha = date('Y-m-d');

    // Debug log
    error_log("Datos recibidos: " . print_r($_POST, true));

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
            // Crear ID único
            $id_unico = "DISP-" . uniqid();
            
            // Insertar en la base de datos
            $insert = $conn->prepare("INSERT INTO dispositivos 
                (id_tecnico, nombre_instalador, id_dispositivo, fecha_instalacion, 
                 ubicacion_geografica, zona_referencia, estado_dispositivo, latitud, longitud) 
                VALUES (?, ?, ?, ?, ?, ?, 'Instalado', ?, ?)");

            if (!$insert) {
                die("Error en la consulta: " . $conn->error);
            }

            $ubicacion = "Capturada automáticamente";
            
            $insert->bind_param("isssssdd", 
                $id_tecnico, 
                $nombre_instalador, 
                $id_unico, 
                $fecha, 
                $ubicacion,
                $zona_referencia,
                $lat, 
                $lng
            );

            if ($insert->execute()) {
                echo json_encode(['status' => 'ok', 'message' => 'Dispositivo guardado correctamente']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Error al insertar: ' . $insert->error]);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Clave incorrecta']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Técnico no encontrado']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método no permitido']);
}
?>