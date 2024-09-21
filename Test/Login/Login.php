<?php
session_start(); // Start the session

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form input
    $role = $_POST['role'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Basic validation (you might want to add more comprehensive checks)
    if (empty($role) || empty($email) || empty($password)) {
        $error = "All fields are required.";
    } else {
        // Simulated user authentication logic (replace with actual database checks)
        $validUsers = [
            'student@example.com' => 'studentpassword', // Simulated user data
            'lecturer@example.com' => 'lecturerpassword',
            'admin@example.com' => 'adminpassword',
        ];

        // Check if user exists and password matches
        if (array_key_exists($email, $validUsers) && $validUsers[$email] === $password) {
            // Set session variables
            $_SESSION['role'] = $role;
            $_SESSION['email'] = $email;

            // Redirect based on role (replace with actual URLs)
            switch ($role) {
                case 'student':
                    header('Location: student_dashboard.php');
                    break;
                case 'lecturer':
                    header('Location: lecturer_dashboard.php');
                    break;
                case 'administrator':
                    header('Location: admin_dashboard.php');
                    break;
            }
            exit;
        } else {
            $error = "Invalid email or password.";
        }
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
        .role-toggle {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Login Form -->
        <div class="form-container">
            <h3>Login</h3>
            <?php if (isset($error)): ?>
                <div class="alert alert-danger" role="alert"><?php echo $error; ?></div>
            <?php endif; ?>
            <form method="POST" action="">
                <div class="role-toggle">
                    <label class="form-label">Select Role:</label>
                    <div>
                        <input type="radio" name="role" id="studentRole" value="student" required>
                        <label for="studentRole" class="form-label me-2">Student</label>
                        <input type="radio" name="role" id="lecturerRole" value="lecturer">
                        <label for="lecturerRole" class="form-label me-2">Lecturer</label>
                        <input type="radio" name="role" id="adminRole" value="administrator">
                        <label for="adminRole" class="form-label">Administrator</label>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="loginEmail" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="loginEmail" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="loginPassword" class="form-label">Password</label>
                    <input type="password" class="form-control" id="loginPassword" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
