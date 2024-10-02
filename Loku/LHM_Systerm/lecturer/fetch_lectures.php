<?php
session_start();
require_once '../includes/db_connection.inc.php'; // Include database connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    exit('You must be logged in to view this content.');
}

$user_id = $_SESSION['user_id'];

// Fetch lecture data from the database
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
        return false; // Return false for error handling
    }
}

// Fetch lecture data
$lectures = fetchLectures($conn, $user_id);

// Generate the HTML for the lecture table
if ($lectures === false) {
    echo '<div class="alert alert-danger" role="alert">Error fetching lectures. Please try again later.</div>';
} elseif (empty($lectures)) {
    echo '<div class="alert alert-warning" role="alert">You have no scheduled lectures.</div>';
} else {
    echo '
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
            <tbody>';
    foreach ($lectures as $lecture) {
        echo '<tr>
            <td>' . htmlspecialchars($lecture['subject_name']) . '</td>
            <td>' . htmlspecialchars($lecture['department_name']) . '</td>
            <td>' . htmlspecialchars($lecture['hall_name']) . '</td>
            <td>' . htmlspecialchars($lecture['first_name'] . ' ' . $lecture['last_name']) . '</td>
            <td>' . htmlspecialchars($lecture['lecture_date']) . '</td>
            <td>' . htmlspecialchars($lecture['start_time']) . '</td>
            <td>' . htmlspecialchars($lecture['end_time']) . '</td>
        </tr>';
    }
    echo '
            </tbody>
        </table>';
}
?>
