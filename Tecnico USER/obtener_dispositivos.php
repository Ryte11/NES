<?php
// require 'php/conexion.php';
// $sql = "SELECT nombre_instalador,id_dispositivo, latitud, longitud, zona_referencia, fecha_instalacion FROM dispositivos";
// $res = $conn->query($sql);

// $data = [];
// while ($row = $res->fetch_assoc()) {
//     $data[] = $row;
// }
// echo json_encode($data);



require 'php/conexion.php';

$id_tecnico = isset($_GET['id_tecnico']) ? intval($_GET['id_tecnico']) : null;

if ($id_tecnico) {
    $sql = "SELECT id_dispositivo, latitud, longitud, zona_referencia, fecha_instalacion, nombre_instalador 
            FROM dispositivos WHERE id_tecnico = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_tecnico);
} else {
    $sql = "SELECT id_dispositivo, latitud, longitud, zona_referencia, fecha_instalacion, nombre_instalador FROM dispositivos";
    $stmt = $conn->prepare($sql);
}

$stmt->execute();
$result = $stmt->get_result();

$dispositivos = [];
while ($row = $result->fetch_assoc()) {
    $dispositivos[] = $row;
}

echo json_encode($dispositivos);
?>
