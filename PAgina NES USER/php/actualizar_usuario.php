<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['success' => false, 'message' => 'No hay sesión activa']);
    exit;
}

include 'conexion.php'; 

// Verificar conexión
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Error de conexión a la base de datos']);
    exit;
}

// Obtener datos del formulario
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$password = $_POST['password'];

// Obtener ID del usuario de la sesión
$usuario_id = $_SESSION['usuario_id'];

// Actualizar nombre y email (siempre)
$query = "UPDATE usuarios_users SET nombre = ?, email = ?";
$params = [$nombre, $email];
$types = "ss";

// Si se proporcionó una nueva contraseña, actualizarla también
if (!empty($password)) {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $query .= ", contraseña = ?";
    $params[] = $hashed_password;
    $types .= "s";
}

// Completar la consulta con la cláusula WHERE
$query .= " WHERE id = ?";
$params[] = $usuario_id;
$types .= "i";

// Preparar y ejecutar la consulta
$stmt = $conn->prepare($query);
$stmt->bind_param($types, ...$params);
$result = $stmt->execute();

if ($result) {
    // También actualizar el nombre en la sesión
    $_SESSION['usuario_nombre'] = $nombre;

    echo json_encode(['success' => true, 'message' => 'Datos actualizados correctamente']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al actualizar los datos: ' . $stmt->error]);
}

$conn->close();
?>