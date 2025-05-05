<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$host = "localhost";
$usuario = "root";
$password = "";
$baseDeDatos = "nes";

try {
    $conn = new PDO(
        "mysql:host=$host;dbname=$baseDeDatos;charset=utf8mb4",
        $usuario,
        $password,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $nombre = trim(filter_input(INPUT_POST, "userId", FILTER_SANITIZE_STRING));
        $password = trim(filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING));

        error_log("Intento de login - Usuario: " . $nombre);

        if (empty($nombre) || empty($password)) {
            throw new Exception("Nombre y contraseña son requeridos");
        }

        $stmt = $conn->prepare("SELECT nombre, password, rol FROM usuarios WHERE nombre = ?");
        $stmt->execute([$nombre]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        error_log("Consulta realizada - Usuario encontrado: " . ($usuario ? "Sí" : "No"));

        if (!$usuario) {
            echo "<script>alert('Usuario no encontrado'); window.location = '../login.html';</script>";
            exit;
        }

        $passwordCorrecta = false;
        if (!empty($usuario['password'])) {
            if (password_verify($password, $usuario['password'])) {
                $passwordCorrecta = true;
            } else if ($password === $usuario['password']) {
                $passwordCorrecta = true;

                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $updateStmt = $conn->prepare("UPDATE usuarios SET password = ? WHERE nombre = ?");
                $updateStmt->execute([$hashedPassword, $nombre]);
            }
        }

        if ($passwordCorrecta) {
            session_start();
            session_regenerate_id(true);
            $_SESSION['nombre'] = $nombre;
            $_SESSION['rol'] = $usuario['rol'];

            if ($usuario['rol'] == 'admin') {
                header('Location: ../PanelDeControl.php');
            } else if ($usuario['rol'] == 'normal') {
                header('Location: ../Usuario.html');
            }
            exit;
        } else {
            echo "<script>alert('Contraseña incorrecta'); window.location = '../login.html';</script>";
            exit;
        }
    }
} catch (Exception $e) {
    error_log("Error en login.php: " . $e->getMessage());
    echo "<script>alert('Error: " . $e->getMessage() . "'); window.location = '../login.html';</script>";
    exit;
}
?>



<!-- log in breslin -->

<?php

header('Content-Type: application/json');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$host = "localhost";
$dbname = "nes";
$username = "root";
$dbpassword = "";

try {

    $conn = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $username,
        $dbpassword,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    // Verificar si ya hay una sesión activa
    session_start();
    if (isset($_SESSION['nombre'])) {
        echo json_encode([
            "success" => false,
            "message" => "Ya estás logueado",
            "redirect" => "dashboard.php"
        ]);
        exit;
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        // Filtrar y sanitizar las entradas
        $nombre = filter_input(INPUT_POST, "userId", FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);

        error_log("Intento de login - Usuario: " . $nombre);

        if (!$nombre || !$password) {
            throw new Exception("Nombre y contraseña son requeridos");
        }

        // Consultar la base de datos
        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE nombre = :nombre");
        $stmt->execute(['nombre' => $nombre]);
        $usuario = $stmt->fetch();

        error_log("Consulta realizada - Usuario encontrado: " . ($usuario ? "Sí" : "No"));

        if (!$usuario) {
            echo json_encode([
                "success" => false,
                "message" => "Usuario no encontrado"
            ]);
            exit;
        }

        // Verificación de la contraseña
        $passwordCorrecta = false;
        if (strlen($usuario['password']) > 0) {
            if (password_verify($password, $usuario['password'])) {
                $passwordCorrecta = true;
            } else if ($password === $usuario['password']) {
                $passwordCorrecta = true;

                // Actualizar la contraseña con hash si no está hasheada
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $updateStmt = $conn->prepare("UPDATE usuarios SET password = :password WHERE nombre = :nombre");
                $updateStmt->execute([
                    'password' => $hashedPassword,
                    'nombre' => $nombre
                ]);
            }
        }

        // Implementar verificación de intentos fallidos
        $maxAttempts = 5;  // Máximo de intentos permitidos
        $attempts = $usuario['intentos_fallidos'];
        $lockTime = 15 * 60; // 15 minutos de bloqueo

        // Si el usuario ha excedido los intentos fallidos, bloquearlo temporalmente
        if ($attempts >= $maxAttempts) {
            $lastAttempt = strtotime($usuario['ultimo_intento']);
            if ((time() - $lastAttempt) < $lockTime) {
                echo json_encode([
                    "success" => false,
                    "message" => "Tu cuenta está bloqueada temporalmente. Intenta de nuevo más tarde."
                ]);
                exit;
            } else {
                // Restablecer los intentos fallidos después del tiempo de bloqueo
                $updateStmt = $conn->prepare("UPDATE usuarios SET intentos_fallidos = 0 WHERE nombre = :nombre");
                $updateStmt->execute(['nombre' => $nombre]);
            }
        }

        if ($passwordCorrecta) {

            // Restablecer los intentos fallidos al iniciar sesión correctamente
            $updateStmt = $conn->prepare("UPDATE usuarios SET intentos_fallidos = 0 WHERE nombre = :nombre");
            $updateStmt->execute(['nombre' => $nombre]);

            session_regenerate_id(true); // Regenerar la sesión para mayor seguridad
            $_SESSION['nombre'] = $nombre;
            $_SESSION['email'] = $usuario['email'];

            echo json_encode([
                "success" => true,
                "message" => "Inicio de sesión exitoso",
                "redirect" => "dashboard.php"
            ]);

            error_log("Login exitoso para usuario: " . $nombre);

        } else {

            // Incrementar el contador de intentos fallidos
            $updateStmt = $conn->prepare("UPDATE usuarios SET intentos_fallidos = intentos_fallidos + 1, ultimo_intento = NOW() WHERE nombre = :nombre");
            $updateStmt->execute(['nombre' => $nombre]);

            error_log("Contraseña incorrecta para usuario: " . $nombre);

            echo json_encode([
                "success" => false,
                "message" => "Contraseña incorrecta"
            ]);
        }
    }

    // Cerrar la conexión a la base de datos al final
    $conn = null;

} catch (Exception $e) {
    error_log("Error en login.php: " . $e->getMessage());

    // Detalles más específicos sobre el error
    echo json_encode([
        "success" => false,
        "message" => "Error: " . $e->getMessage()
    ]);
}
?>
















