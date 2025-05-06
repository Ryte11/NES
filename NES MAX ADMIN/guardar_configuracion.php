<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "nes");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener los valores enviados desde el formulario
$modoOscuro = isset($_POST['modoOscuro']) ? 1 : 0;
$idioma = isset($_POST['idioma']) ? $_POST['idioma'] : 'es'; // Valor predeterminado: 'es'
$notificacionesEmail = isset($_POST['notificacionesEmail']) ? 1 : 0;
$notificacionesPush = isset($_POST['notificacionesPush']) ? 1 : 0;

// Insertar o actualizar los valores en la base de datos
$sql = "INSERT INTO configuraciones (usuario_id, modo_oscuro, idioma, notificaciones_email, notificaciones_push)
        VALUES (1, $modoOscuro, '$idioma', $notificacionesEmail, $notificacionesPush)
        ON DUPLICATE KEY UPDATE 
        modo_oscuro = $modoOscuro, 
        idioma = '$idioma', 
        notificaciones_email = $notificacionesEmail, 
        notificaciones_push = $notificacionesPush";

if ($conexion->query($sql) === TRUE) {
    // Redirigir a configuracionhtml después de guardar
    header("Location: Configuracion.php");
    exit();
} else {
    echo "Error al guardar la configuración: " . $conexion->error;
}

$conexion->close();
?>