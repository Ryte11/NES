<?php
$host = "localhost";
<<<<<<< HEAD
$db = "nes";
=======
>>>>>>> 9d6718ae2c90670f587fc7cc331cec67857e0bea
$user = "root";
$pass = "";
$db = "nes";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>