<?php
$file_path = '../includes/db_connection.php';
if (file_exists($file_path)) {
    include($file_path);
} else {
    echo "File not found: " . $file_path; // Debugging line
}

$message = "";

// Fetch departments for dropdown
$departments_query = "SELECT id, department_name FROM departments";
$departments_result = mysqli_query($conn, $departments_query);

// Fetch subjects for dropdown (you can adjust this query as per your structure)
$subjects_query = "SELECT id, subject_name FROM subjects";
$subjects_result = mysqli_query($conn, $subjects_query);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $email = trim($_POST['email']);
    $role = $_POST['role'];

    // Additional fields for students
    $department_id = $_POST['department_id'] ?? null;
    $batch = $_POST['batch'] ?? null;
    $study_type = $_POST['study_type'] ?? null;

    // Additional fields for lecturers
    $lecturer_department_ids = $_POST['lecturer_departments'] ?? [];
    $subject_ids = $_POST['subject_ids'] ?? [];

    // Validate inputs
    if (empty($username) || empty($password) || empty($email) || empty($role)) {
        $message = "Please fill in all fields.";
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert the user into the database
        $query = "INSERT INTO users (username, password, email, role, department_id) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);

        if ($role == 'student') {
            // Add student-specific data
            mysqli_stmt_bind_param($stmt, "ssssi", $username, $hashed_password, $email, $role, $department_id);
        } elseif ($role == 'lecturer') {
            // Add lecturer-specific data (department and subjects)
            // Note: You might need to implement a many-to-many relationship for departments and subjects
            // This example just inserts into the users table for the department
            mysqli_stmt_bind_param($stmt, "sssi", $username, $hashed_password, $email, $role);
        }

        if (mysqli_stmt_execute($stmt)) {
            $message = "Registration successful! You can now log in.";
            // Handle additional logic for departments and subjects for lecturers if necessary
        } else {
            $message = "Error: " . mysqli_error($conn);
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
    </style>
</head>

<body>
    <div class="container">
        <div class="form-container">
            <h3>Register</h3>
            <?php if ($message): ?>
                <div class="alert alert-info">
                    <?php echo htmlspecialchars($message); ?>
                </div>
            <?php endif; ?>
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-select" id="role" name="role" required onchange="toggleFields()">
                        <option value="">Select Role</option>
                        <option value="student">Student</option>
                        <option value="lecturer">Lecturer</option>
                    </select>
                </div>

                <div id="studentFields" style="display:none;">
                    <div class="mb-3">
                        <label for="department_id" class="form-label">Department</label>
                        <select class="form-select" id="department_id" name="department_id">
                            <option value="">Select Department</option>
                            <?php while ($department = mysqli_fetch_assoc($departments_result)): ?>
                                <option value="<?php echo $department['id']; ?>">
                                    <?php echo htmlspecialchars($department['department_name']); ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="batch" class="form-label">Batch</label>
                        <select class="form-select" id="batch" name="batch">
                            <option value="first_year">First Year</option>
                            <option value="second_year">Second Year</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="study_type" class="form-label">Study Type</label>
                        <select class="form-select" id="study_type" name="study_type">
                            <option value="full_time">Full Time</option>
                            <option value="part_time">Part Time</option>
                        </select>
                    </div>
                </div>

                <div id="lecturerFields" style="display:none;">
                    <div class="mb-3">
                        <label for="lecturer_departments" class="form-label">Department(s)</label>
                        <select class="form-select" id="lecturer_departments" name="lecturer_departments[]" multiple>
                            <?php while ($department = mysqli_fetch_assoc($departments_result)): ?>
                                <option value="<?php echo $department['id']; ?>">
                                    <?php echo htmlspecialchars($department['department_name']); ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="subject_ids" class="form-label">Subjects</label>
                        <select class="form-select" id="subject_ids" name="subject_ids[]" multiple>
                            <?php while ($subject = mysqli_fetch_assoc($subjects_result)): ?>
                                <option value="<?php echo $subject['id']; ?>">
                                    <?php echo htmlspecialchars($subject['subject_name']); ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100">Register</button>
            </form>
            <p class="mt-3 text-center">Already have an account? <a href="login.php">Login here</a>.</p>
        </div>
    </div>

    <script>
        function toggleFields() {
            const role = document.getElementById('role').value;
            const studentFields = document.getElementById('studentFields');
            const lecturerFields = document.getElementById('lecturerFields');

            if (role === 'student') {
                studentFields.style.display = 'block';
                lecturerFields.style.display = 'none';
            } else if (role === 'lecturer') {
                studentFields.style.display = 'none';
                lecturerFields.style.display = 'block';
            } else {
                studentFields.style.display = 'none';
                lecturerFields.style.display = 'none';
            }
        }
