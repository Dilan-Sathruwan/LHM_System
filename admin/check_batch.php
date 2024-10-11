<?php
// Start session and include database connection (ensure your session is started and database config is included correctly)
session_start();

// PDO database connection
$dsn = "mysql:host=localhost;dbname=lhm_system2";
$username = "root";
$password = "12345";

try {
    $conn = new PDO($dsn, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}

// Fetch the lecturer ID from the session
$lecturer_id = 1;

// Fetch all batches for the dropdown
$batch_query = "SELECT id, batch_name FROM batches";
$batch_stmt = $conn->prepare($batch_query);
$batch_stmt->execute();
$batches = $batch_stmt->fetchAll(PDO::FETCH_ASSOC);

// Process the selected batch ID from the form submission
$selected_batch_id = isset($_POST['batch_id']) ? $_POST['batch_id'] : null;

// Define all days of the week
$days_of_week = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];

// Define all time slots (adjust as needed for your institution)
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

// Fetch the lecturer's schedule based on the selected batch (if any)
$query = "
    SELECT 
        ls.id AS timetable_id,
        s.subject_name,
        lh.hall_name,
        b.batch_name,
        d.department_name AS dept_name,
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
";

// Add a condition for batch filtering if a batch is selected
if ($selected_batch_id) {
    $query .= " AND ls.batch_id = ?";
}

$query .= " ORDER BY FIELD(ls.days, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'), ts.start_time";

// Prepare the statement using PDO
$stmt = $conn->prepare($query);

// Bind the lecturer ID and selected batch (if any)
if ($selected_batch_id) {
    $stmt->execute([$lecturer_id, $selected_batch_id]);
} else {
    $stmt->execute([$lecturer_id]);
}

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
        'subject_name' => $lecture['subject_name'],
        'dept_name' => $lecture['dept_name'],
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
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .timetable-table {
            border-collapse: collapse;
            width: 100%;
            margin: 20px 0;
        }
        .timetable-table th, .timetable-table td {
            text-align: center;
            vertical-align: middle;
            border: 1px solid #dee2e6;
            padding: 10px;
        }
        .timetable-table th {
            background-color: #007bff;
            color: white;
        }
        .timetable-table td {
            height: 100px;
        }
        .interval-label {
            background-color: #ffc107;
            color: black;
            font-weight: bold;
            padding: 5px;
            border-radius: 5px;
        }
        .print-btn {
            margin-bottom: 20px;
        }
        @media (max-width: 768px) {
            .timetable-table {
                font-size: 14px;
            }
        }
        @media print {
            body {
                background-color: white;
            }
            .btn, .print-btn, .form-group {
                display: none;
            }
            .timetable-table {
                border-collapse: collapse;
                width: 100%;
                font-size: 14px;
            }
            .timetable-table th {
                background-color: #007bff;
                color: white;
            }
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Your Full Lecture Timetable</h2>

        <!-- Print Button -->
        <div class="d-flex justify-content-between mb-3">
            
        <a class="btn btn-sm btn-primary" href="./schedules.php">Baack</a>
            <button class="btn btn-success print-btn" onclick="window.print()">Print Timetable</button>
        </div>

        <!-- Batch selection form -->
        <form method="POST" action="" class="mb-4">
            <div class="form-row align-items-end">
                <div class="form-group col-md-8">
                    <label for="batch_id">Select Batch:</label>
                    <select name="batch_id" id="batch_id" class="form-control">
                        <option value="">All Batches</option>
                        <?php foreach ($batches as $batch) : ?>
                            <option value="<?php echo htmlspecialchars($batch['id']); ?>" <?php echo ($selected_batch_id == $batch['id']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($batch['batch_name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                </div>
            </div>
        </form>

        <!-- Timetable -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped timetable-table">
                <thead class="thead-dark text-center">
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
                            <td class="align-middle text-center font-weight-bold"><?php echo htmlspecialchars($time); ?></td>
                            <?php foreach ($days_of_week as $day) : ?>
                                <td class="text-center">
                                    <?php 
                                    list($start_time, $end_time) = explode(' - ', $time);
                                    $lecture_found = false;

                                    if (isset($timetable[$day][$start_time . ' - ' . $end_time])) {
                                        $lecture = $timetable[$day][$start_time . ' - ' . $end_time];
                                        echo "<div class='lecture-info'>";
                                        echo "<strong class='text-primary'>" . htmlspecialchars($lecture['subject_name']) . "</strong><br>";
                                        echo "<em class='text-muted'>" . htmlspecialchars($lecture['dept_name']) . "</em><br>";
                                        echo "<small class='text-secondary'>Batch: " . htmlspecialchars($lecture['batch_name']) . "</small><br>";
                                        echo "<small class='text-dark'>Hall: " . htmlspecialchars($lecture['hall_name']) . "</small>";
                                        echo "</div>";
                                        $lecture_found = true;
                                    }

                                    if (!$lecture_found) {
                                        if ($time === '12:30:00 - 13:00:00') {
                                            echo "<div class='interval-label bg-warning text-dark py-2'>Interval</div>";
                                        } else {
                                            echo "<span class='text-muted'>--</span>";
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
            <p class="text-danger text-center">No lectures scheduled for this batch.</p>
        <?php endif; ?>
    </div>

    <!-- Custom CSS -->
    <style>
        .lecture-info {
            background-color: #f8f9fa;
            padding: 10px;
            border-radius: 5px;
        }
        .interval-label {
            border-radius: 5px;
            font-weight: bold;
        }
        @media print {
            .print-btn, form {
                display: none;
            }
            .table {
                width: 100%;
            }
        }
    </style>
</body>

</html>

