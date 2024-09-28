<?php
session_start(); // Start the session

// Graceful error handling for file inclusion
$file_path = '../includes/db_connection.php';
if (!file_exists($file_path)) {
    exit("Database connection file not found.");
}
include($file_path);

$message = isset($_GET['message']) ? $_GET['message'] : '';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if email and password are set in the POST request
    if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['role'])) {
        // Sanitize inputs
        $email = mysqli_real_escape_string($conn, trim($_POST['email']));
        $password = $_POST['password']; // Plain password from form
        $role = mysqli_real_escape_string($conn, $_POST['role']);

        // Check if the user exists
        $query = "SELECT id, username, password, role FROM users WHERE email = ? AND role = ?";
        if ($stmt = mysqli_prepare($conn, $query)) {
            mysqli_stmt_bind_param($stmt, 'ss', $email, $role);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $user = mysqli_fetch_assoc($result);

            // Check if password matches the hashed password in the database
            if ($user && password_verify($password, $user['password'])) {
                // Set session variables
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                // Redirect based on role
                if ($user['role'] === 'admin') {
                    header("Location: ../admin/dashboard.php"); // Admin dashboard
                } elseif ($user['role'] === 'lecturer') {
                    header("Location: ../lecturer/dashboard.php"); // Lecturer dashboard
                } else {
                    header("Location: ../student/dashboard.php"); // Student dashboard
                }
                exit();
            } else {
                $message = "Invalid email or password."; // This will display if credentials fail
            }
        } else {
            $message = "Error with query.";
        }
    } else {
        $message = "Please fill in all fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #f8f9fa; /* Light background */
            font-family: Arial, sans-serif;
        }
        .form-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h3 {
            text-align: center;
            margin-bottom: 20px;
        }
        @media (max-width: 576px) {
            .form-container {
                padding: 15px;
                margin: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h3>Login</h3>
            <!-- Show error message if login fails -->
            <?php if ($message): ?>
                <div class="alert alert-danger">
                    <?php echo htmlspecialchars($message); ?>
                </div>
            <?php endif; ?>
            
            <form action="login.php" method="POST">
                <!-- User Role Selection -->
                <div class="mb-3">
                    <label for="role" class="form-label">Select Role:</label>
                    <div class="role-toggle">
                        <div class="form-check">
                            <input type="radio" class="form-check-input" name="role" id="studentRole" value="student" required>
                            <label for="studentRole" class="form-check-label">Student</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" name="role" id="lecturerRole" value="lecturer">
                            <label for="lecturerRole" class="form-check-label">Lecturer</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" name="role" id="adminRole" value="admin">
                            <label for="adminRole" class="form-check-label">Admin</label>
                        </div>
                    </div>
                </div>
                
                <!-- Email Field -->
                <div class="mb-3">
                    <label for="loginEmail" class="form-label">Email</label>
                    <input type="email" class="form-control" id="loginEmail" name="email" required>
                </div>
                
                <!-- Password Field -->
                <div class="mb-3">
                    <label for="loginPassword" class="form-label">Password</label>
                    <input type="password" class="form-control" id="loginPassword" name="password" required>
                </div>
                
                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
