<?php
include "include/db_connection.inc.php";

// Fetch the lecturer ID from the session (static for now)
$lecturer_id = 1;

// Define all days of the week
$days_of_week = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];

// Define all time slots
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

// Fetch the lecturer's schedule
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f0f2f5;
            font-family: Arial, sans-serif;
        }

        .timetable-table {
            border-collapse: collapse;
            width: 100%;
            margin: 20px 0;
        }

        .timetable-table th,
        .timetable-table td {
            text-align: center;
            vertical-align: middle;
            border: 1px solid #dee2e6;
            padding: 10px;
        }

        .timetable-table th {
            background-color: #0d6efd;
            color: white;
        }

        .timetable-table td {
            height: 100px;
            transition: background-color 0.3s ease;
        }

        .timetable-table td:hover {
            background-color: #e9ecef;
        }

        .interval-label {
            background-color: #ffc107;
            color: black;
            font-weight: bold;
            padding: 5px;
            border-radius: 5px;
        }

        @media (max-width: 768px) {
            .timetable-table {
                font-size: 12px;
            }

            .timetable-table td {
                height: 60px;
            }
        }

        .table-wrapper {
            overflow-x: auto;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Your Full Lecture Timetable</h2>
        <div class="table-responsive">
            <table class="table table-bordered timetable-table table-striped">
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
        </div>

        <?php if (empty($lectures)) : ?>
            <div class="alert alert-warning text-center">
                <p>No scheduled lectures found for you.</p>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>