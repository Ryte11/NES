<?php
header('Content-Type: application/json');

$response = ['success' => false, 'message' => '', 'errors' => []];

try {
    // Conectar a la base de datos
    $host = "localhost"; 
    $usuario = "root"; 
    $password = ""; 
    $baseDeDatos = "nes"; 

    $conn = new mysqli($host, $usuario, $password, $baseDeDatos);

    if ($conn->connect_error) {
        throw new Exception("Error de conexión: " . $conn->connect_error);
    }

    // Validar y sanitizar entrada
    $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
    $cedula = filter_input(INPUT_POST, 'cedula', FILTER_SANITIZE_STRING);
    $provincia = filter_input(INPUT_POST, 'provincia', FILTER_SANITIZE_STRING);
    $direccion = filter_input(INPUT_POST, 'direccion', FILTER_SANITIZE_STRING);
    $tipo = filter_input(INPUT_POST, 'tipo', FILTER_SANITIZE_STRING);
    $descripcion = filter_input(INPUT_POST, 'descripcion', FILTER_SANITIZE_STRING);

    // Validación de campos
    $errors = [];
    
    if (!$nombre || strlen($nombre) < 3) {
        $errors['nombre'] = 'El nombre debe tener al menos 3 caracteres';
    }

    if (!$cedula || !preg_match('/^\d{8,11}$/', $cedula)) {
        $errors['cedula'] = 'La cédula debe tener entre 8 y 11 dígitos';
    }

    if (!$provincia) {
        $errors['provincia'] = 'Debe seleccionar una provincia';
    } else {
        // Verificar que la provincia exista en la base de datos
        $stmt = $conn->prepare("SELECT nombre FROM provincias WHERE nombre = ?");
        $stmt->bind_param("s", $provincia);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows === 0) {
            $errors['provincia'] = 'La provincia seleccionada no es válida';
        }
        $stmt->close();
    }

    if (!$direccion || strlen($direccion) < 10) {
        $errors['direccion'] = 'La dirección debe ser más específica (mínimo 10 caracteres)';
    }

    // Validar tipo de denuncia
    $tipos_validos = ['bocinas', 'vehiculos', 'construccion', 'ruido'];
    if (!$tipo || !in_array($tipo, $tipos_validos)) {
        $errors['tipo'] = 'Tipo de denuncia inválido';
    }

    if (!$descripcion || strlen($descripcion) < 20) {
        $errors['descripcion'] = 'La descripción debe tener al menos 20 caracteres';
    }

    // Si hay errores, devolver respuesta con errores
    if (!empty($errors)) {
        $response['errors'] = $errors;
        $response['message'] = 'Por favor, corrija los errores en el formulario';
        echo json_encode($response);
        exit;
    }

    // Preparar y ejecutar la consulta
    $stmt = $conn->prepare("INSERT INTO denuncias_users (nombre, cedula, provincia, direccion, tipo, descripcion) VALUES (?, ?, ?, ?, ?, ?)");
    
    if (!$stmt) {
        throw new Exception("Error en la preparación de la consulta: " . $conn->error);
    }

    $stmt->bind_param("ssssss", $nombre, $cedula, $provincia, $direccion, $tipo, $descripcion);

    if ($stmt->execute()) {
        // Guardar respaldo en archivo de texto
        $directorio = 'Archivostxt';
        if (!is_dir($directorio)) {
            mkdir($directorio, 0777, true);
        }

        $archivo = $directorio . '/denuncias.txt';
        $datos = "Nombre: $nombre\nCédula: $cedula\nProvincia: $provincia\nDirección: $direccion\n" .
                "Tipo: $tipo\nDescripción: $descripcion\n" .
                "Fecha: " . date('Y-m-d H:i:s') . "\n---------------------------\n";

        if (!file_put_contents($archivo, $datos, FILE_APPEND)) {
            error_log("Error al guardar el respaldo de la denuncia en el archivo de texto");
        }

        $response['success'] = true;
        $response['message'] = "Denuncia registrada exitosamente";
    } else {
        throw new Exception("Error al ejecutar la consulta: " . $stmt->error);
    }
    
    $stmt->close();
    $conn->close();

} catch (Exception $e) {
    $response['message'] = "Error en el servidor: " . $e->getMessage();
    error_log("Error en guardar_denuncia.php: " . $e->getMessage());
}

echo json_encode($response);
?>
