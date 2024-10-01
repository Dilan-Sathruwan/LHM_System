<?php
session_start();
require_once '../includes/db_connection.inc.php'; // Include database connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: /LHM_System/auth/login.php");
    exit();
}

// Handle search functionality
$searchQuery = '';
if (isset($_GET['search'])) {
    $searchQuery = trim($_GET['search']);
}

// Fetch all lectures with lecturer details, including search functionality (for all lecturers)
$lecturesStmt = $conn->prepare("
    SELECT l.id, s.name AS subject_name, d.name AS department_name, h.name AS hall_name, 
           l.lecture_date, l.start_time, l.end_time, le.first_name, le.last_name
    FROM lectures l 
    JOIN subjects s ON l.subject_id = s.id 
    JOIN halls h ON l.hall_id = h.id 
    JOIN departments d ON s.department_id = d.id
    JOIN lecturers le ON l.lecturer_id = le.id
    WHERE s.name LIKE :search 
       OR d.name LIKE :search 
       OR h.name LIKE :search 
       OR le.first_name LIKE :search 
       OR le.last_name LIKE :search
    ORDER BY l.lecture_date DESC, l.start_time ASC
");

$searchParam = "%$searchQuery%";
$lecturesStmt->bindParam(':search', $searchParam, PDO::PARAM_STR);
$lecturesStmt->execute();
$lectures = $lecturesStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Lectures</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .table th, .table td {
            vertical-align: middle;
        }
        .search-bar {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">All Lectures</h2>

        <!-- Search Bar -->
        <div class="search-bar">
            <form method="GET" action="">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search by subject, department, hall, or lecturer" value="<?php echo htmlspecialchars($searchQuery); ?>">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Search</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- List of Lectures -->
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="mb-0">Lecture Details</h4>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Subject</th>
                            <th>Department</th>
                            <th>Hall</th>
                            <th>Date</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Lecturer</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($lectures): ?>
                            <?php foreach ($lectures as $lecture): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($lecture['subject_name']); ?></td>
                                    <td><?php echo htmlspecialchars($lecture['department_name']); ?></td>
                                    <td><?php echo htmlspecialchars($lecture['hall_name']); ?></td>
                                    <td><?php echo htmlspecialchars($lecture['lecture_date']); ?></td>
                                    <td><?php echo htmlspecialchars($lecture['start_time']); ?></td>
                                    <td><?php echo htmlspecialchars($lecture['end_time']); ?></td>
                                    <td><?php echo htmlspecialchars($lecture['first_name'] . ' ' . $lecture['last_name']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center">No lectures found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
