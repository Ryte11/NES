<?php
header('Content-Type: application/json');
require_once 'conexion.php'; // Asegúrate de que la ruta a tu archivo de conexión PDO sea correcta

$response = [
    'success' => false,
    'total_dispositivo' => 0,
    'total_sistema' => 0,
    'total_general' => 0,
    'message' => ''
];

try {
    // Conteo de notificaciones de dispositivo (sound_data)
    // Asumimos que cada entrada en sound_data donde db_value >= 55 es una notificación relevante.
    // Si tu tabla sound_data SOLO guarda los que superan el umbral, puedes usar COUNT(*) directamente.
    // Si guarda todos, necesitas la condición WHERE. Usaré la condición por si acaso.
    $stmt_dispositivo = $conexion->query("SELECT COUNT(*) as total FROM sound_data WHERE db_value >= 55");
    $count_dispositivo = $stmt_dispositivo->fetch(PDO::FETCH_ASSOC);
    $response['total_dispositivo'] = (int)($count_dispositivo['total'] ?? 0);

    // Conteo de notificaciones del sistema (denuncias_users)
    $stmt_sistema = $conexion->query("SELECT COUNT(*) as total FROM denuncias_users");
    $count_sistema = $stmt_sistema->fetch(PDO::FETCH_ASSOC);
    $response['total_sistema'] = (int)($count_sistema['total'] ?? 0);

    // Suma total
    $response['total_general'] = $response['total_dispositivo'] + $response['total_sistema'];
    $response['success'] = true;

} catch (PDOException $e) {
    $response['message'] = "Error de base de datos: " . $e->getMessage();
    error_log("Error en obtener_conteos_notificaciones.php (PDO): " . $e->getMessage());
} catch (Exception $e) {
    $response['message'] = "Error general: " . $e->getMessage();
    error_log("Error en obtener_conteos_notificaciones.php (General): " . $e->getMessage());
}

echo json_encode($response);
?>