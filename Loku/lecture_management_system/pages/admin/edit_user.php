
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

<?php
// include('auth.php');
// include('../../includes/auth.php'); //Check 
include('../../includes/header.php'); // Common header 
include('../../includes/db_connection.php'); // Database Connection 

// Check if 'id' is set in the URL
if (!isset($_GET['id'])) {
    header('Location: manage_users.php?message=User ID not provided');
    exit();
}

// Ensure $user_id is an integer
$user_id = intval($_GET['id']);

// Validate if user_id is a positive integer
if ($user_id <= 0) {
    header('Location: manage_users.php?message=Invalid User ID');
    exit();
}

$query = "SELECT * FROM users WHERE id = $user_id";
$result = mysqli_query($conn, $query);

// Check if the user was found
if (!$result || mysqli_num_rows($result) == 0) {
    header('Location: manage_users.php?message=User not found');
    exit();
}

$user = mysqli_fetch_assoc($result);
$message = isset($_GET['message']) ? $_GET['message'] : '';
?>

<div class="container mt-5">
    <h1>Edit User</h1>

    <?php if ($message): ?>
        <div class="alert alert-success">
            <?php echo htmlspecialchars($message); ?>
        </div>
    <?php endif; ?>

    <form action="process_edit_user.php" method="POST">
        <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
        
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select class="form-select" id="role" name="role" required>
                <option value="admin" <?php echo $user['role'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
                <option value="lecturer" <?php echo $user['role'] == 'lecturer' ? 'selected' : ''; ?>>Lecturer</option>
                <option value="student" <?php echo $user['role'] == 'student' ? 'selected' : ''; ?>>Student</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="department_id" class="form-label">Department</label>
            <select class="form-select" id="department_id" name="department_id">
                <option value="">Select Department</option>
                <?php
                // Fetch departments for dropdown
                $departments_query = "SELECT id, department_name FROM departments";
                $departments_result = mysqli_query($conn, $departments_query);
                while ($department = mysqli_fetch_assoc($departments_result)): ?>
                    <option value="<?php echo $department['id']; ?>" <?php echo $user['department_id'] == $department['id'] ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($department['department_name']); ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update User</button>
        <a href="manage_users.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<!-- Include footer -->
<?php include('../../includes/footer.php'); ?>

</body>
</html>
