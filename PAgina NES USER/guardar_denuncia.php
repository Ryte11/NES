<?php
header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];

try {
    $host = "localhost"; 
    $usuario = "root"; 
    $password = ""; 
    $baseDeDatos = "nes"; 

    $conn = new mysqli($host, $usuario, $password, $baseDeDatos);

    if ($conn->connect_error) {
        throw new Exception("Error de conexión: " . $conn->connect_error);
    }

    // Validate and sanitize input
    $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
    $cedula = filter_input(INPUT_POST, 'cedula', FILTER_SANITIZE_STRING);
    $provincia = filter_input(INPUT_POST, 'provincia', FILTER_SANITIZE_STRING);
    $ubicacion = filter_input(INPUT_POST, 'ubicacion', FILTER_SANITIZE_STRING);
    $tipo = filter_input(INPUT_POST, 'tipo', FILTER_SANITIZE_STRING);
    $descripcion = filter_input(INPUT_POST, 'descripcion', FILTER_SANITIZE_STRING);
    $severidad = filter_input(INPUT_POST, 'severidad', FILTER_SANITIZE_STRING) ?? 'media';

    // Validation rules
    $validationErrors = [];
    
    if (strlen($nombre) < 3) {
        $validationErrors[] = "El nombre debe tener al menos 3 caracteres";
    }
    
    
    if (empty($provincia)) {
        $validationErrors[] = "La provincia es requerida";
    }
    
    if (strlen($ubicacion) < 10) {
        $validationErrors[] = "La ubicación debe ser más específica";
    }
    
    // Define valid complaint types
    $validTipos = ['bocinas', 'vehiculos', 'construccion', 'ruido'];
    if (!in_array($tipo, $validTipos)) {
        $validationErrors[] = "Tipo de denuncia inválido";
    }
    
    if (strlen($descripcion) < 20) {
        $validationErrors[] = "La descripción debe tener al menos 20 caracteres";
    }

    if (!empty($validationErrors)) {
        throw new Exception(implode(", ", $validationErrors));
    }

    // Prepare statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO denuncias (nombre, cedula, provincia, ubicacion, tipo, severidad, descripcion, fecha, estado) VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), 'pendiente')");
    
    if (!$stmt) {
        throw new Exception("Error en la preparación de la consulta: " . $conn->error);
    }

$sql->bind_param("sssss", $nombre, $cedula, $ubicacion, $tipo, $descripcion);

if ($sql->execute()) {
    echo "<script>
        alert('Denuncia guardada correctamente.');
        window.location.href = 'Denuncias-html.php'; // Cambia según la página que quieras redirigir
    </script>";
} else {
    echo "Error al ejecutar la consulta: " . $conn->error;
}

$directorio = 'Archivostxt';
if (!is_dir($directorio)) {
    mkdir($directorio, 0777, true); // Crea la carpeta si no existe
}

    $archivo = $directorio . '/denuncias.txt';
    $datos = "Nombre: $nombre\nCédula: $cedula\nProvincia: $provincia\nUbicación: $ubicacion\n" .
            "Tipo: $tipo\nSeveridad: $severidad\nDescripción: $descripcion\n" .
            "Fecha: " . date('Y-m-d H:i:s') . "\nEstado: pendiente\n---------------------------\n";

    if (!file_put_contents($archivo, $datos, FILE_APPEND)) {
        error_log("Error al guardar el respaldo de la denuncia en el archivo de texto");
    }

    $response['success'] = true;
    $response['message'] = "Denuncia registrada exitosamente";
    
    // Close statement and connection
    $stmt->close();
    $conn->close();

} catch (Exception $e) {
    $response['message'] = $e->getMessage();
    error_log("Error en guardar_denuncia.php: " . $e->getMessage());
}

echo json_encode($response);
?>
