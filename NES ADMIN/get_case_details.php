<?php
    // Iniciar sesión
    session_start();

    // Configuración de conexión a la base de datos
    $servername = "localhost:";
    $username = "root"; 
    $password = ""; 
    $dbname = "nes";

    // Crear conexión
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    // Verificar si se ha proporcionado un ID
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        
        // Consultar los detalles del caso
        $sql = "SELECT * FROM denuncias_users WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            // Devolver los datos como JSON
            $row = $result->fetch_assoc();
            echo json_encode($row);
        } else {
            // No se encontró el caso
            http_response_code(404);
            echo json_encode(["error" => "Caso no encontrado"]);
        }
    } else {
        // No se proporcionó un ID
        http_response_code(400);
        echo json_encode(["error" => "Se requiere un ID"]);
    }

    // Cerrar la conexión
    $conn->close();
    ?>