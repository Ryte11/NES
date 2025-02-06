<?php
$host = "localhost";
$usuario = "root";
$password = "";
$baseDeDatos = "nes_user";
$conn = new mysqli($host, $usuario, $password, $baseDeDatos);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$sql = "SELECT * FROM denuncias ORDER BY fecha DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alertas</title>
</head>
<body>
    <h1>Alertas de Denuncias</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Cédula</th>
                <th>Ubicación</th>
                <th>Tipo</th>
                <th>Descripción</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['nombre']}</td>
                        <td>{$row['cedula']}</td>
                        <td>{$row['ubicacion']}</td>
                        <td>{$row['tipo']}</td>
                        <td>{$row['descripcion']}</td>
                        <td>{$row['fecha']}</td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No hay denuncias registradas</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>

<?php
$conn->close();
?>
