<?php
session_start();
require_once '../includes/db_connection.inc.php'; // Include database connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: /LHM_System/auth/login.php");
    exit();
}

$message = '';  // Variable to store messages

// Handle adding a lecture
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_lecture'])) {
    // Check if the selected hall is already booked for the given time slot and day
    $checkStmt = $conn->prepare("
        SELECT COUNT(*) FROM timetable
        WHERE hall_id = :hall_id AND time_slot_id = :time_slot_id AND day_of_week = :day_of_week
    ");
    $checkStmt->bindValue(':hall_id', $_POST['hall_id'], PDO::PARAM_INT);
    $checkStmt->bindValue(':time_slot_id', $_POST['time_slot_id'], PDO::PARAM_INT);
    $checkStmt->bindValue(':day_of_week', $_POST['day_of_week'], PDO::PARAM_STR);
    $checkStmt->execute();
    $existingBookingCount = $checkStmt->fetchColumn();

    // If no booking exists for the hall at the selected time slot and day, proceed
    if ($existingBookingCount == 0) {
        // Prepare and execute the insertion of a new timetable entry
        $stmt = $conn->prepare("
            INSERT INTO timetable (lecturer_id, subject_id, time_slot_id, day_of_week, hall_id) 
            VALUES (:lecturer_id, :subject_id, :time_slot_id, :day_of_week, :hall_id)
        ");
        $stmt->bindValue(':lecturer_id', $_SESSION['user_id'], PDO::PARAM_INT); // Save the logged-in user's ID
        $stmt->bindValue(':subject_id', $_POST['subject_id'], PDO::PARAM_INT);
        $stmt->bindValue(':time_slot_id', $_POST['time_slot_id'], PDO::PARAM_INT);
        $stmt->bindValue(':day_of_week', $_POST['day_of_week'], PDO::PARAM_STR);
        $stmt->bindValue(':hall_id', $_POST['hall_id'], PDO::PARAM_INT);
        $stmt->execute();
        
        // Set success message
        $message = '<div class="alert alert-success">Lecture added successfully!</div>';
    } else {
        // If a booking already exists, set an error message
        $message = '<div class="alert alert-danger">The selected hall is already booked for this time slot and day.</div>';
    }
}

// Fetch existing timetable with the lecturer's name
$timetableStmt = $conn->prepare("
    SELECT t.id, s.name AS subject_name, d.name AS department_name, h.name AS hall_name, ts.start_time, ts.end_time, t.day_of_week, le.first_name, le.last_name, t.lecturer_id
    FROM timetable t
    JOIN subjects s ON t.subject_id = s.id
    JOIN halls h ON t.hall_id = h.id
    JOIN departments d ON s.department_id = d.id
    JOIN time_slots ts ON t.time_slot_id = ts.id
    JOIN lecturers le ON t.lecturer_id = le.id
");
$timetableStmt->execute();
$timetable = $timetableStmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch subjects, departments, halls, and time slots for the dropdowns
$subjectsStmt = $conn->query("SELECT id, name FROM subjects");
$departmentsStmt = $conn->query("SELECT id, name FROM departments");
$hallsStmt = $conn->query("SELECT id, name FROM halls");
$timeSlotsStmt = $conn->query("SELECT id, start_time, end_time FROM time_slots");
$subjects = $subjectsStmt->fetchAll(PDO::FETCH_ASSOC);
$departments = $departmentsStmt->fetchAll(PDO::FETCH_ASSOC);
$halls = $hallsStmt->fetchAll(PDO::FETCH_ASSOC);
$timeSlots = $timeSlotsStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Lectures</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .alert {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Manage Lectures</h2>

        <!-- Display Message -->
        <?php if (!empty($message)): ?>
            <?php echo $message; ?>
        <?php endif; ?>
        
        <!-- Add Lecture Form -->
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="mb-0">Add Lecture</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="subject_id">Subject:</label>
                        <select class="form-control" id="subject_id" name="subject_id" required>
                            <option value="">Select Subject</option>
                            <?php foreach ($subjects as $subject): ?>
                                <option value="<?php echo $subject['id']; ?>"><?php echo htmlspecialchars($subject['name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="hall_id">Hall:</label>
                        <select class="form-control" id="hall_id" name="hall_id" required>
                            <option value="">Select Hall</option>
                            <?php foreach ($halls as $hall): ?>
                                <option value="<?php echo $hall['id']; ?>"><?php echo htmlspecialchars($hall['name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="day_of_week">Day of the Week:</label>
                        <select class="form-control" id="day_of_week" name="day_of_week" required>
                            <option value="">Select Day</option>
                            <option value="Monday">Monday</option>
                            <option value="Tuesday">Tuesday</option>
                            <option value="Wednesday">Wednesday</option>
                            <option value="Thursday">Thursday</option>
                            <option value="Friday">Friday</option>
                            <option value="Saturday">Saturday</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="time_slot_id">Time Slot:</label>
                        <select class="form-control" id="time_slot_id" name="time_slot_id" required>
                            <option value="">Select Time Slot</option>
                            <?php foreach ($timeSlots as $timeSlot): ?>
                                <option value="<?php echo $timeSlot['id']; ?>">
                                    <?php echo htmlspecialchars($timeSlot['start_time'] . ' - ' . $timeSlot['end_time']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" name="add_lecture" class="btn btn-primary">Add Lecture</button>
                </form>
            </div>
        </div>

        <!-- List of Lectures -->
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="mb-0">Current Lectures</h4>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Subject</th>
                            <th>Department</th>
                            <th>Hall</th>
                            <th>Day</th>
                            <th>Time</th>
                            <th>Lecturer</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($timetable as $entry): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($entry['subject_name']); ?></td>
                                <td><?php echo htmlspecialchars($entry['department_name']); ?></td>
                                <td><?php echo htmlspecialchars($entry['hall_name']); ?></td>
                                <td><?php echo htmlspecialchars($entry['day_of_week']); ?></td>
                                <td><?php echo htmlspecialchars($entry['start_time'] . ' - ' . $entry['end_time']); ?></td>
                                <td><?php echo htmlspecialchars($entry['first_name'] . ' ' . $entry['last_name']); ?></td>
                                <td>
                                    <?php if ($entry['lecturer_id'] == $_SESSION['user_id']): ?>
                                        <a href="edit_lecture.php?id=<?php echo $entry['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <form method="POST" action="delete_lecture.php" style="display:inline;">
                                            <input type="hidden" name="lecture_id" value="<?php echo $entry['id']; ?>">
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    <?php else: ?>
                                        <span class="text-muted">N/A</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
