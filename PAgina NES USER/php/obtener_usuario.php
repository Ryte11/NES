<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario_id'])) {
    // Si no hay sesión activa, devolver error
    echo json_encode(['error' => 'No hay sesión activa']);
    exit;
}

include 'conexion.php'; // Asegúrate de que la ruta sea correcta
// Verificar conexión
if ($conn->connect_error) {
    echo json_encode(['error' => 'Error de conexión a la base de datos']);
    exit;
}

// Obtener ID del usuario de la sesión
$usuario_id = $_SESSION['usuario_id'];

// Preparar consulta
$stmt = $conn->prepare("SELECT nombre, email FROM usuarios_users WHERE id = ?");
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Obtener datos del usuario
    $usuario = $result->fetch_assoc();

    // Devolver datos en formato JSON
    header('Content-Type: application/json');
    echo json_encode($usuario);
} else {
    echo json_encode(['error' => 'Usuario no encontrado']);
}

$conn->close();
?>