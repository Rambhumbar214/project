<?php
$host = 'localhost'; // Database host
$db = 'notes_sharing'; // Database name
$user = 'root'; // Database username
$pass = ''; // Database password

// Set DSN (Data Source Name)
$dsn = "mysql:host=$host;dbname=$db";

try {
    // Create a PDO instance
    $pdo = new PDO($dsn, $user, $pass);
    // Set error mode to exceptions
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Handle connection errors
    echo 'Connection failed: ' . $e->getMessage();
}
?>
