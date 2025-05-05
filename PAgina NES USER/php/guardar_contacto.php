<?php
require_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    jsonResponse(false, 'Método no permitido');
}

if (empty($_POST['nombre']) || empty($_POST['email']) || empty($_POST['mensaje'])) {
    jsonResponse(false, 'Todos los campos son requeridos');
}

try {
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $email = $conn->real_escape_string($_POST['email']);
    $mensaje = $conn->real_escape_string($_POST['mensaje']);

    $sql = "INSERT INTO contactos (nombre, email, mensaje) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nombre, $email, $mensaje);

    if ($stmt->execute()) {
        jsonResponse(true, 'Mensaje enviado correctamente');
    } else {
        throw new Exception('Error al guardar el mensaje');
    }

} catch (Exception $e) {
    jsonResponse(false, $e->getMessage());
}
?>