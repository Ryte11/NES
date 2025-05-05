<?php
include 'conexion.php';

header('Content-Type: application/json');

try {
    // Consulta para obtener todos los dispositivos con información del instalador
    $query = "SELECT d.id_dispositivo, d.latitud, d.longitud, d.zona_referencia, 
                     d.fecha_instalacion, d.nombre_instalador
              FROM dispositivos d";
              
    $stmt = $conexion->prepare($query);
    $stmt->execute();
    $dispositivos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($dispositivos);
    
} catch(PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
