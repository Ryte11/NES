<?php
include 'php/conexion.php'; // Tu archivo de conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $usuario = $_POST['usuario'];
    $nombre_completo = $_POST['nombre_completo'];
    $cedula = $_POST['cedula'];

    // Hashear la contraseña para almacenarla de forma segura
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);

    // Consulta SQL para insertar los datos en la base de datos
    $sql = "INSERT INTO tecnicos (usuario, nombre_completo, cedula, contraseña) 
            VALUES ('$usuario', '$nombre_completo', '$cedula', '$contrasena')";

    // Ejecutar la consulta y verificar si fue exitosa
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Técnico registrado exitosamente.'); window.location='index.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registrar Técnico</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .registro-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
        }

        .registro-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 7px;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #4CAF50;
            color: white;
            border: none;
            border-radius: 7px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background: #45a049;
        }

        .mensaje {
            text-align: center;
            margin-bottom: 15px;
            color: green;
        }

        .error {
            text-align: center;
            margin-bottom: 15px;
            color: red;
        }
    </style>
</head>

<body>


<form method="POST">
    <h2>Registrar Técnico</h2>
    <input type="text" name="usuario" placeholder="Usuario" required>
    <input type="text" name="nombre_completo" placeholder="Nombre Completo" required>
    <input type="text" name="cedula" placeholder="Cédula" required>
    <input type="password" name="contrasena" placeholder="Contraseña" required>
    <button type="submit">Registrar</button>
</form>

</body>

</html>