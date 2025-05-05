<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER["REQUEST_METHOD"] == "OPTIONS") {
    header("HTTP/1.1 200 OK");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$database = "nes";

$logDirectory = "registros_dispositivos/";

if (!file_exists($logDirectory)) {
    mkdir($logDirectory, 0777, true);
}

try {
    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        throw new Exception("Error de conexión: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['id'];
        $fecha = $_POST['fecha'];
        $ubicacion = $_POST['ubicacion'];
        $instalador = $_POST['instalador'];
        $estado_dispositivo = $_POST['estado-dispositivo'];

        if (empty($id) || empty($fecha) || empty($ubicacion) || empty($instalador) || empty($estado_dispositivo)) {
            throw new Exception("Todos los campos son obligatorios.");
        }

        $stmt = $conn->prepare("INSERT INTO dispositivos (id, fecha, ubicacion, instalador, estado_dispositivo) VALUES (?, ?, ?, ?, ?)");
        if (!$stmt) {
            throw new Exception("Error al preparar la consulta: " . $conn->error);
        }

        $stmt->bind_param("sssss", $id, $fecha, $ubicacion, $instalador, $estado_dispositivo);

        $logFileName = $logDirectory . date('Y-m-d') . "_registros.txt";
        $logData = "ID: $id\n";
        $logData .= "Fecha: $fecha\n";
        $logData .= "Ubicación: $ubicacion\n";
        $logData .= "Instalador: $instalador\n";
        $logData .= "Estado del dispositivo: $estado_dispositivo\n";
        $logData .= "Fecha de registro: " . date('Y-m-d H:i:s') . "\n";
        $logData .= "----------------------------------------\n";

        if (file_put_contents($logFileName, $logData, FILE_APPEND) === false) {
            throw new Exception("Error al escribir en el archivo de registro");
        }

        if ($stmt->execute()) {
            echo json_encode([
                "success" => true,
                "message" => "Datos guardados correctamente en la base de datos y archivo de registro.",
                "redirect" => "..\Dispositivo.php"
            ]);
        } else {
            throw new Exception("Error al guardar los datos: " . $stmt->error);
        }

        $stmt->close();
    } else {
        throw new Exception("Método de solicitud no permitido.");
    }
} catch (Exception $e) {
    echo json_encode(["success" => false, "message" => $e->getMessage()]);
} finally {
    if (isset($conn)) {
        $conn->close();
    }
}
?>