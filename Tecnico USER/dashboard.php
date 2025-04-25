<?php
session_start();
if (!isset($_SESSION['tecnico_id'])) {
    header("Location: index.php");
    exit();
}
?>

<h1>Bienvenido, <?php echo $_SESSION['nombre_completo']; ?></h1>
<button onclick="location.href='agregar_dispositivo.php'">Agregar dispositivo</button>
<br><br>
<a href="mapa.php">Ver dispositivos en mapa</a>