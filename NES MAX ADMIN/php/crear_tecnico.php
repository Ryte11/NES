<?php
include 'conexion.php'; // Asegúrate de que este archivo contiene la conexión a la base de datos con PDO

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $usuario = $_POST['usuario'];
    $nombre_completo = $_POST['nombre_completo'];
    $cedula = $_POST['cedula'];
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT); // Hashear la contraseña

    try {
        // Validar que el usuario no exista
        $query_check = "SELECT * FROM tecnicos WHERE usuario = :usuario";
        $stmt_check = $conexion->prepare($query_check);
        $stmt_check->bindValue(':usuario', $usuario, PDO::PARAM_STR);
        $stmt_check->execute();

        if ($stmt_check->rowCount() > 0) {
            echo "<script>alert('El usuario ya existe.'); window.location='../UsuarioTecnico.html';</script>";
            exit();
        }

        // Insertar el nuevo técnico en la base de datos
        $query = "INSERT INTO tecnicos (usuario, nombre_completo, cedula, contraseña) VALUES (:usuario, :nombre_completo, :cedula, :contrasena)";
        $stmt = $conexion->prepare($query);
        $stmt->bindValue(':usuario', $usuario, PDO::PARAM_STR);
        $stmt->bindValue(':nombre_completo', $nombre_completo, PDO::PARAM_STR);
        $stmt->bindValue(':cedula', $cedula, PDO::PARAM_STR);
        $stmt->bindValue(':contrasena', $contrasena, PDO::PARAM_STR);

        if ($stmt->execute()) {
            echo "<script>alert('Técnico creado exitosamente.'); window.location='../UsuarioTecnico.html';</script>";
        } else {
            echo "<script>alert('Error al crear el técnico.'); window.location='../UsuarioTecnico.html';</script>";
        }
    } catch (PDOException $e) {
        echo "<script>alert('Error: " . $e->getMessage() . "'); window.location='../UsuarioTecnico.html';</script>";
    }
}
?>