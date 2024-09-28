<?php
include('../../includes/db_connection.php'); // Database Connection

// Fetch student ID from session or query parameter (you should implement your authentication system)
session_start();
$student_id = $_SESSION['student_id']; // Assuming you have stored the student ID in the session

// Fetch attendance records for the student
$query = "SELECT subjects.subject_name, attendance.date, attendance.status 
          FROM attendance 
          JOIN subjects ON attendance.subject_id = subjects.id 
          WHERE attendance.student_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Attendance</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Attendance Records</h1>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['subject_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['date']); ?></td>
                            <td><?php echo htmlspecialchars($row['status']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="text-center">No attendance records found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="text-center">
            <a href="student_dashboard.php" class="btn btn-primary">Back to Dashboard</a>
        </div>
    </div>
</body>

</html>
