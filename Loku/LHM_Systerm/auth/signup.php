<?php
session_start();
include '../includes/db.php';  // Database connection

// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
    header("Location: /admin/dashboard.php");
    exit();
}

// Initialize variables for error and success messages
$error = '';
$success = '';

// Check if the user is an administrator
if (isset($_SESSION['user_id'])) {
    $stmt = $conn->prepare("SELECT role FROM users WHERE id = ?");
    $stmt->bind_param('i', $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // If the user is an admin, they cannot sign up
    if ($user['role'] === 'admin') {
        header("Location: /admin/dashboard.php");
        exit();
    }
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch and sanitize form data
    $firstName = trim($_POST['first_name']);
    $lastName = trim($_POST['last_name']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $departmentId = $_POST['department_id']; // Ensure this matches your input name
    $password = $_POST['password'];

    // Check if department is selected
    if (empty($departmentId)) {
        $error = "Please select a department.";
    } else {
        // Prepare SQL statement to insert lecturer data
        $stmt = $conn->prepare("INSERT INTO lecturers (first_name, last_name, username, email, department_id, password) VALUES (?, ?, ?, ?, ?, ?)");
        // You can hash the password for better security
        // $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bind_param("ssssss", $firstName, $lastName, $username, $email, $departmentId, $password);

        // Execute and check for errors
        if ($stmt->execute()) {
            $success = "Registration successful.";
        } else {
            $error = "Error: " . $stmt->error;
        }
        
        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lecturer Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Lecturer Sign Up</h2>
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php elseif (!empty($success)): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php endif; ?>
        <form method="POST" action="">
            <div class="form-group">
                <label for="first_name">First Name:</label>
                <input type="text" class="form-control" id="first_name" name="first_name" required>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" class="form-control" id="last_name" name="last_name" required>
            </div>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="department_id">Department:</label>
                <select class="form-control" id="department_id" name="department_id" required>
                    <option value="">Select Department</option>
                    <option value="1">IT Department</option>
                    <option value="2">Accounting Department</option>
                    <option value="3">English Department</option>
                    <option value="4">Project Management Department</option>
                </select>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-success">Sign Up</button>
            <a href="login.php" class="btn btn-link">Already have an account? Login</a>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
