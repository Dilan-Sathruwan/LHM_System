<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
// include('../../includes/auth.php'); //Check 
include('../../includes/header.php'); // Common header 
include('../../includes/db_connection.php'); // Database Connection 

// Fetch departments
$query = "SELECT * FROM departments";
$result = mysqli_query($conn, $query);
?>

<div class="container mt-5">
    <h1>Manage Departments</h1>
    <a href="add_department.php" class="btn btn-success mb-3">Add New Department</a>
    
    <table class="table table-striped table-hover">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Department Name</th>
                <th>Head of Department</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['department_name']; ?></td>
                <td><?php echo $row['head_of_department']; ?></td>
                <td>
                    <a href="edit_department.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="delete_department.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
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

