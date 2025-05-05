<?php
session_start();
include 'conexion.php';

// Helper function if not defined elsewhere
if (!function_exists('debug_to_file')) {
    function debug_to_file($data)
    {
        $file = __DIR__ . '/debug_log.txt';
        $output = date('[Y-m-d H:i:s] ') . print_r($data, true) . "\n";
        file_put_contents($file, $output, FILE_APPEND);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Start a single transaction
        $conexion->beginTransaction();

        $contacto_id = $_POST['contacto_id'];
        $accion = $_POST['accion'];

        // Obtener datos del contacto
        $sql_contacto = "SELECT * FROM contactos WHERE id = ?";
        $stmt_contacto = $conexion->prepare($sql_contacto);
        $stmt_contacto->execute([$contacto_id]);
        $contacto = $stmt_contacto->fetch(PDO::FETCH_ASSOC);

        if (!$contacto) {
            throw new Exception("Contacto no encontrado");
        }

        $email_destinatario = $contacto['email'];
        $nombre_destinatario = $contacto['nombre'];
        $usuario_id = $contacto['usuario_id'];

        // NUEVO: Validación crítica del usuario_id
        if (empty($usuario_id)) {
            // Verificar si hay un ID de usuario asociado en algún otro campo del contacto
            // Por ejemplo, podría estar en otro campo como 'user_id' o similar
            debug_to_file(['ALERTA' => 'usuario_id está vacío en la tabla contactos', 'contacto' => $contacto]);

            // Si no podemos continuar sin un usuario_id válido:
            throw new Exception("No se puede enviar la notificación: el contacto no tiene un usuario asociado");

            // O alternativa: Usar un ID de usuario genérico para notificaciones del sistema
            // $usuario_id = 1; // ID de un usuario del sistema o administrador
        }

        // Marcamos como visto
        $sql_update = "UPDATE contactos SET estado = 'Visto' WHERE id = ?";
        $stmt_update = $conexion->prepare($sql_update);
        $stmt_update->execute([$contacto_id]);

        // Obtener el nombre del administrador que responde
        $admin_nombre = $_SESSION['usuario_nombre'] ?? 'Administrador';

        if ($accion == 'responder') {
            $respuesta = $_POST['respuesta'];
            $mensaje_notificacion = "Tu mensaje ha sido respondido por $admin_nombre.";
            $tipo_notificacion = "contacto_respondido";
            $datos_adicionales = json_encode([
                'contacto_id' => $contacto_id,
                'respuesta' => $respuesta
            ]);
        } else {
            // Solo marcar como visto
            $mensaje_notificacion = "Tu mensaje ha sido revisado por $admin_nombre.";
            $tipo_notificacion = "contacto_visto";
            $datos_adicionales = json_encode(['contacto_id' => $contacto_id]);
        }

        // Log what we're about to do
        debug_to_file([
            'usuario_id' => $usuario_id,
            'mensaje' => $mensaje_notificacion,
            'tipo' => $tipo_notificacion,
            'datos' => $datos_adicionales
        ]);

        // Consistent parameter binding - using positional parameters
        $sql_notificacion = "INSERT INTO notificaciones (usuario_id, mensaje, tipo, datos_adicionales, leido) 
                           VALUES (?, ?, ?, ?, 0)";
        $stmt_notificacion = $conexion->prepare($sql_notificacion);
        $result = $stmt_notificacion->execute([
            $usuario_id,
            $mensaje_notificacion,
            $tipo_notificacion,
            $datos_adicionales
        ]);

        if (!$result) {
            throw new Exception("Error al insertar la notificación: " . implode(" ", $stmt_notificacion->errorInfo()));
        }

        // Commit transaction
        $conexion->commit();

        $_SESSION['mensaje'] = ($accion == 'responder')
            ? "Se ha enviado la respuesta y se ha creado una notificación."
            : "Se ha marcado como visto y notificado al usuario.";

        // Redirigir
        header("Location: ../PanelDeControl.php");
        exit();

    } catch (Exception $e) {
        // Rollback on error
        if ($conexion->inTransaction()) {
            $conexion->rollBack();
        }

        // Log the error
        debug_to_file(['ERROR' => $e->getMessage()]);

        $_SESSION['error'] = "Error: " . $e->getMessage();
        header("Location: ../PanelDeControl.php");
        exit();
    }
} else {
    header("Location: ../index.php");
    exit();
}