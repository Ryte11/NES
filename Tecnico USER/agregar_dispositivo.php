<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

require 'conexion.php'; // Asegúrate que tienes tu conexión a la BD aquí.

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = trim($_POST['nombre']);
    $ubicacion = trim($_POST['ubicacion']);
    $estado = $_POST['estado'];

    if (empty($nombre) || empty($ubicacion) || empty($estado)) {
        echo "Todos los campos son obligatorios.";
        exit();
    }

    // Evitar inyecciones SQL
    $stmt = $conexion->prepare("INSERT INTO dispositivos (nombre, ubicacion, estado) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nombre, $ubicacion, $estado);

    if ($stmt->execute()) {
        header("Location: dashboard.php?mensaje=dispositivo_agregado");
    } else {
        echo "Error al agregar dispositivo.";
    }

    $stmt->close();
    $conexion->close();
} else {
    header("Location: dashboard.php");
}
?>