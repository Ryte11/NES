<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = trim(string: $_POST["userId"]);
    $password = trim(string: $_POST["password"]);


    $fechaHora = date(format: "Y-m-d H:i:s");
    $ipUsuario = $_SERVER['REMOTE_ADDR'];


    $dispositivo = $_SERVER['HTTP_USER_AGENT'];

    if ($userId === "admin" && $password === "admin123") {
     
        $file = fopen(filename: "log.txt", mode: "a");
        fwrite(stream: $file, data: "OK - Acceso exitoso | Usuario: $userId | Fecha: $fechaHora | IP: $ipUsuario | Dispositivo: $dispositivo\n");
        fclose(stream: $file);

        echo "Inicio de sesión exitoso. Se ha registrado en el sistema.";
    } else {
        echo "Error: Credenciales incorrectas.";
    }
} else {
    echo "Acceso no permitido.";
}
?>
