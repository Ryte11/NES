<?php
// Este archivo debe guardarse como verificar_sesion.php

// Iniciar sesión
session_start();

// Verificar si el usuario está logueado
if (isset($_SESSION['nombre'])) {
    // Inicializar variables de JavaScript para el usuario logueado
    echo "<script>
        window.usuarioLogueado = true;
        window.nombreUsuario = '" . htmlspecialchars($_SESSION['nombre'], ENT_QUOTES, 'UTF-8') . "';
    </script>";
} else {
    // El usuario no está logueado
    echo "<script>
        window.usuarioLogueado = false;
        window.nombreUsuario = null;
    </script>";
}
?>