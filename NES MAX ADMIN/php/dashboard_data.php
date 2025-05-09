<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

require_once 'conexion.php';

try {
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Total devices count
    $stmt = $conexion->query("SELECT COUNT(*) AS total_devices FROM dispositivos");
    $totalDevices = $stmt->fetch(PDO::FETCH_ASSOC)['total_devices'];

    // Registered users count
    $stmt = $conexion->query("SELECT COUNT(*) AS total_users FROM usuarios_users");
    $totalUsers = $stmt->fetch(PDO::FETCH_ASSOC)['total_users'];

    // Active complaints (estado = 'en proceso')
    $stmt = $conexion->query("SELECT COUNT(*) AS active_complaints FROM denuncias_users WHERE estado = 'en proceso'");
    $activeComplaints = $stmt->fetch(PDO::FETCH_ASSOC)['active_complaints'];

    // Resolved complaints (estado = 'aceptado')
    $stmt = $conexion->query("SELECT COUNT(*) AS resolved_complaints FROM denuncias_users WHERE estado = 'aceptado'");
    $resolvedComplaints = $stmt->fetch(PDO::FETCH_ASSOC)['resolved_complaints'];

    // Total complaints
    $stmt = $conexion->query("SELECT COUNT(*) AS total_complaints FROM denuncias_users");
    $totalComplaints = $stmt->fetch(PDO::FETCH_ASSOC)['total_complaints'];

    // Complaint types with counts
    $stmt = $conexion->query("
        SELECT 
            tipo,
            COUNT(*) as count
        FROM denuncias_users 
        GROUP BY tipo
    ");
    $complaintTypes = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $complaintTypes[$row['tipo']] = (int)$row['count'];
    }

    // Monthly trend (labels and counts)
    $stmt = $conexion->query("
        SELECT 
            DATE_FORMAT(fecha, '%Y-%m') AS month,
            COUNT(*) AS count
        FROM denuncias_users
        WHERE fecha >= DATE_SUB(CURDATE(), INTERVAL 12 MONTH)
        GROUP BY month
        ORDER BY month ASC
    ");
    $monthlyData = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $monthlyData[] = [
            "month" => $row['month'],
            "count" => (int)$row['count']
        ];
    }

    // Denuncias per province
    $stmt = $conexion->query("
        SELECT 
            provincia,
            COUNT(*) AS count
        FROM denuncias_users
        WHERE provincia != ''
        GROUP BY provincia
        ORDER BY count DESC
    ");
    $provinciasData = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $provinciasData[] = [
            "provincia" => $row['provincia'],
            "count" => (int)$row['count']
        ];
    }

    // Map specific categories to counts for compatibility with the dashboard
    $denunciasBocinas = 0;
    $denunciasVehiculos = 0;
    $denunciasConstrucciones = 0;
    
    foreach ($complaintTypes as $tipo => $count) {
        if (stripos($tipo, 'bocina') !== false) {
            $denunciasBocinas += $count;
        }
        if (stripos($tipo, 'vehiculo') !== false || stripos($tipo, 'vehículo') !== false) {
            $denunciasVehiculos += $count;
        }
        if (stripos($tipo, 'construccion') !== false || stripos($tipo, 'construcción') !== false) {
            $denunciasConstrucciones += $count;
        }
    }

    $response = [
        "totalDevices" => (int)$totalDevices,
        "totalUsers" => (int)$totalUsers,
        "totalComplaints" => (int)$totalComplaints,
        "activeComplaints" => (int)$activeComplaints,
        "resolvedComplaints" => (int)$resolvedComplaints,
        "complaintTypes" => $complaintTypes,
        "monthlyData" => $monthlyData,
        "provinciasData" => $provinciasData,
        "denuncias_bocinas" => $denunciasBocinas,
        "denuncias_vehiculos" => $denunciasVehiculos,
        "denuncias_construcciones" => $denunciasConstrucciones,
        "success" => true
    ];

    echo json_encode($response);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        "error" => "Database error: " . $e->getMessage(),
        "success" => false
    ]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        "error" => "Server error: " . $e->getMessage(),
        "success" => false
    ]);
}
?>