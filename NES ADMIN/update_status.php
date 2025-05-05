<?php
// Database connection parameters
$host = "localhost";
$usuario = "root";
$password = "";
$baseDeDatos = "nes";

// Create database connection
$conn = new mysqli($host, $usuario, $password, $baseDeDatos);

// Check connection
if ($conn->connect_error) {
    // Return error message as JSON
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Error de conexión: ' . $conn->connect_error]);
    exit;
}

// Check if request is POST and has the required parameters
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the case ID and new status from the AJAX request
    $caseId = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $newStatus = isset($_POST['status']) ? $conn->real_escape_string($_POST['status']) : '';
    
    // Validate inputs
    if ($caseId <= 0 || empty($newStatus)) {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'ID o estado inválido']);
        exit;
    }
    
    // Valid status values
    $validStatuses = ['aceptado', 'denegado', 'en proceso'];
    if (!in_array($newStatus, $validStatuses)) {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Estado inválido']);
        exit;
    }
    
    // Update case status in database
    $sql = "UPDATE denuncias_users SET estado = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("si", $newStatus, $caseId);
        $result = $stmt->execute();
        
        if ($result) {
            // Success response
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'message' => 'Estado actualizado correctamente']);
        } else {
            // Error response
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Error al actualizar estado: ' . $stmt->error]);
        }
        
        $stmt->close();
    } else {
        // Prepare statement error
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Error de preparación de consulta: ' . $conn->error]);
    }
} else {
    // Method not allowed
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
}

// Close connection
$conn->close();
?>