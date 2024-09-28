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
include('../../includes/header.php'); // Common header 
include('../../includes/db_connection.php'); // Database Conection 

// Fetch users
$query = "SELECT u.id, u.username, u.email, u.role, d.department_name 
          FROM users u 
          LEFT JOIN departments d ON u.department_id = d.id";
$result = mysqli_query($conn, $query);

// Check for success or error messages
$message = isset($_GET['message']) ? $_GET['message'] : '';
?>

<div class="container mt-5">
    <h1>User Management</h1>

    <?php if ($message): ?>
        <div class="alert alert-success">
            <?php echo htmlspecialchars($message); ?>
        </div>
    <?php endif; ?>

    <a href="add_user.php" class="btn btn-success mb-3">Add New User</a>
    
    <table class="table table-striped table-hover">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Department</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id']); ?></td>
                <td><?php echo htmlspecialchars($row['username']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><?php echo ucfirst(htmlspecialchars($row['role'])); ?></td>
                <td><?php echo $row['department_name'] ? htmlspecialchars($row['department_name']) : 'N/A'; ?></td>
                <td>
                    <a href="edit_user.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="delete_user.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<!-- Include footer -->
<?php include('../../includes/footer.php'); // Common header; ?> 
    
</body>
</html>