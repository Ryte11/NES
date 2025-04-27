<?php
require 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $nombre_completo = $_POST['nombre_completo'];
    $cedula = $_POST['cedula'];
    $contraseña = password_hash($_POST['contraseña'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO tecnicos (usuario, nombre_completo, cedula, contraseña) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$usuario, $nombre_completo, $cedula, $contraseña]);

    echo "Usuario registrado correctamente";
}
?>
