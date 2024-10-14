<?php
if (isset($_POST["signUp"])) {
    $fName = trim($_POST["fName"]);
    $lName = trim($_POST["lName"]);
    $email = trim($_POST["email"]);
    $mNumber = trim($_POST["mNumber"]);
    $address = trim($_POST["address"]);
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdRepeat"];

    // Include necessary files
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    // Check for empty inputs
    if (emptyInputSignup($fName, $lName, $email, $mNumber, $address, $pwd, $pwdRepeat)) {
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

    // If all checks pass, create the user
    createUser($conn, $fName, $lName, $email, $mNumber, $address, $pwd);
} else {
    header("Location:../register.php");
    exit();
}
?>
