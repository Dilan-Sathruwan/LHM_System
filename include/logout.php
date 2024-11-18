<?php
session_start(); // Start the session

// Unset all session variables
$_SESSION = [];

// Delete the session cookie if it exists
if (session_id() != '' || isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 3600, '/'); // Adjust path if needed
    session_destroy(); 
}

header("Location:../index.php?message=Your_now_logout!"); 
exit();
?>
