<?php

$host = 'localhost'; 
$dbname = 'nes';
$username = 'root'; 
$password = ''; 

try {
    
    $conexion = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
       
   
    echo "Conexión exitosa a la base de datos.";
    
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>