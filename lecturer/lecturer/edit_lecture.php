<?php
session_start();
include '../includes/db_connection.inc.php'; // Ensure this path is correct

// Check if user is logged in as Lecturer
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Lecturer') {
    header("Location: ../auth/login.php");
    exit();
}

$lecturer_id = $_SESSION['user_id'];

// Fetch the lecture details to edit
if (isset($_GET['id'])) {
    $lecture_id = $_GET['id'];

    $query = "
        SELECT 
            t.timetable_id,
            t.subject_id,
            t.hall_id,
            t.batch_id,
            t.day_of_week,
            t.slot_id,
            s.subject_name,
            h.hall_name,
            b.batch_name
        FROM Timetable t
        JOIN Subjects s ON t.subject_id = s.subject_id
        JOIN Halls h ON t.hall_id = h.hall_id
        JOIN Batches b ON t.batch_id = b.batch_id
        WHERE t.timetable_id = ? AND t.lecturer_id = ?
    ";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $lecture_id, $lecturer_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        // If no lecture is found, redirect to manage_lectures.php
        header("Location: manage_lectures.php");
        exit();
    }

    $lecture = $result->fetch_assoc();
} else {
    // If ID is not set, redirect to manage_lectures.php
    header("Location: manage_lectures.php");
    exit();
}

// Handle updating the lecture
if (isset($_POST['update_lecture'])) {
    $hall_id = $_POST['hall_id'];
    $day_of_week = $_POST['day_of_week'];
    $slot_id = $_POST['slot_id'];

    $update_query = "
        UPDATE Timetable 
        SET hall_id = ?, day_of_week = ?, slot_id = ?
        WHERE timetable_id = ? AND lecturer_id = ?
    ";
    
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("isiii", $hall_id, $day_of_week, $slot_id, $lecture_id, $lecturer_id);
    $stmt->execute();
    $stmt->close();
    header("Location: manage_lectures.php");
    exit();
}

// Fetch halls for the dropdown
$halls_query = "SELECT hall_id, hall_name FROM Halls";
$halls = $conn->query($halls_query);

// Fetch time slots for static dropdown
$timeslots_query = "SELECT slot_id, start_time, end_time FROM TimeSlots WHERE is_interval = 0";
$timeslots = $conn->query($timeslots_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Lecture</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
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
    background-color: rgba(52, 58, 64, 0.85); /* Dark table background */
    color: #f8f9fa;
}

.table thead {
    background-color: rgba(0, 123, 255, 0.9);
    color: #fff;
}

body.dark-theme .table thead {
    background-color: rgba(40, 167, 69, 0.9); /* Adjusted header color */
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
    background-color: #28a745; /* Change color for dark theme */
}
  
        h2, h3 {
            color: #007bff;
        }
        table th {
            background-color: #007bff;
            color: white;
        }
        .form-control, .form-group label {
            border-radius: 0.5rem;
        }
        .alert {
            border-radius: 0.5rem;
        }
    </style>
</head>
<body>
<?php
$page_title = "Edit Lectures";
include '../includes/header.php';
?>
    <div class="container mt-5">
        <h2>Edit Lecture</h2>
        <form id="lecture-form" action="edit_lecture.php?id=<?php echo $lecture['timetable_id']; ?>" method="post">
            <div class="form-group">
                <label for="subject_name">Subject</label>
                <input type="text" class="form-control" id="subject_name" value="<?php echo htmlspecialchars($lecture['subject_name']); ?>" readonly>
            </div>

            <div class="form-group">
                <label for="batch_name">Batch</label>
                <input type="text" class="form-control" id="batch_name" value="<?php echo htmlspecialchars($lecture['batch_name']); ?>" readonly>
            </div>

            <div class="form-group">
                <label for="hall_id">Hall</label>
                <select name="hall_id" id="hall_id" class="form-control" required>
                    <option value="">Select a Hall</option>
                    <?php while ($hall = $halls->fetch_assoc()) : ?>
                        <option value="<?php echo $hall['hall_id']; ?>" <?php echo ($hall['hall_id'] == $lecture['hall_id']) ? 'selected' : ''; ?>>
                            <?php echo $hall['hall_name']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="day_of_week">Day of the Week</label>
                <select name="day_of_week" class="form-control" required>
                    <option value="Monday" <?php echo ($lecture['day_of_week'] === 'Monday') ? 'selected' : ''; ?>>Monday</option>
                    <option value="Tuesday" <?php echo ($lecture['day_of_week'] === 'Tuesday') ? 'selected' : ''; ?>>Tuesday</option>
                    <option value="Wednesday" <?php echo ($lecture['day_of_week'] === 'Wednesday') ? 'selected' : ''; ?>>Wednesday</option>
                    <option value="Thursday" <?php echo ($lecture['day_of_week'] === 'Thursday') ? 'selected' : ''; ?>>Thursday</option>
                    <option value="Friday" <?php echo ($lecture['day_of_week'] === 'Friday') ? 'selected' : ''; ?>>Friday</option>
                </select>
            </div>

            <div class="form-group">
                <label for="slot_id">Time Slot</label>
                <select name="slot_id" class="form-control" required>
                    <?php while ($slot = $timeslots->fetch_assoc()) : ?>
                        <option value="<?php echo $slot['slot_id']; ?>" <?php echo ($slot['slot_id'] == $lecture['slot_id']) ? 'selected' : ''; ?>>
                            <?php echo $slot['start_time'] . ' - ' . $slot['end_time']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <button type="submit" name="update_lecture" class="btn btn-primary">Update Lecture</button>
        </form>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
