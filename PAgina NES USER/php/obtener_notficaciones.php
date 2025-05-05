
<?php
// Iniciamos sesión para acceder a los datos del usuario
session_start();

// Incluimos conexión a la base de datos
include 'conexion.php';

// Verificamos que el usuario esté logueado
if (!isset($_SESSION['usuario_id'])) {
    echo json_encode([]);
    exit;
}

$usuario_id = $_SESSION['usuario_id'];

// Consulta para obtener las notificaciones no leídas del usuario
$sql = "SELECT id, mensaje, tipo, datos_adicionales, fecha_creacion 
        FROM notificaciones 
        WHERE usuario_id = ? AND leido = 0 
        ORDER BY fecha_creacion DESC";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$resultado = $stmt->get_result();

$notificaciones = [];

if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $notificaciones[] = [
            'id' => $row['id'],
            'mensaje' => $row['mensaje'],
            'tipo' => $row['tipo'],
            'datos_adicionales' => $row['datos_adicionales'],
            'fecha' => $row['fecha_creacion']
        ];
    }
}

$stmt->close();
$conexion->close();

// Devolvemos las notificaciones en formato JSON
header('Content-Type: application/json');
echo json_encode($notificaciones);
?>