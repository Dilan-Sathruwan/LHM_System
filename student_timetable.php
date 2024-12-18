<?php
session_start();
include 'admin/include/db_connection.inc.php';

if (!isset($_SESSION['St_id'])) {
    header("Location:signin.php");
    exit();
}

$student_id = $_SESSION['St_id'];
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
JOIN students st ON ls.batch_id = st.batch_id
WHERE st.id = ?
ORDER BY FIELD(ls.days, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'), ts.start_time
";


// Prepare the statement using PDO
$stmt = $conn->prepare($query);
$stmt->execute([$student_id]);

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
     <link href="./assets/vendor/bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">
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

        .navbar {
            padding: 1rem;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
        }

        .navbar-dark {
            background-color: #212529;
        }

        .navbar-brand {
            color: #ffffff !important;
            font-size: 1.5rem;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .navbar-brand:hover {
            color: #00bfff !important;
        }

        .nav-link {
            color: #ffffff !important;
            margin-left: 1rem;
            transition: color 0.3s ease, transform 0.3s;
        }

        .nav-link:hover {
            color: #00bfff !important;
            transform: translateY(-3px);
        }

        .btn-logout {
            padding: 0.5rem 1.5rem;
            font-size: 0.9rem;
            background-color: #dc3545;
            border: none;
            border-radius: 13px;
            transition: background-color 0.4s ease, transform 0.3s ease;
        }

        .text-light {
            color: #f8f9fa;
            /* Light text color for readability in dark mode */
        }

        .btn-logout:hover {
            background-color: #c82333;
            transform: scale(1.05);
        }

        /* Remove the white dot next to the logout button */
        .nav-item:last-child {
            margin-right: 0;
        }

        th{
            background-color: #007bff !important;
        }
    </style>
</head>

<body class="light-theme">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="./student.php">Studets Portal</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="./index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./student_timetable.php">View Timetable</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./student.php">Student</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-logout" href="./include/logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="container mt-5">

        <div class="bg-light text-center rounded mb-16">
            <div class="d-flex align-items-center justify-content-start mb-1">
                <a class="btn  btn-dark" href="student.php">Back to</a>

            </div>

        </div>
        <h2 class="bg-light text-center rounded mb-16">Your Full Student Timetable</h2>

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



    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
<!-- This Page Create by Loku -->