<?php
session_start();

// Verifica si hay un usuario logueado
$usuario_logueado = isset($_SESSION['usuario_id']);
$nombre_usuario = $usuario_logueado ? $_SESSION['usuario_nombre'] : '';

// Esta variable se usará en JavaScript para determinar si mostrar o no ciertos elementos
?>
<script>
    // Definir una variable global para usar en nuestros scripts
    window.usuarioLogueado = <?php echo $usuario_logueado ? 'true' : 'false'; ?>;
    window.nombreUsuario = "<?php echo $nombre_usuario; ?>";
</script>