<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

error_log("Datos POST recibidos: " . print_r($_POST, true));

if ($_SERVER["REQUEST_METHOD"] == "OPTIONS") {
    header("HTTP/1.1 200 OK");
    exit();
}

$host = "localhost";
$usuario = "root";
$password = "";
$baseDeDatos = "nes";
$conn = new mysqli($host, $usuario, $password, $baseDeDatos);

if ($conn->connect_error) {
    error_log("Error de conexión MySQL: " . $conn->connect_error);
    echo json_encode(['success' => false, 'message' => "Error de conexión: " . $conn->connect_error]);
    exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    error_log("Nombre recibido: " . ($_POST['nombre'] ?? 'no definido'));
    error_log("Email recibido: " . ($_POST['email'] ?? 'no definido'));
    error_log("Password recibido: " . (isset($_POST['password']) ? 'definido' : 'no definido'));

    $nombre = $_POST['nombre'] ?? null;
    $email = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null;
    $rol = 'admin';

 
    if (empty($nombre) || empty($email) || empty($password)) {
        $campos_faltantes = [];
        if (empty($nombre)) $campos_faltantes[] = 'nombre';
        if (empty($email)) $campos_faltantes[] = 'email';
        if (empty($password)) $campos_faltantes[] = 'password';
        
        error_log("Campos faltantes: " . implode(', ', $campos_faltantes));
        echo json_encode([
            'success' => false, 
            'message' => "Los siguientes campos son obligatorios: " . implode(', ', $campos_faltantes)
        ]);
        exit();
    }

   
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO usuarios (nombre, email, password, rol) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        error_log("Error en prepare: " . $conn->error);
        echo json_encode(['success' => false, 'message' => "Error al preparar la consulta: " . $conn->error]);
        exit();
    }

    $stmt->bind_param("ssss", $nombre, $email, $passwordHash, $rol);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => "Usuario administrador registrado correctamente."]);
    } else {
        error_log("Error en execute: " . $stmt->error);
        echo json_encode(['success' => false, 'message' => "Error al guardar los datos: " . $stmt->error]);
    }


    $directorio = 'Archivostxt';
    if (!is_dir($directorio)) {
        mkdir($directorio, 0777, true); 
    }

    $archivo = $directorio . '/usuarios_admin.txt';
    $datos = "Nombre: $nombre\nEmail: $email\nRol: $rol\nFecha de Registro: " . date('Y-m-d H:i:s') . "\n---------------------------\n";

    if (file_put_contents($archivo, $datos, FILE_APPEND)) {
        error_log("Datos guardados en $archivo");
    } else {
        error_log("Error al guardar los datos en el archivo.");
    }
    

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => "Método de solicitud no permitido."]);
}

$conn->close();
?>