<?php

// Admin login function
function loginAdmin($conn, $email, $password) {
    try {
        $stmt = $conn->prepare("SELECT * FROM admins WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($admin) {
            // Directly compare passwords without hashing
            if ($password === $admin['password']) {
                session_start();
                $_SESSION['user_id'] = $admin['id'];
                $_SESSION['user_name'] = $admin['username'];
                header("Location:../admin/index.php");
                exit();
            } else {
                return "Invalid password.";
            }
        } else {
            return "Admin not found.";
        }
    } catch (PDOException $e) {
        return "Login failed: " . $e->getMessage();
    }
}





// Lecturer login function
function loginLecture($conn, $email, $password) {
    try {
        $stmt = $conn->prepare("SELECT * FROM lecturers WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $lecturer = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($lecturer) {
            if (password_verify($password, $lecturer['password'])) 
        //    if ($password === $lecturer['password']) 
    {
                session_start();
                $_SESSION['user'] = $lecturer;
                header("Location: lecturer_dashboard.php");
                exit();
            } else {
                return "Invalid password.";
            }
        } else {
            return "Lecturer not found.";
        }
    } catch (PDOException $e) {
        return "Login failed: " . $e->getMessage();
    }
}





// Student login function
function loginStudent($conn, $email, $password) {
    try {
        $stmt = $conn->prepare("SELECT * FROM students WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $student = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($student) {
            // Directly compare passwords without hashing
            if ($password === $student['index_number']) {
                session_start();    
                // Store student info in session
                $_SESSION['user_id'] = $student['id']; // Store user ID
                $_SESSION['user_name'] = $student['username']; // Store username
                header("Location: student_dashboard.php"); // Redirect to student dashboard
                exit();
            } else {
                return "Invalid password.";
            }
        } else {
            return "Student not found.";
        }
    } catch (PDOException $e) {
        return "Login failed: " . $e->getMessage();
    }
}



// Function to check for empty inputs in the signup form
function emptyInputSignup($id_num, $Name, $email, $mNumber, $address, $pwd, $pwdRepeat) {
    return empty($id_num) || empty($Name) || empty($email) || empty($mNumber) || empty($address) || empty($pwd) || empty($pwdRepeat);
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

    // Check if a result was found and return true/false
    return $resultData ? $resultData : false;
}




function createUser($conn, $indexNum, $Name, $email, $mNumber, $address, $pwd) {
    // Check if email exists
    $emailExists = emailExists($conn, $email);
    if ($emailExists) {
        header("Location:../register.php?error=emailTaken");
        exit();
    }

    // SQL query with placeholders corrected
    $sql = "INSERT INTO lecturers (index_number, username, email, mobile_no, address, password) 
            VALUES (:index_number, :userName, :email, :mobile_no, :address, :password)";
    
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        header("Location:../register.php?error=stmtFailed");
        exit();
    }

    // Hash the password
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    // Bind parameters correctly
    $stmt->bindParam(':index_number', $indexNum);
    $stmt->bindParam(':userName', $Name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':mobile_no', $mNumber);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':password', $hashedPwd);

    try {
        $stmt->execute();
        header("Location:../signin.php?massage=registrationSuccess");
        exit();
    } catch (PDOException $e) {
        // Handle duplicate entry error
        if ($e->getCode() == 23000) {
            header("Location:../register.php?error=usernameTaken");
            exit();
        }
        throw $e;
    }
}

?>
