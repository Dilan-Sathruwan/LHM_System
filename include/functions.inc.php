<?php

// Function to check for empty inputs in the signup form
function emptyInputSignup($fName, $lName, $email, $mNumber, $address, $pwd, $pwdRepeat) {
    return empty($fName) || empty($lName) || empty($email) || empty($mNumber) || empty($address) || empty($pwd) || empty($pwdRepeat);
}

// Function to check if passwords match
function pwdMatch($pwd, $pwdRepeat) {
    return $pwd !== $pwdRepeat;
}

// Function to check if the email is valid
function invalidEmail($email) {
    return !filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Function to check if the email already exists in the database
function emailExists($conn, $email) {
    $sql = "SELECT * FROM lecturers WHERE email = :email";
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        header("Location:../register.php?error=stmtFailed");
        exit();
    }

    // Bind the email parameter and execute the query
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    // Fetch the result from the database
    $resultData = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($resultData) {
        return $resultData; // Return the row if the email exists
    } else {
        return false; // No user found with that email
    }
}

// Function to create a new user in the database
function createUser($conn, $fName, $lName, $email, $mNumber, $address, $pwd) {
    // Check if the email already exists
    $emailExists = emailExists($conn, $email);
    
    if ($emailExists) {
        // Redirect with an error if the email already exists
        header("Location:../register.php?error=emailTaken");
        exit();
    }

    // Insert new user into the database
    $sql = "INSERT INTO lecturers (firstName, lastName, email, mobile_no, address, password) 
            VALUES (:firstName, :lastName, :email, :mobile_no, :address, :password)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        header("Location:../register.php?error=stmtFailed");
        exit();
    }

    // Hash the password
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    // Bind parameters
    $stmt->bindParam(':firstName', $fName);
    $stmt->bindParam(':lastName', $lName);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':mobile_no', $mNumber);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':password', $hashedPwd);

    // Execute the statement
    try {
        $stmt->execute();
        // Redirect to login page after successful registration
        header("Location:../login.php?error=none");
        exit();
    } catch (PDOException $e) {
        // Handle duplicate entry error
        if ($e->getCode() == 23000) {
            header("Location:../register.php?error=usernameTaken");
            exit();
        }
        throw $e; // For other errors, throw the exception
    }
}


// Function to check for empty inputs in the login form
function emptyInputLogin($email, $pwd) {
    return empty($email) || empty($pwd);
}

// Function to log in a user
function loginUser($conn, $email, $pwd) {
    // Check if the email exists in the database
    $emailExists = emailExists($conn, $email);

    if (!$emailExists) {
        header("Location:../login.php?error=wrongLogin");
        exit();
    }

    // Verify the entered password with the hashed password from the database
    $pwdHashed = $emailExists['password'];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if (!$checkPwd) {
        header("Location:../login.php?error=wrongLogin");
        exit();
    } else {
        // Start a new session and store the user ID
        session_start();
        $_SESSION["id"] = $emailExists["id"];
        $_SESSION["email"] = $emailExists["email"];
        
        // Redirect to the homepage or dashboard
        header("Location:../index.php");
        exit();
    }
}
?>
