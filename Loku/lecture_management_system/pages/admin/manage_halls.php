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

// Fetch lecture halls
$query = "SELECT * FROM lecture_halls";
$result = mysqli_query($conn, $query);
?>

<div class="container mt-5">
    <h1>Manage Lecture Halls</h1>
    <a href="add_hall.php" class="btn btn-success mb-3">Add New Hall</a>
    
    <table class="table table-striped table-hover">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Hall Name</th>
                <th>Capacity</th>
                <th>Location</th>
                <th>Available</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['hall_name']; ?></td>
                <td><?php echo $row['capacity']; ?></td>
                <td><?php echo $row['location']; ?></td>
                <td><?php echo $row['available'] ? 'Yes' : 'No'; ?></td>
                <td>
                    <a href="edit_hall.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="delete_hall.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
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

