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

// Function to fetch lecture data from the database
function fetchLectures($conn, $user_id) {
    try {
        $stmt = $conn->prepare("
            SELECT l.id, s.name AS subject_name, h.name AS hall_name, le.first_name, le.last_name, l.lecture_date, l.start_time, l.end_time, d.name AS department_name
            FROM lectures l
            JOIN subjects s ON l.subject_id = s.id
            JOIN halls h ON l.hall_id = h.id
            JOIN lecturers le ON s.lecturer_id = le.id
            JOIN departments d ON s.department_id = d.id
            WHERE le.id = :lecturer_id
            ORDER BY l.lecture_date DESC, l.start_time ASC
        ");
        $stmt->bindValue(':lecturer_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Handle any errors during the execution of the SQL statement
        echo "Error fetching lectures: " . htmlspecialchars($e->getMessage());
        exit();
    }
}

// Fetch initial lecture data
$lectures = fetchLectures($conn, $user_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Lecture Schedule</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Custom styles to optimize layout */
        .table th, .table td {
            vertical-align: middle;
        }
        .lecture-table {
            margin-top: 20px;
        }
        .alert {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>Your Lecture Schedule</h2>

        <!-- Placeholder for real-time update message -->
        <div id="message-area"></div>

        <!-- Lecture Table -->
        <div id="lecture-content">
            <?php if (empty($lectures)): ?>
                <div class="alert alert-warning" role="alert">
                    You have no scheduled lectures.
                </div>
            <?php else: ?>
                <table class="table table-bordered lecture-table">
                    <thead>
                        <tr>
                            <th>Subject</th>
                            <th>Department</th>
                            <th>Hall</th>
                            <th>Lecturer</th>
                            <th>Date</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lectures as $lecture): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($lecture['subject_name']); ?></td>
                                <td><?php echo htmlspecialchars($lecture['department_name']); ?></td>
                                <td><?php echo htmlspecialchars($lecture['hall_name']); ?></td>
                                <td><?php echo htmlspecialchars($lecture['first_name'] . ' ' . $lecture['last_name']); ?></td>
                                <td><?php echo htmlspecialchars($lecture['lecture_date']); ?></td>
                                <td><?php echo htmlspecialchars($lecture['start_time']); ?></td>
                                <td><?php echo htmlspecialchars($lecture['end_time']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>

    <!-- Include jQuery and Bootstrap JS for better user interaction -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- AJAX for real-time updates -->
    <script>
        // Function to fetch updated lecture data and refresh the table
        function fetchUpdatedLectures() {
            $.ajax({
                url: 'fetch_lectures.php', // Create a new PHP file to fetch lectures dynamically
                method: 'GET',
                success: function(response) {
                    $('#lecture-content').html(response);
                    $('#message-area').html('<div class="alert alert-info">Schedule updated in real-time!</div>');
                },
                error: function() {
                    $('#message-area').html('<div class="alert alert-danger">Failed to update schedule. Please try again.</div>');
                }
            });
        }

        // Set interval for real-time updates (e.g., every 30 seconds)
        setInterval(fetchUpdatedLectures, 30000); // 30 seconds
    </script>
</body>
</html>
