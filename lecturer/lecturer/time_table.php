<?php
session_start();
include '../../admin/include/db_connection.inc.php';


// Check if user is logged in and is a lecturer
if (!isset($_SESSION['user'])) {
    header("Location:../../signin.php"); // Redirect to login if not logged in
    exit();
}

$lecturer_id = $_SESSION['user'];
// Define all days of the week (Move this outside of the POST check)
$days_of_week = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];

// Define all time slots (Move this outside of the POST check)
$time_slots = [
    '08:30:00 - 09:30:00',
    '09:30:00 - 10:30:00',
    '10:30:00 - 11:30:00',
    '11:30:00 - 12:30:00',
    '12:30:00 - 13:00:00', // Interval
    '13:00:00 - 14:00:00',
    '14:00:00 - 15:00:00',
    '15:00:00 - 16:00:00',
    '16:00:00 - 17:00:00'
];



$query = "
SELECT 
    ls.id AS timetable_id,
    s.subject_number,
    lh.hall_name,
    b.batch_name,
    d.dept_code,
    ts.start_time,
    ts.end_time,
    ls.days AS day_of_week
FROM lecture_schedule ls
JOIN subjects s ON ls.subject_id = s.id
JOIN lecture_halls lh ON ls.hall_id = lh.id
JOIN batches b ON ls.batch_id = b.id
JOIN departments d ON b.department_id = d.id
JOIN timeslot ts ON ls.slot_id = ts.slot_id
WHERE ls.lecturer_id = ?
ORDER BY FIELD(ls.days, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'), ts.start_time
";

// Prepare the statement using PDO
$stmt = $conn->prepare($query);
$stmt->execute([$lecturer_id]);

// Fetch all results
$lectures = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Create a 2D array to hold the timetable data [day][time] => lecture details
$timetable = [];
foreach ($days_of_week as $day) {
    $timetable[$day] = [];
}

// Fill the timetable with lecture details
foreach ($lectures as $lecture) {
    $day = $lecture['day_of_week'];
    $time = $lecture['start_time'] . ' - ' . $lecture['end_time'];

    // Store the lecture details in the timetable array under the correct day and time
    $timetable[$day][$time] = [
        'subject_number' => $lecture['subject_number'],
        'dept_code' => $lecture['dept_code'],
        'batch_name' => $lecture['batch_name'],
        'hall_name' => $lecture['hall_name']
    ];
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Full Lecture Timetable</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/theme.css"> <!-- Link to theme CSS -->
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

        /* Interval Label */
        .interval-label {
            text-align: center;
            background-color: #ffc107;
            color: #000;
            font-weight: bold;
            padding: 5px;
            border-radius: 5px;
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

    <div class="container mt-5 text-center">
        <h2>Your Full Lecture Timetable</h2>

        <table class="table table-bordered table-hover timetable-table">
            <thead>
                <tr>
                    <th>Time</th>
                    <?php foreach ($days_of_week as $day) : ?>
                        <th><?php echo $day; ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($time_slots as $time) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($time); ?></td>
                        <?php foreach ($days_of_week as $day) : ?>
                            <td>
                                <?php
                                // Extract start and end time for comparison
                                list($start_time, $end_time) = explode(' - ', $time);
                                $lecture_found = false;

                                // Check if the lecture exists in this time slot
                                if (isset($timetable[$day][$start_time . ' - ' . $end_time])) {
                                    $lecture = $timetable[$day][$start_time . ' - ' . $end_time];
                                    echo "<strong>" . htmlspecialchars($lecture['subject_number']) . "</strong><br>";
                                    echo "<em>" . htmlspecialchars($lecture['dept_code']) . "</em><br>";
                                    echo "Batch: " . htmlspecialchars($lecture['batch_name']) . "<br>";
                                    echo "Hall: " . htmlspecialchars($lecture['hall_name']);
                                    $lecture_found = true;
                                }

                                // If no lecture found, show empty cell or Interval label
                                if (!$lecture_found) {
                                    if ($time === '12:30:00 - 13:00:00') {
                                        echo "<div class='interval-label'>Interval</div>";
                                    } else {
                                        echo "<span>--</span>";
                                    }
                                }
                                ?>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <?php if (empty($lectures)) : ?>
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