<?php
session_start();
$servername = "localhost";
$username = "root";
$password = ""; 
$database = "nes_user";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$usuario = $_POST['Usuario'];
$telefono = $_POST['Telefono']; 
$email = isset($_POST['email']) ? $_POST['email'] : '';
$cedula = $_POST['Cedula'];
$contrasena = password_hash($_POST['Contraseña'], PASSWORD_DEFAULT); // Encriptar la contraseña

$sql_check = "SELECT * FROM usuarios WHERE cedula = '$cedula'";
$result = $conn->query($sql_check);

if ($result->num_rows > 0) {
    echo "<script>
        alert('La cédula ya está registrada. Por favor, intenta con una diferente.');
        window.location.href = 'index.html';
    </script>";
    exit();
}

$sql = "INSERT INTO usuarios (nombre, cedula, email, contraseña, estado, fecha_registro) 
        VALUES ('$usuario', '$cedula', '$email', '$contrasena', 'activo', NOW())";

if ($conn->query(query: $sql) === TRUE) {
    $directorio = 'Archivostxt';
    if (!is_dir($directorio)) {
        mkdir($directorio, 0777, true);
    }

    $archivo = $directorio . '/registros_usuarios.txt';
    $datos = "Usuario: $usuario\nTeléfono: $telefono\nEmail: $email\nCédula: $cedula\nEstado: activo\nFecha de Registro: " . date('Y-m-d H:i:s') . "\n---------------------------\n";

    if (file_put_contents($archivo, $datos, FILE_APPEND)) {
    } else {
        echo "Error al guardar los datos de registro en el archivo.";
    }


    echo "<script>
        alert('Registro exitoso. Bienvenido.');
        window.location.href = 'Denuncias-html.html';
    </script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

