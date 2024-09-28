<?php
// Database connection settings
$servername = "localhost";  // Change this to your server's name (or "127.0.0.1")
$username = "root";         // Change this to your database username
$password = "";             // Change this to your database password
$dbname = "lecture_management_system";  // The name of your database

// Enable error reporting for debugging
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Create a connection to the MySQL database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optionally, you can add the following line to confirm the connection
// echo "Connected successfully";

// Close the connection when done (optional for small scripts)
// $conn->close();
?>
