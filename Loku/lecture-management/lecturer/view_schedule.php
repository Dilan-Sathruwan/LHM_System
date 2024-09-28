<?php
session_start();
include '../includes/db.php'; // Include your database connection

// Check if the user is logged in
// if (!isset($_SESSION['user_id'])) {
//     header("Location: /auth/login.php");
//     exit();
// }

// Fetch lecturer's schedule
$stmt = $conn->prepare("SELECT lectures.title, lectures.date, lectures.time, departments.name AS department FROM lectures JOIN departments ON lectures.department_id = departments.id WHERE lectures.lecturer_id = ?");
$stmt->bind_param('i', $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$lectures = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Schedule</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Your Lecture Schedule</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Department</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($lectures) > 0): ?>
                    <?php foreach ($lectures as $lecture): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($lecture['title']); ?></td>
                            <td><?php echo htmlspecialchars($lecture['date']); ?></td>
                            <td><?php echo htmlspecialchars($lecture['time']); ?></td>
                            <td><?php echo htmlspecialchars($lecture['department']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">No lectures scheduled.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <a href="dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
