<?php
session_start();
require_once '../includes/db_connection.inc.php'; // Include database connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: /LHM_System/auth/login.php");
    exit();
}

// Fetch lecturer info
$stmt = $conn->prepare("SELECT * FROM lecturers WHERE id = :id");
$stmt->bindValue(':id', $_SESSION['user_id'], PDO::PARAM_INT);
$stmt->execute();

// Check if lecturer exists
if ($stmt->rowCount() === 0) {
    // Redirect to login or show an error if no lecturer is found
    header("Location: /LHM_System/auth/login.php");
    exit();
}

$lecturer = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lecturer Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Welcome, <?php echo htmlspecialchars($lecturer['first_name']); ?></h2>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Dashboard</h5>
                <p class="card-text">You can manage your lectures and view your schedule from here.</p>
                <a href="view_schedule.php" class="btn btn-primary">View Your Schedule</a>
                <a href="manage_lectures.php" class="btn btn-warning">Manage Lectures</a>
                <a href="view_all_lectures.php" class="btn btn-primary">View All Lecthurs</a>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
