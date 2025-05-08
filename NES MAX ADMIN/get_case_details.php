<?php
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 0);

require_once 'php/conexion.php';

try {
    $sql = "SELECT id, nombre, cedula, ubicacion, tipo, fecha, descripcion, estado 
            FROM denuncias_users 
            ORDER BY fecha DESC";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $denuncias = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (empty($denuncias)) {
        echo json_encode([]);
    } else {
        $formattedData = array_map(function($row) {
            return [
                'id' => $row['id'],
                'nombre' => $row['nombre'],
                'codigo' => $row['cedula'],
                'ubicacion' => $row['ubicacion'],
                'tipo' => $row['tipo'],
                'fecha' => $row['fecha'],
                'descripcion' => $row['descripcion'],
                'estado' => $row['estado']
            ];
        }, $denuncias);
        
        echo json_encode($formattedData);
    }

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'error' => true,
        'message' => 'Database error: ' . $e->getMessage()
    ]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'error' => true,
        'message' => 'Server error: ' . $e->getMessage()
    ]);
}
?>