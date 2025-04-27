<?php
$host = "localhost"; 
$usuario = "root"; 
$password = ""; 
$baseDeDatos = "nes"; 

$conn = new mysqli($host, $usuario, $password, $baseDeDatos);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
} else {
    echo "Conexión exitosa a la base de datos";
}

$nombre = $_POST['nombre'];
$cedula = $_POST['Cedula'];
$ubicacion = $_POST['ubicacion'];
$tipo = $_POST['tipo'];
$descripcion = $_POST['descripcion'];

if (empty($nombre) || empty($cedula) || empty($ubicacion) || empty($tipo) || empty($descripcion)) {
    echo "<script> 
        alert('Por favor, completa todos los campos.');
        window.location.href = 'index.html';
    </script>";
    exit();
}

$sql = $conn->prepare("INSERT INTO denuncias_users (nombre, cedula, ubicacion, tipo, descripcion, fecha) VALUES (?, ?, ?, ?, ?, NOW())");

if (!$sql) {
    die("Error en la preparación de la consulta: " . $conn->error);
}

$sql->bind_param("sssss", $nombre, $cedula, $ubicacion, $tipo, $descripcion);

if ($sql->execute()) {
    echo "<script>
        alert('Denuncia guardada correctamente.');
        window.location.href = 'Denuncias-html.html'; // Cambia según la página que quieras redirigir
    </script>";
} else {
    echo "Error al ejecutar la consulta: " . $conn->error;
}

$directorio = 'Archivostxt';
if (!is_dir($directorio)) {
    mkdir($directorio, 0777, true); // Crea la carpeta si no existe
}

$archivo = $directorio . '/denuncias.txt';
$datos = "Nombre: $nombre\nCédula: $cedula\nUbicación: $ubicacion\nTipo: $tipo\nDescripción: $descripcion\nFecha: " . date('Y-m-d H:i:s') . "\n---------------------------\n";

if (file_put_contents($archivo, $datos, FILE_APPEND)) {
} else {
    echo "Error al guardar los datos en el archivo.";
}

$conn->close();
?>
