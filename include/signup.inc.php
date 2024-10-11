<?php
if (isset($_POST["submit"])){
$fName = $_POST["fName"];
$lName = $_POST["lName"];
$email = $_POST["email"];
$mNumber = $_POST["mNumber"];
$address = $_POST["address"];
$pwd = $_POST["pwd"];
$pwdRepeat = $_POST["pwdRepeat"];

require_once 'dbh.inc.php';
require_once 'function.inc.php';

$emptyInput= emptyInputSignup($fName, $lName, $email, $mNumber, $address, $pwd, $pwdRepeat);
$invalidEmail= invalidEmail($email);
$pwdMatch= pwdMatch($pwd, $pwdRepeat); 
$emailExists= emailExists($conn, $email);

if($invalidEmail !==false){
    header("Location:../register.php?error=invalidEmail");
    exit();
}
if($pwdMatch !==false){
    header("Location:../register.php?error=passwordDontMatch");
    exit();
}
if($emailExists !==false){
    header("Location:../register.php?error=emailTaken");
    exit();
}

createUser($conn, $fName, $lName, $email, $mNumber, $address, $pwd);


}
else{
    header('Location:../login.php');
    exit();
}