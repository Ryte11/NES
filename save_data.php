<?php
// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nes";

// Nivel mínimo para guardar en la base de datos
$threshold = 55;

// Crear conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar si la conexión falló
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Verificar si se recibió el parámetro 'db_value' por GET
if (isset($_GET['db_value'])) {
    $db_value = intval($_GET['db_value']);

    // Solo guardar si supera el umbral de 55 dB
    if ($db_value >= $threshold) {
        // Preparar la consulta SQL para insertar datos
        $sql = "INSERT INTO sound_data (db_value) VALUES (?)";

        $stmt = $conn->prepare($sql);

        if ($stmt === FALSE) {
            $debug_message = "Prepare failed at " . date('Y-m-d H:i:s') . "\n";
            $debug_message .= "SQL Query: " . $sql . "\n";
            $debug_message .= "Error: " . $conn->error . "\n";
            $debug_message .= "--------------------\n";
            file_put_contents('debug_db_error.txt', $debug_message, FILE_APPEND);

            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("i", $db_value);

        if ($stmt->execute()) {
            echo "Nivel alto de sonido guardado: " . $db_value . " dB";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Nivel de sonido por debajo del umbral (actual: " . $db_value . " dB)";
    }
} else {
    echo "No data received";
}

$conn->close();
?>