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

<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root"; // Ajusta según tu configuración
$password = ""; // Ajusta según tu configuración
$dbname = "nes";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die(json_encode(['error' => 'Error de conexión: ' . $conn->connect_error]));
}

// Configurar el conjunto de caracteres a utf8
$conn->set_charset("utf8");

// Array para almacenar todos los datos
$data = [];

// 1. Total de dispositivos
$sql_dispositivos = "SELECT COUNT(*) as total FROM dispositivos";
$result = $conn->query($sql_dispositivos);
$dispositivos = $result->fetch_assoc();
$data['total_dispositivos'] = $dispositivos['total'];

// 2. Total de usuarios registrados
$sql_usuarios = "SELECT COUNT(*) as total FROM usuarios";
$result = $conn->query($sql_usuarios);
$usuarios = $result->fetch_assoc();
$data['total_usuarios'] = $usuarios['total'];

// 3. Denuncias activas (estado = 'en proceso')
$sql_denuncias_activas = "SELECT COUNT(*) as total FROM denuncias_users WHERE estado = 'en proceso'";
$result = $conn->query($sql_denuncias_activas);
$denuncias_activas = $result->fetch_assoc();
$data['denuncias_activas'] = $denuncias_activas['total'];

// 4. Denuncias resueltas (estado = 'aceptado')
$sql_denuncias_resueltas = "SELECT COUNT(*) as total FROM denuncias_users WHERE estado = 'aceptado'";
$result = $conn->query($sql_denuncias_resueltas);
$denuncias_resueltas = $result->fetch_assoc();
$data['denuncias_resueltas'] = $denuncias_resueltas['total'];

// 5. Denuncias por tipo
$sql_denuncias_tipo = "SELECT tipo, COUNT(*) as total FROM denuncias_users GROUP BY tipo";
$result = $conn->query($sql_denuncias_tipo);
$denuncias_tipo = [];
while ($row = $result->fetch_assoc()) {
    $denuncias_tipo[$row['tipo']] = $row['total'];
}
$data['denuncias_tipo'] = $denuncias_tipo;

// 6. Obtener datos para el gráfico de provincias
$sql_provincias = "SELECT ubicacion, COUNT(*) as total FROM alertas WHERE ubicacion != '' GROUP BY ubicacion";
$result = $conn->query($sql_provincias);
$provincias_data = [];
while ($row = $result->fetch_assoc()) {
    $provincias_data[$row['ubicacion']] = $row['total'];
}
$data['provincias_data'] = $provincias_data;

// 7. Obtener datos para el gráfico de denuncias por tipo
$sql_denuncias_chart = "SELECT tipo, COUNT(*) as total FROM alertas WHERE tipo != '' GROUP BY tipo";
$result = $conn->query($sql_denuncias_chart);
$denuncias_chart = [];
while ($row = $result->fetch_assoc()) {
    $denuncias_chart[$row['tipo']] = $row['total'];
}
$data['denuncias_chart'] = $denuncias_chart;

// 8. Total de denuncias por categoría específica
// Denuncias por Bocinas
$sql_bocinas = "SELECT COUNT(*) as total FROM denuncias_users WHERE tipo LIKE '%bocina%'";
$result = $conn->query($sql_bocinas);
$bocinas = $result->fetch_assoc();
$data['denuncias_bocinas'] = $bocinas['total'];

// Denuncias por Vehículos
$sql_vehiculos = "SELECT COUNT(*) as total FROM denuncias_users WHERE tipo LIKE '%vehiculo%' OR tipo LIKE '%vehículo%'";
$result = $conn->query($sql_vehiculos);
$vehiculos = $result->fetch_assoc();
$data['denuncias_vehiculos'] = $vehiculos['total'];

// Denuncias por Construcciones
$sql_construcciones = "SELECT COUNT(*) as total FROM denuncias_users WHERE tipo LIKE '%construccion%' OR tipo LIKE '%construcción%'";
$result = $conn->query($sql_construcciones);
$construcciones = $result->fetch_assoc();
$data['denuncias_construcciones'] = $construcciones['total'];

// 9. Total de denuncias
$sql_total_denuncias = "SELECT COUNT(*) as total FROM denuncias_users";
$result = $conn->query($sql_total_denuncias);
$total_denuncias = $result->fetch_assoc();
$data['total_denuncias'] = $total_denuncias['total'];

// Devolver los datos en formato JSON
header('Content-Type: application/json');
echo json_encode($data);

// Cerrar conexión
$conn->close();
?>
