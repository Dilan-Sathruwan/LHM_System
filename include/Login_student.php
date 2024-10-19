<?php
require_once '../admin/include/db_connection.inc.php';
require_once 'fun.inc.php';

if (isset($_POST["Ssubmit"])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        
    
        if (empty($email) || empty($password)) {
            $result = "Please fill all fields.";

        } else {
            $result = loginStudent($conn, $email, $password);
        }
    
        if ($result) {
            echo "<div class='alert alert-danger'>$result</div>";
        }
    header("Location:../signin.php?message=" . urlencode($result));
}

?>