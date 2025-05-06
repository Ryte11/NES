<?php
header('Content-Type: application/json');

// Permitir solicitudes de cualquier origen (CORS)
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

// Verificar si es una solicitud POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Método no permitido']);
    exit;
}

// Obtener los datos enviados
$data = json_decode(file_get_contents('php://input'), true);
$mensaje = $data['mensaje'] ?? '';

// Validar que haya un mensaje
if (empty($mensaje)) {
    http_response_code(400);
    echo json_encode(['error' => 'El mensaje es requerido']);
    exit;
}

// Aquí puedes agregar la lógica de procesamiento del mensaje
// Por ahora, simplemente devolvemos una respuesta predeterminada
$respuestas = [
    'hola' => '¡Hola! ¿En qué puedo ayudarte?',
    'default' => 'Lo siento, no entiendo tu mensaje. ¿Podrías reformularlo?'
];

$respuesta = $respuestas[strtolower($mensaje)] ?? $respuestas['default'];

// Registrar la interacción para debugging
$log = date('Y-m-d H:i:s') . " - Mensaje recibido: $mensaje - Respuesta: $respuesta\n";
file_put_contents('../logs/chat.log', $log, FILE_APPEND);

// Enviar respuesta
echo json_encode([
    'status' => 'success',
    'respuesta' => $respuesta
]);
?>