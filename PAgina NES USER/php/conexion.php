<?php
header('Content-Type: application/json; charset=utf-8');

$host = "localhost";
$user = "root";
$pass = "";
$db = "nes";

try {
    $conn = new mysqli($host, $user, $pass, $db);

    if ($conn->connect_error) {
        throw new Exception("Error de conexión: " . $conn->connect_error);
    }

    // Establecer charset UTF-8
    $conn->set_charset("utf8mb4");

} catch (Exception $e) {
    die(json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]));
}

// Función helper para respuestas JSON
function jsonResponse($success, $message, $data = null)
{
    echo json_encode([
        'success' => $success,
        'message' => $message,
        'data' => $data
    ]);
    exit();
}
?>