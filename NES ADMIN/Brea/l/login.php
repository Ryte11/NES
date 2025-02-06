<?php
// process_login.php

$validUserId = "admin";
$validPassword = "admin123";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $userId = $_POST['userId'];
    $password = $_POST['password'];

    if ($userId === $validUserId && $password === $validPassword) {
        echo "Inicio de sesión exitoso";
    } else {
        echo "El ID o la contraseña son incorrectos";
    }
}
?>
