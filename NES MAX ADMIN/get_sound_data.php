<?php
require 'php/conexion.php';

try {
    $sql = "SELECT * FROM sound_data ORDER BY timestamp DESC";
    $stmt = $conexion->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($data);
} catch(PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>