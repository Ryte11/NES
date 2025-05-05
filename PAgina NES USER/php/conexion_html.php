<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "nes";

try {
    $conn = new mysqli($host, $user, $pass, $db);

    // Check connection
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    // Set charset to UTF-8
    if (!$conn->set_charset("utf8")) {
        throw new Exception("Error loading character set utf8: " . $conn->error);
    }

} catch (Exception $e) {
    // Log error (in production, you should log to a file instead of displaying)
    error_log("Database connection error: " . $e->getMessage());

    // Display user-friendly message
    die("Sorry, there was a problem connecting to the database. Please try again later.");
}
?>