<?php
// Database connection configuration
$servername = "localhost";  // Replace with your server name if different
$username = "root";         // Replace with your MySQL username
$password = "12345";             // Replace with your MySQL password
$dbname = "lhm_system2";  // Replace with your actual database name

// Enable or disable debug mode
$debug = false; // Set to true during development to see debug messages

// Create the connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    // If the connection fails, display the error
    die("Connection failed: " . $conn->connect_error);
}

// Debug option: If debug mode is enabled, show a connection success message
if ($debug) {
    echo "DEBUG: Successfully connected to the database";
}

// Function to execute SQL queries (optional, for clean code)
function execute_query($conn, $sql) {
    $result = $conn->query($sql);
    if ($result === FALSE) {
        // Handle query error and output debug information if enabled
        global $debug;
        if ($debug) {
            echo "DEBUG: Query Error - " . $conn->error;
        }
    }
    return $result;
}

?>
