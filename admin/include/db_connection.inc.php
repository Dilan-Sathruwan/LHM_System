<?php
// Database configuration
$servername = "sql12.freesqldatabase.com";
$username = "sql12743113";
$password = "98czmEvKyu";
$dbname = "sql12743113";

try {
    // Create a PDO connection
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}