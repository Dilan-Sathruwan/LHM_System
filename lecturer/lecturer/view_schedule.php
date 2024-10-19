<?php
session_start();
include '../../admin/include/db_connection.inc.php';

// Check if user is logged in and is a lecturer
if (!isset($_SESSION['user'])) {
    header("Location:../../signin.php"); // Redirect to login if not logged in
    exit();
}

$lecturer_id = $_SESSION['user'];

// Fetch the lecturer's schedule using PDO
$query = "
SELECT 
    ls.id AS timetable_id,
    s.subject_name,
    lh.hall_name,
    b.batch_name,
    d.department_name,
    ts.start_time,
    ts.end_time,
    ls.days AS day_of_week
FROM lecture_schedule ls
JOIN subjects s ON ls.subject_id = s.id
JOIN lecture_halls lh ON ls.hall_id = lh.id
JOIN batches b ON ls.batch_id = b.id
JOIN departments d ON b.department_id = d.id
JOIN timeslot ts ON ls.slot_id = ts.slot_id
WHERE ls.lecturer_id = :lecturer_id
ORDER BY FIELD(ls.days, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'), ts.start_time
";

// Prepare and execute the query
$stmt = $conn->prepare($query);
$stmt->bindParam(':lecturer_id', $lecturer_id, PDO::PARAM_INT);
$stmt->execute();
$lectures = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Check if there are any results
if (!empty($lectures)) {
    foreach ($lectures as $lecture) {
        // You can process the $lecture array here
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Schedule</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/theme.css"> <!-- Add theme CSS -->
    <style>
        /* General Theme Styles */
        body {
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        /* Light Theme */
        body.light-theme {
            background-color: #f8f9fa;
            color: #343a40;
        }

        /* Dark Theme */
        body.dark-theme {
            background-color: #343a40;
            color: #f8f9fa;
        }

        /* Table Styles */
        .table {
            background-color: rgba(255, 255, 255, 0.9);
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        body.dark-theme .table {
            background-color: rgba(52, 58, 64, 0.85);
            /* Dark table background */
            color: #f8f9fa;
        }

        .table thead {
            background-color: rgba(0, 123, 255, 0.9);
            color: #fff;
        }

        body.dark-theme .table thead {
            background-color: rgba(40, 167, 69, 0.9);
            /* Adjusted header color */
        }

        .table-hover tbody tr:hover {
            background-color: rgba(0, 123, 255, 0.1);
        }

        body.dark-theme .table-hover tbody tr:hover {
            background-color: rgba(40, 167, 69, 0.1);
        }

        /* For mobile responsiveness */
        @media (max-width: 768px) {
            .table {
                font-size: 0.9rem;
            }
        }

        /* Sticky Theme Toggle Button */
        .theme-toggle-btn {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 50%;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        body.dark-theme .theme-toggle-btn {
            background-color: #28a745;
            /* Change color for dark theme */
        }
    </style>
</head>

<body>
    <?php
    $page_title = "View Schedule";
    include '../includes/lecturer_header.php';
    ?>

    <div class="container mt-5">
        <h2>Your Lecture Schedule</h2>

        <?php if (!empty($lectures)) : ?>
            <table class="table table-bordered table-hover lecture-table">
                <thead>
                    <tr>
                        <th>Day</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Subject</th>
                        <th>Department</th>
                        <th>Batch</th>
                        <th>Hall</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lectures as $lecture) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($lecture['day_of_week']); ?></td>
                            <td><?php echo htmlspecialchars($lecture['start_time']); ?></td>
                            <td><?php echo htmlspecialchars($lecture['end_time']); ?></td>
                            <td><?php echo htmlspecialchars($lecture['subject_name']); ?></td>
                            <td><?php echo htmlspecialchars($lecture['department_name']); ?></td>
                            <td><?php echo htmlspecialchars($lecture['batch_name']); ?></td>
                            <td><?php echo htmlspecialchars($lecture['hall_name']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>You have no scheduled lectures.</p>
        <?php endif; ?>
    </div>

    <?php
    include '../includes/footer.php';
    ?>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
<!-- This Page Create by Loku -->