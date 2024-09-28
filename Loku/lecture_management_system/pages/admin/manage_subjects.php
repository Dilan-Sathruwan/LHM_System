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
// Fetch subjects


$query = "SELECT s.id, s.subject_name, d.department_name, s.semester, s.credits 
          FROM subjects s 
          JOIN departments d ON s.department_id = d.id";
$result = mysqli_query($conn, $query);
?>

<div class="container mt-5">
    <h1>Manage Subjects</h1>
    <a href="add_subject.php" class="btn btn-success mb-3">Add New Subject</a>
    
    <table class="table table-striped table-hover">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Subject Name</th>
                <th>Department</th>
                <th>Semester</th>
                <th>Credits</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['subject_name']; ?></td>
                <td><?php echo $row['department_name']; ?></td>
                <td><?php echo $row['semester']; ?></td>
                <td><?php echo $row['credits']; ?></td>
                <td>
                    <a href="edit_subject.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="delete_subject.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include('footer.php'); ?>


</body>
</html>
