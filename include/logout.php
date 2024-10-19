<?php
session_start(); // Start the session

// Unset all session variables
$_SESSION = [];

// Delete the session cookie if it exists
if (session_id() != '' || isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 3600, '/'); // Adjust path if needed
    session_destroy(); // Destroy the session
}

// Redirect to the login page or desired page
header("Location:../signin.php?message=Your_now_logout!"); // Change this to your desired page
exit();
?>
