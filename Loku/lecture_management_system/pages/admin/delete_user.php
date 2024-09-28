<?php
// include('auth.php');
// include('../../includes/auth.php'); //Check 
include('../../includes/header.php'); // Common header 
include('../../includes/db_connection.php'); // Database Conection 

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    $query = "DELETE FROM users WHERE id = $user_id";
    
    if (mysqli_query($conn, $query)) {
        header('Location: manage_users.php?message=User deleted successfully');
    } else {
        header('Location: manage_users.php?message=Error deleting user');
    }
} else {
    header('Location: manage_users.php?message=Invalid user ID');
}
