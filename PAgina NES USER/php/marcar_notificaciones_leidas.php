<?php
// Iniciamos sesión para acceder a los datos del usuario
session_start();

// Incluimos conexión a la base de datos
include 'conexion.php';

// Verificamos que el usuario esté logueado
if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['success' => false, 'message' => 'Usuario no autenticado']);
    exit;
}

$usuario_id = $_SESSION['usuario_id'];

// Marcar todas las notificaciones como leídas
$sql = "UPDATE notificaciones SET leido = 1 WHERE usuario_id = ? AND leido = 0";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();

// Verificamos si se actualizó alguna fila
$filas_afectadas = $stmt->affected_rows;

$stmt->close();
$conexion->close();

// Devolvemos la respuesta
header('Content-Type: application/json');
echo json_encode([
    'success' => true,
    'message' => 'Notificaciones marcadas como leídas',
    'count' => $filas_afectadas
]);
?>