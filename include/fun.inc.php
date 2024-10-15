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
            // if (password_verify($password, $lecturer['password'])) 
           if ($password === $lecturer['password']) {
                session_start();
                $_SESSION['user_id'] = $lecturer['id'];
                $_SESSION['user'] = $lecturer;
                header("Location:../lecturer/lecturer/dashboard.php");
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

?>
