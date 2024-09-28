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

// Fetch lecture schedules
$query = "SELECT ls.id, l.lecture_name, h.hall_name, ls.schedule_date, ls.schedule_time, ls.duration
          FROM lecture_schedule ls
          JOIN lectures l ON ls.lecture_id = l.id
          JOIN lecture_halls h ON ls.hall_id = h.id";
$result = mysqli_query($conn, $query);
?>

<div class="container mt-5">
    <h1>Manage Lecture Schedule</h1>
    <a href="add_schedule.php" class="btn btn-success mb-3">Add New Schedule</a>
    <table class="table table-striped table-hover">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Lecture Name</th>
                <th>Hall Name</th>
                <th>Schedule Date</th>
                <th>Schedule Time</th>
                <th>Duration (min)</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['lecture_name']; ?></td>
                <td><?php echo $row['hall_name']; ?></td>
                <td><?php echo $row['schedule_date']; ?></td>
                <td><?php echo $row['schedule_time']; ?></td>
                <td><?php echo $row['duration']; ?></td>
                <td>
                    <a href="edit_schedule.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="delete_schedule.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
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
