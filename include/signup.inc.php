<?php
if (isset($_POST["signUp"])) {
    $id_num = trim($_POST["id_num"]);
    $Name = trim($_POST["Name"]); 
    $email = trim($_POST["email"]);
    $mNumber = trim($_POST["mNumber"]);
    $address = trim($_POST["address"]);
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdRepeat"];

    // Include necessary files
    require_once 'database.inc.php';
    require_once 'fun.inc.php';

    // Check for empty inputs (corrected function arguments)
    if (emptyInputSignup($id_num, $Name, $email, $mNumber, $address, $pwd, $pwdRepeat)) {
        header("Location:../register.php?error=emptyInput");
        exit();
    }

    // Check if passwords match
    if (pwdMatch($pwd, $pwdRepeat)) {
        header("Location:../register.php?error=passwordDontMatch");
        exit();
    }

    // Check if email already exists
    if (emailExists($conn, $email)) {
        header("Location:../register.php?error=emailTaken");
        exit();
    }

    // If all checks pass, create the user (added $id_num to function call)
    createUser($conn, $id_num, $Name, $email, $mNumber, $address, $pwd);
} else {
    header("Location:../register.php");
    exit();
}
?>

