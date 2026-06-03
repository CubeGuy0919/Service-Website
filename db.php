<?php
$host = "localhost";
$user = "root";       // Default XAMPP username
$password = "";       // Default XAMPP password is blank
$dbname = "techforge_db";

try {
    // Establish a secure connection using PDO (PHP Data Objects)
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $password);
    
    // Set error mode to exception so we can catch any SQL database issues smoothly
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // If connection drops, show a clean system message
    die("Database handshake failed: " . $e->getMessage());
}
?>