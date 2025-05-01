<?php
session_start();

$host = "localhost";
$usuario = "root";
$password = "";
$baseDeDatos = "nes";

$conn = new mysqli($host, $usuario, $password, $baseDeDatos);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$email = $_POST['email'];
$contrasena = $_POST['pswd'];

$sql = $conn->prepare("SELECT * FROM usuarios_users WHERE email = ?");
$sql->bind_param("s", $email);
$sql->execute();
$result = $sql->get_result();

if ($result->num_rows > 0) {
    $usuario = $result->fetch_assoc();
    if (password_verify($contrasena, $usuario['contraseña'])) {
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nombre'] = $usuario['nombre'];


        $directorio = 'Archivostxt';
        if (!is_dir($directorio)) {
            mkdir($directorio, 0777, true);
        }

        $archivo = $directorio . '/inicios_sesion.txt';
        $datos = "ID Usuario: " . $usuario['id'] . "\nNombre: " . $usuario['nombre'] . "\nEmail: " . $email . "\nFecha y Hora: " . date('Y-m-d H:i:s') . "\n---------------------------\n";

        if (file_put_contents($archivo, $datos, FILE_APPEND)) {
        } else {
            echo "Error al guardar los datos de inicio de sesión en el archivo.";
        }
        
        header("Location: Denuncias-html.php"); 
        exit();
    } else {
        echo "Contraseña incorrecta. <a href='index.html'>Intentar de nuevo</a>";
    }
} else {
    echo "No se encontró una cuenta con este correo electrónico. <a href='index.html'>Intentar de nuevo</a>";
}



$conn->close();
?>
