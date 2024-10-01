<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lecture_management_system";

try {
    // Create a PDO connection
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Optional: Uncomment the next line for debugging; remove it in production
    // echo "Connected successfully"; 
} catch (PDOException $e) {
    // Display error message if the connection fails
    // It's better to log the error instead of displaying it directly
    error_log("Connection failed: " . $e->getMessage());
    
    // Display a generic error message to the user
    echo "Database connection failed. Please try again later.";
    exit(); // Stop further execution
}
?>
