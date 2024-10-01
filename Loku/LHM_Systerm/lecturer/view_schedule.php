<?php
session_start();
require_once '../includes/db_connection.inc.php'; // Include database connection

// Prevent caching
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0"); // Proxies.

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: /LHM_System/auth/login.php");
    exit();
}

// Debug: Show the logged-in user ID
$user_id = $_SESSION['user_id'];
// echo "Logged in user ID: " . htmlspecialchars($user_id); // Uncomment to debug

// Fetch lecturer's lectures
try {
    $stmt = $conn->prepare("
        SELECT l.id, s.name AS subject_name, h.name AS hall_name, l.lecture_date, l.start_time, l.end_time 
        FROM lectures l 
        JOIN subjects s ON l.subject_id = s.id 
        JOIN halls h ON l.hall_id = h.id 
        JOIN lecturers le ON s.lecturer_id = le.id 
        WHERE le.id = :lecturer_id
        ORDER BY l.lecture_date DESC, l.start_time ASC
    ");
    $stmt->bindValue(':lecturer_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $lectures = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Handle any errors during the execution of the SQL statement
    echo "Error fetching lectures: " . htmlspecialchars($e->getMessage());
    exit();
}
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

        <?php if (empty($lectures)): ?>
            <div class="alert alert-warning" role="alert">
                You have no scheduled lectures.
            </div>
        <?php else: ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Hall</th>
                        <th>Date</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lectures as $lecture): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($lecture['subject_name']); ?></td>
                            <td><?php echo htmlspecialchars($lecture['hall_name']); ?></td>
                            <td><?php echo htmlspecialchars($lecture['lecture_date']); ?></td>
                            <td><?php echo htmlspecialchars($lecture['start_time']); ?></td>
                            <td><?php echo htmlspecialchars($lecture['end_time']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
