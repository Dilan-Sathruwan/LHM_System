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

    if (empty($username) || empty($password)) {
        $error = "Please fill in all fields.";
    } else {
        // Prepare the query to check lecturer credentials
        $query = "SELECT * FROM lecturers WHERE username = :username LIMIT 1";
        $stmt = $conn->prepare($query);
        $stmt->bindValue(':username', $username); // Bind the parameter
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch the result
        
        // If user exists, verify password
        if ($user && password_verify($password, $user['password'])) {
            // Successful login
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = 'lecturer'; // Set session role as lecturer
            header("Location: ../lecturer/dashboard.php");
            exit();
        } else {
            $error = "Invalid username or password.";
        }        
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css"> <!-- Link to your custom CSS file -->
    <title>Lecturer Login</title>
    <style>
        body {
    background-color: #f8f9fa; /* Light background color */
}

.card {
    border-radius: 10px; /* Rounded corners */
}

.card-body {
    padding: 30px; /* Extra padding for the card body */
}

.btn-primary {
    background-color: #007bff; /* Bootstrap primary color */
    border-color: #007bff; /* Same as primary color */
}

.btn-primary:hover {
    background-color: #0056b3; /* Darker shade on hover */
    border-color: #0056b3; /* Same as hover color */
}

    </style>
</head>
<body class="bg-light">
    <div class="container d-flex align-items-center justify-content-center" style="height: 100vh;">
        <div class="card shadow" style="width: 400px;">
            <div class="card-body">
                <h2 class="text-center mb-4">Lecturer Login</h2>
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control" id="username" placeholder="Enter your username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </form>
                <?php if (isset($error)) { ?>
                    <div class="alert alert-danger mt-3" role="alert">
                        <?php echo $error; ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
