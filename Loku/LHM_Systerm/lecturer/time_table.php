<?php
session_start();
require_once '../includes/db_connection.inc.php'; // Include database connection

// Fetch lecturer's lectures
$user_id = $_SESSION['user_id'];
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

// Create a 2D array representing days and time slots
$timetable = [
    'Monday' => [],
    'Tuesday' => [],
    'Wednesday' => [],
    'Thursday' => [],
    'Friday' => [],
];

// Populate the timetable array with lectures
foreach ($lectures as $lecture) {
    $dayOfWeek = date('l', strtotime($lecture['lecture_date'])); // Get the day name (e.g., Monday)
    $startTime = date('H:i', strtotime($lecture['start_time'])); // Format start time
    
    // Add the lecture details to the corresponding day and time slot
    if (isset($timetable[$dayOfWeek])) {
        $timetable[$dayOfWeek][$startTime] = $lecture;
    }
}

// Generate the timetable table rows
$timeslots = [
    '08:30 – 09:30', '09:30 – 10:30', '10:30 – 11:30', '11:30 – 12:30', 
    '12:30 – 01:00 (Interval)', '01:00 – 02:00', '02:00 – 03:00', 
    '03:00 – 04:00', '04:00 – 05:00'
];

$actualTimes = [
    '08:30', '09:30', '10:30', '11:30', '12:30', '13:00', '14:00', '15:00', '16:00'
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Timetable</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        table { width: 100%; }
        th, td { text-align: center; vertical-align: middle; }
        .interval { background-color: #ccc; font-weight: bold; }
        .subject-cell { background-color: #e3f2fd; }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>Your Lecture Timetable</h2>
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Time</th>
                    <th>Monday</th>
                    <th>Tuesday</th>
                    <th>Wednesday</th>
                    <th>Thursday</th>
                    <th>Friday</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($timeslots as $index => $timeslot): ?>
                    <tr>
                        <td><?php echo $timeslot; ?></td>
                        
                        <?php foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'] as $day): ?>
                            <?php if (strpos($timeslot, 'Interval') !== false): ?>
                                <td class="interval">Interval</td>
                            <?php else: ?>
                                <?php if (isset($timetable[$day][$actualTimes[$index]])): ?>
                                    <?php $lecture = $timetable[$day][$actualTimes[$index]]; ?>
                                    <td class="subject-cell">
                                        <?php echo htmlspecialchars($lecture['subject_name']); ?><br>
                                        <?php echo htmlspecialchars($lecture['hall_name']); ?>
                                    </td>
                                <?php else: ?>
                                    <td></td>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
