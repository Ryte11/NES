<?php
include 'conexion.php'; // Archivo de conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST['id']);
    $usuario = $_POST['usuario'];
    $nombre_completo = $_POST['nombre_completo'];
    $cedula = $_POST['cedula'];

    try {
        $query = "UPDATE tecnicos SET usuario = :usuario, nombre_completo = :nombre_completo, cedula = :cedula WHERE id = :id";
        $stmt = $conexion->prepare($query);
        $stmt->bindValue(':usuario', $usuario, PDO::PARAM_STR);
        $stmt->bindValue(':nombre_completo', $nombre_completo, PDO::PARAM_STR);
        $stmt->bindValue(':cedula', $cedula, PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo "<script>alert('Técnico modificado exitosamente.'); window.location='../UsuarioTecnicos.php';</script>";
        } else {
            echo "<script>alert('Error al modificar el técnico.'); window.location='../UsuarioTecnicos.php';</script>";
        }
    } catch (PDOException $e) {
        echo "<script>alert('Error: " . $e->getMessage() . "'); window.location='../UsuarioTecnicos.php';</script>";
    }
}
?>