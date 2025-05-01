<?php
include 'conexion.php'; // Archivo de conexión a la base de datos

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    try {
        $query = "DELETE FROM tecnicos WHERE id = :id";
        $stmt = $conexion->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo "<script>alert('Técnico eliminado exitosamente.'); window.location='../UsuarioTecnico.php';</script>";
        } else {
            echo "<script>alert('Error al eliminar el técnico.'); window.location='../UsuarioTecnico.php';</script>";
        }
    } catch (PDOException $e) {
        echo "<script>alert('Error: " . $e->getMessage() . "'); window.location='../UsuarioTecnico.php';</script>";
    }
} else {
    echo "<script>alert('ID no válido.'); window.location='../UsuarioTecnico.php';</script>";
}
?>