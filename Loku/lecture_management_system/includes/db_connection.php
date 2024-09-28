<?php
$servername = "localhost"; // Server name remains localhost
$username = "root";        // Default XAMPP MySQL username is 'root'
$password = "";            // XAMPP default has no password for 'root' user
$dbname = "lecture_management_system"; // Your database name

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Optional: Set character set to utf8mb4 for proper handling of Unicode characters
mysqli_set_charset($conn, "utf8mb4");
?>
