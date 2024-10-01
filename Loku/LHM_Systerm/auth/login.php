<?php
session_start();
require_once '../includes/db_connection.inc.php'; // Include database connection

// Function to sanitize inputs
function sanitizeInput($data) {
    return htmlspecialchars(trim($data));
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize form data
    $username = sanitizeInput($_POST['username']);
    $password = sanitizeInput($_POST['password']);
    $role = sanitizeInput($_POST['role']); // Get the selected role

    if (empty($username) || empty($password)) {
        $error = "Please fill in all fields.";
    } else {
        // Prepare the query based on the selected role
        $query = "";
        if ($role === 'admin') {
            $query = "SELECT * FROM admins WHERE username = :username LIMIT 1";
        } elseif ($role === 'student') {
            $query = "SELECT * FROM students WHERE username = :username LIMIT 1";
        } elseif ($role === 'lecturer') {
            $query = "SELECT * FROM lecturers WHERE username = :username LIMIT 1";
        }

        if (!empty($query)) {
            // Prepare the statement to check user credentials
            $stmt = $conn->prepare($query);
            $stmt->bindValue(':username', $username); // Bind the parameter
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch the result

            // If user exists, verify password
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $role; // Set session role based on selection
                
                // Redirect based on role
                if ($role === 'admin') {
                    header("Location: /LHM_System/admin/dashboard.php");
                } elseif ($role === 'student') {
                    header("Location: /LHM_System/student/dashboard.php");
                } elseif ($role === 'lecturer') {
                    header("Location: /LHM_System/lecturer/dashboard.php");
                }
                exit();
            } else {
                $error = "Invalid username or password.";
            }
        } else {
            $error = "Invalid role selection.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to the stylesheet -->
    <style>
        /* General Styling */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f9fc;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 400px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .role-selector {
            display: flex;
            justify-content: center;
            margin-bottom: 15px;
        }

        .slider-container {
            display:
            flex-direction: column;
            align-items: center;
        }

        .slider-container input {
            display: none;
        }

        .slider-container label {
            padding: 10px 20px;
            background-color: #eee;
            border-radius: 20px;
            cursor: pointer;
            margin: 5px;
            transition: background-color 0.3s ease;
        }

        .slider-container input:checked + label {
            background-color: #007bff;
            color: white;
        }

        .submit-btn {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .submit-btn:hover {
            background-color: #0056b3;
        }

        .error {
            color: red;
            text-align: center;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <!-- Role Selector with a slider -->
            <div class="role-selector">
                <div class="slider-container">
                    <input type="radio" id="admin" name="role" value="admin" required>
                    <label for="admin">Admin</label>

                    <input type="radio" id="student" name="role" value="student" required>
                    <label for="student">Student</label>

                    <input type="radio" id="lecturer" name="role" value="lecturer" required>
                    <label for="lecturer">Lecturer</label>
                </div>
            </div>

            <button type="submit" class="submit-btn">Login</button>
        </form>
    </div>
</body>
</html>
