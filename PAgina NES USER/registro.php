<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['Usuario'] ?? '';
    $telefono = $_POST['Telefono'] ?? '';
    $correo = $_POST['pswd'] ?? '';
    $cedula = $_POST['Cedula'] ?? '';
    $contrasena = $_POST['Contraseña'] ?? '';

    if (empty($usuario) || empty($telefono) || empty($correo) || empty($cedula) || empty($contrasena)) {
        echo "Por favor, completa todos los campos.";
    } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        echo "Por favor, ingresa un correo electrónico válido.";
    } elseif (strlen($contrasena) < 8) {
        echo "La contraseña debe tener al menos 8 caracteres.";
    } else {
        echo "Registro exitoso. Bienvenido, $usuario.";
    }
} else {
    echo "Método no permitido.";
}
?>
