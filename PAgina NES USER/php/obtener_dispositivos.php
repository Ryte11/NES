<?php
try {
    require 'conexion.php'; // Make sure this path is correct

    $query = "SELECT * FROM dispositivos"; // Adjust query as needed
    $stmt = $conn->prepare($query);
    $stmt->execute();

    $dispositivos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    header('Content-Type: application/json');
    echo json_encode($dispositivos);
} catch (Exception $e) {
    header('Content-Type: application/json');
    echo json_encode(['error' => $e->getMessage()]);
}
?>