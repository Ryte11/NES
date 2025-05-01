<?php
// Este archivo debe guardarse como update_profile.php

// Iniciar sesión
session_start();

// Configuración de cabeceras
header('Content-Type: application/json');

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['nombre'])) {
    echo json_encode([
        'success' => false,
        'message' => 'No hay sesión activa'
    ]);
    exit;
}

// Conectar a la base de datos
$host = "localhost";
$dbname = "nes";
$username = "root";
$dbpassword = "";

try {
    // Crear conexión PDO
    $conn = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $username,
        $dbpassword,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    // Obtener nombre de usuario actual de la sesión
    $nombreActual = $_SESSION['nombre'];

    // Obtener datos del formulario
    $nuevoNombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);

    // Variable para almacenar el nombre de archivo de la imagen
    $nombreArchivo = null;

    // Manejar la subida de la imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        // Directorio donde se guardarán las imágenes
        $directorioDestino = '../uploads/profile/';

        // Crear el directorio si no existe
        if (!file_exists($directorioDestino)) {
            mkdir($directorioDestino, 0755, true);
        }

        // Obtener la extensión del archivo
        $extension = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);

        // Generar un nombre único para evitar colisiones
        $nombreArchivo = uniqid('profile_') . '.' . $extension;

        // Ruta completa del archivo
        $rutaCompleta = $directorioDestino . $nombreArchivo;

        // Tipos de imágenes permitidos
        $tiposPermitidos = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];

        // Verificar el tipo de archivo
        if (!in_array($_FILES['imagen']['type'], $tiposPermitidos)) {
            echo json_encode([
                'success' => false,
                'message' => 'Solo se permiten archivos de imagen (JPEG, PNG, GIF)'
            ]);
            exit;
        }

        // Mover el archivo subido al directorio de destino
        if (!move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaCompleta)) {
            echo json_encode([
                'success' => false,
                'message' => 'Error al subir la imagen'
            ]);
            exit;
        }
    }

    // Iniciar la consulta SQL
    $sql = "UPDATE usuarios SET ";
    $params = [];

    // Añadir cambio de nombre si se proporcionó
    if (!empty($nuevoNombre)) {
        $sql .= "nombre = :nuevoNombre";
        $params['nuevoNombre'] = $nuevoNombre;

        // Actualizar la sesión con el nuevo nombre
        $_SESSION['nombre'] = $nuevoNombre;
    }

    // Añadir cambio de imagen si se subió una
    if ($nombreArchivo !== null) {
        if (!empty($params)) {
            $sql .= ", ";
        }
        $sql .= "imagen_perfil = :imagen";
        $params['imagen'] = $nombreArchivo;
    }

    // Finalizar la consulta SQL
    $sql .= " WHERE nombre = :nombreActual";
    $params['nombreActual'] = $nombreActual;

    // Verificar si hay algo que actualizar
    if (empty($params) || count($params) === 1) { // Solo existe nombreActual
        echo json_encode([
            'success' => false,
            'message' => 'No se proporcionaron datos para actualizar'
        ]);
        exit;
    }

    // Preparar y ejecutar la consulta
    $stmt = $conn->prepare($sql);
    $result = $stmt->execute($params);

    if ($result) {
        // Obtener los datos actualizados para devolverlos
        $stmtGet = $conn->prepare("SELECT nombre, imagen_perfil FROM usuarios WHERE nombre = :nombre");
        $stmtGet->execute(['nombre' => !empty($nuevoNombre) ? $nuevoNombre : $nombreActual]);
        $usuarioActualizado = $stmtGet->fetch(PDO::FETCH_ASSOC);

        echo json_encode([
            'success' => true,
            'message' => 'Perfil actualizado correctamente',
            'data' => $usuarioActualizado
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Error al actualizar el perfil'
        ]);
    }

} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error: ' . $e->getMessage()
    ]);
}
?>