<?php
// Este archivo debe guardarse como get_user_profile.php

// Iniciar sesión
session_start();

// Configuración de cabeceras
header('Content-Type: application/json');

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['nombre'])) {
    echo json_encode([
        'success' => false,
        'message' => 'No hay sesión activa'
    ]);
    exit;
}

// Conectar a la base de datos
$host = "localhost";
$dbname = "nes";
$username = "root";
$dbpassword = "";

try {
    // Crear conexión PDO
    $conn = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $username,
        $dbpassword,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    // Obtener nombre de usuario de la sesión
    $nombre = $_SESSION['nombre'];

    // Consultar la base de datos
    $stmt = $conn->prepare("SELECT nombre, email, imagen_perfil FROM usuarios WHERE nombre = :nombre");
    $stmt->execute(['nombre' => $nombre]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
        // Verificar si existe una imagen de perfil, si no, usar una por defecto
        if (empty($usuario['imagen_perfil']) || !file_exists("../uploads/profile/" . $usuario['imagen_perfil'])) {
            $usuario['imagen_perfil'] = 'default_profile.png';
        }

        echo json_encode([
            'success' => true,
            'data' => $usuario
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Usuario no encontrado'
        ]);
    }

} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error: ' . $e->getMessage()
    ]);
}
?>