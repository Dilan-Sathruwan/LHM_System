
<?php 
require_once '../admin/include/db_connection.inc.php';
require_once 'fun.inc.php';

if (isset($_POST["Asubmit"])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        
    
        if (empty($email) || empty($password)) {
            $result = "Please fill all fields.";

        } else {
            $result = loginAdmin($conn, $email, $password);
        }
    
        if ($result) {
            echo "<div class='alert alert-danger'>$result</div>";
        }
    header("Location:../signin.php?message=" . urlencode($result));
}



// // Main login logic
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $email = $_POST['email'];
//     $password = $_POST['password'];
//     $role = $_POST['role'];

//     if (empty($email) || empty($password)) {
//         $error = "Please fill all fields.";
//     } else {
//         if ($role === 'admin') {
//             $error = loginAdmin($email, $password, $pdo);
//         } elseif ($role === 'lecturer') {
//             $error = loginLecturer($email, $password, $pdo);
//         } elseif ($role === 'student') {
//             $error = loginStudent($email, $password, $pdo);
//         } else {
//             $error = "Invalid role.";
//         }
//     }

//     if ($error) {
//         echo "<div class='alert alert-danger'>$error</div>";
//     }
// }


?>
