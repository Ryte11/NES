<?php
session_start();
require 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['id'] = $fila['id']; // <--- Esto falta en tu login
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];

    $sql = "SELECT * FROM tecnicos WHERE usuario = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$usuario]);
    $tecnico = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($tecnico && password_verify($contraseña, $tecnico['contraseña'])) {
        $_SESSION['tecnico_id'] = $tecnico['id'];
        $_SESSION['nombre_completo'] = $tecnico['nombre_completo'];
        header("Location: ../dashboard.php");
    } else {
        echo "Usuario o contraseña incorrectos";
    }
}
?>
