<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // If the user is not logged in, redirect to the login page
    header("Location: login.php");
    exit;
}

// Access the session variables
$user_role = $_SESSION['role']; // Admin, Lecturer, or Student

// Use this variable to display different options based on the user's role
?>