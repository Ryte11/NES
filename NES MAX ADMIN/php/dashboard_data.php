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
    $monthlyLabels = [];
    $monthlyCounts = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $monthlyLabels[] = $row['month'];
        $monthlyCounts[] = (int)$row['count'];
    }

    $response = [
        "totalDevices" => (int)$totalDevices,
        "totalUsers" => (int)$totalUsers,
        "totalComplaints" => (int)$totalComplaints,
        "complaintTypes" => $complaintTypes,
        "monthlyComplaintLabels" => $monthlyLabels,
        "monthlyComplaintCounts" => $monthlyCounts,
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
