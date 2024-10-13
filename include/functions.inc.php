<?php
function emptyInputSignup($fName, $lName, $email, $mNumber, $address, $pwd, $pwdRepeat){
    $result= null;
    if(empty($fName) || empty($lName) || empty($email) || empty($mNumber) || empty($address) || empty($pwd) || empty($pwdRepeat)){
        $result= true;
    } else {
        $result= false;
    }
    return $result;
}

function invalidEmail($email){
    $result= null;
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result= true;
    } else {
        $result= false;
    }
    return $result;
}

function pwdMatch($pwd, $pwdRepeat){
    $result= null;
    if($pwd !== $pwdRepeat){
        $result= true;
    } else {
        $result= false;
    }
    return $result;
}

function emailExists($conn, $email){
    $sql = "SELECT * FROM lecturers WHERE email= ?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location:../register.php?error=stmtFailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt,"s", $email); 
    mysqli_stmt_execute($stmt);
    $resultData= mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    } else{
        return false;
    }

    mysqli_stmt_close($stmt);
}

function createUser($conn, $fName, $lName, $email, $mNumber, $address, $pwd){
    $sql= "INSERT INTO lecturers (firstName, lastName, email, mobile_no, address, password) VALUES(?,?,?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location:../register.php?error=stmtFailed");
        exit();
    }
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt, "ssssss", $fName, $lName, $email, $mNumber, $address, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location:../login.php?error=none");
    exit();
}

function emptyInputLogin($email, $pwd){
    $result= null;
    if(empty($email) || empty($pwd)){
        $result= true;
    } else {
        $result= false;
    }
    return $result;
}

function LoginUser($conn, $email, $pwd){
    $emailExists= emailExists($conn, $email);
    if($emailExists=== false){
        header("location:../register.php?error=wrongLogin");
        exit();
    }

    $pwdHashed = $emailExists["password"];
    $checkpwd = password_verify($pwd, $pwdHashed);

    if($checkpwd=== false){
        header("Location:../register.php?error=wrongLogin");
        exit();
    } else if ($checkpwd=== true){
        session_start();
        $_SESSION["id"] = $emailExists["id"];
        header("Location:../#");
        exit();
    }
}


