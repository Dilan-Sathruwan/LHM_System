<?php
session_start();
include '../includes/db_connection.inc.php'; // Ensure this path is correct

// Check if user is logged in as Lecturer
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Lecturer') {
    header("Location: ../auth/login.php");
    exit();
}

$lecturer_id = $_SESSION['user_id'];

// Handle deletion of a lecture
if (isset($_GET['delete'])) {
    $lecture_id = $_GET['delete'];
    $delete_query = "DELETE FROM Timetable WHERE timetable_id = ? AND lecturer_id = ?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("ii", $lecture_id, $lecturer_id);
    $stmt->execute();
    $stmt->close();
    header("Location: manage_lectures.php");
    exit();
}

// Handle adding a new lecture
if (isset($_POST['add_lecture'])) {
    $subject_id = $_POST['subject_id'];
    $hall_id = $_POST['hall_id'];
    $batch_id = $_POST['batch_id'];
    $day_of_week = $_POST['day_of_week'];
    $slot_id = $_POST['slot_id'];
    $semester_id = isset($_POST['semester_id']) ? intval($_POST['semester_id']) : null;

    // Check if the lecture already exists
    $check_query = "SELECT * FROM Timetable WHERE subject_id = ? AND lecturer_id = ? AND hall_id = ? AND batch_id = ? AND day_of_week = ? AND slot_id = ? AND semester_id = ?";
    $check_stmt = $conn->prepare($check_query);
    $check_stmt->bind_param("iiissii", $subject_id, $lecturer_id, $hall_id, $batch_id, $day_of_week, $slot_id, $semester_id);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        $error_message = "This lecture already exists.";
    } else {
        // Insert the new lecture including the semester_id
        $add_query = "INSERT INTO Timetable (subject_id, lecturer_id, hall_id, batch_id, day_of_week, slot_id, semester_id)
                      VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($add_query);
        $stmt->bind_param("iiissii", $subject_id, $lecturer_id, $hall_id, $batch_id, $day_of_week, $slot_id, $semester_id);
        $stmt->execute();
        $stmt->close();
        header("Location: manage_lectures.php");
        exit();
    }

    $check_stmt->close();
}

// Fetch the lectures for the logged-in lecturer
$query = "
    SELECT 
        t.timetable_id,
        s.subject_name,
        h.hall_name,
        b.batch_name,
        d.dept_name,
        ts.start_time,
        ts.end_time,
        t.day_of_week,
        t.semester_id
    FROM Timetable t
    JOIN Subjects s ON t.subject_id = s.subject_id
    JOIN Halls h ON t.hall_id = h.hall_id
    JOIN Batches b ON t.batch_id = b.batch_id
    JOIN Departments d ON b.dept_id = d.dept_id
    JOIN TimeSlots ts ON t.slot_id = ts.slot_id
    WHERE t.lecturer_id = ?
    ORDER BY FIELD(t.day_of_week, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'), ts.start_time
";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $lecturer_id);
$stmt->execute();
$result = $stmt->get_result();

$lectures = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $lectures[] = $row;
    }
}

// Fetch departments for the first dropdown
$departments_query = "SELECT dept_id, dept_name FROM Departments";
$departments = $conn->query($departments_query);

// Fetch halls for static dropdown
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
    <title>Manage Lectures</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link href="../assets/css/button.css" rel="stylesheet">
    <style>
        body {
            transition: background-color 0.5s, color 0.5s;
            font-family: Arial, sans-serif;
        }
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

        /* Center heading and adjust form width on smaller devices */
    h3 {
        font-size: 1.75rem;
        font-weight: bold;
    }

    form {
        margin: 0 auto;
        max-width: 100%;
    }

    /* Add some padding to form elements */
    .form-control {
        padding: 10px;
        font-size: 1rem;
    }

    /* Make sure the form is well-spaced on mobile */
    @media (max-width: 768px) {
        h3 {
            font-size: 1.5rem;
        }

        .form-group {
            margin-bottom: 15px;
        }

        button {
            margin-top: 10px;
        }
    }

    /* Style the form fields and buttons */
    .form-control {
        border-radius: 5px;
        border: 1px solid #ced4da;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #80bdff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.25);
    }

    button {
        font-size: 1.1rem;
        padding: 10px;
        border-radius: 5px;
    }
    </style>
</head>
<body>

<?php
$page_title = "Manage Lectures";
include '../includes/lecturer_header.php';
?>

<div class="container mt-5">
    <h2>Manage Your Lectures</h2>

    <!-- Display error message if exists -->
    <?php if (isset($error_message)): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($error_message); ?></div>
    <?php endif; ?>
    
<!-- Form to add new lecture -->
<h3 class="mt-5 text-center">Add New Lecture</h3>
<form id="lecture-form" action="manage_lectures.php" method="post" class="needs-validation" novalidate>
    <div class="row">
        <!-- Department Selection -->
        <div class="form-group col-lg-6 col-md-12 mb-3">
            <label for="department_id">Department</label>
            <select name="department_id" id="department_id" class="form-control" required>
                <option value="">Select a Department</option>
                <?php while ($department = $departments->fetch_assoc()) : ?>
                    <option value="<?php echo $department['dept_id']; ?>"><?php echo $department['dept_name']; ?></option>
                <?php endwhile; ?>
            </select>
            <div class="invalid-feedback">Please select a department.</div>
        </div>

        <!-- Batch Selection -->
        <div class="form-group col-lg-6 col-md-12 mb-3">
            <label for="batch_id">Batch</label>
            <select name="batch_id" id="batch_id" class="form-control" required disabled>
                <option value="">Select a Batch</option>
            </select>
            <div class="invalid-feedback">Please select a batch.</div>
        </div>
    </div>

    <div class="row">
        <!-- Semester Selection -->
        <div class="form-group col-lg-6 col-md-12 mb-3">
            <label for="semester_id">Semester</label>
            <select name="semester_id" id="semester_id" class="form-control" required disabled>
                <option value="">Select a Semester</option>
            </select>
            <div class="invalid-feedback">Please select a semester.</div>
        </div>

        <!-- Subject Selection -->
        <div class="form-group col-lg-6 col-md-12 mb-3">
            <label for="subject_id">Subject</label>
            <select name="subject_id" id="subject_id" class="form-control" required disabled>
                <option value="">Select a Subject</option>
            </select>
            <div class="invalid-feedback">Please select a subject.</div>
        </div>
    </div>

    <div class="row">
        <!-- Hall Selection -->
        <div class="form-group col-lg-6 col-md-12 mb-3">
            <label for="hall_id">Hall</label>
            <select name="hall_id" class="form-control" required>
                <?php while ($hall = $halls->fetch_assoc()) : ?>
                    <option value="<?php echo $hall['hall_id']; ?>"><?php echo $hall['hall_name']; ?></option>
                <?php endwhile; ?>
            </select>
        </div>

        <!-- Day of the Week -->
        <div class="form-group col-lg-6 col-md-12 mb-3">
            <label for="day_of_week">Day of the Week</label>
            <select name="day_of_week" class="form-control" required>
                <option value="Monday">Monday</option>
                <option value="Tuesday">Tuesday</option>
                <option value="Wednesday">Wednesday</option>
                <option value="Thursday">Thursday</option>
                <option value="Friday">Friday</option>
            </select>
        </div>
    </div>

    <div class="row">
        <!-- Time Slot Selection -->
        <div class="form-group col-lg-6 col-md-12 mb-3">
            <label for="slot_id">Time Slot</label>
            <select name="slot_id" class="form-control" required>
                <?php while ($slot = $timeslots->fetch_assoc()) : ?>
                    <option value="<?php echo $slot['slot_id']; ?>"><?php echo $slot['start_time'] . ' - ' . $slot['end_time']; ?></option>
                <?php endwhile; ?>
            </select>
        </div>
    </div>

    <!-- Submit Button -->
    <div class="f row justify-content-center">
        <button type="submit" name="add_lecture" class="but2 col-10 col-lg-6">Add Lecture</button>
    </div>
</form>

    <!-- Display lectures -->
    <?php if (!empty($lectures)) : ?>
        <table class="table table-bordered mt-5">
        <thead>
                    <tr>
                        <th>Day</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Subject</th>
                        <th>Department</th>
                        <th>Batch</th>
                        <th>Hall</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lectures as $lecture) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($lecture['day_of_week']); ?></td>
                            <td><?php echo htmlspecialchars($lecture['start_time']); ?></td>
                            <td><?php echo htmlspecialchars($lecture['end_time']); ?></td>
                            <td><?php echo htmlspecialchars($lecture['subject_name']); ?></td>
                            <td><?php echo htmlspecialchars($lecture['dept_name']); ?></td>
                            <td><?php echo htmlspecialchars($lecture['batch_name']); ?></td>
                            <td><?php echo htmlspecialchars($lecture['hall_name']); ?></td>
                            <td>
                                <a href="edit_lecture.php?id=<?php echo $lecture['timetable_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="manage_lectures.php?delete=<?php echo $lecture['timetable_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this lecture?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>No lectures scheduled yet.</p>
        <?php endif; ?>
</div>

<script>
    $(document).ready(function() {
    // Department change event
    $('#department_id').change(function() {
        const deptId = $(this).val();
        if (deptId) {
            $.ajax({
                url: 'get_batches.php',
                type: 'POST',
                data: { dept_id: deptId },
                dataType: 'json',
                success: function(data) {
                    $('#batch_id').empty().append('<option value="">Select a Batch</option>').prop('disabled', false);
                    $.each(data, function(index, batch) {
                        $('#batch_id').append('<option value="' + batch.batch_id + '">' + batch.batch_name + '</option>');
                    });
                    $('#subject_id').prop('disabled', true).empty().append('<option value="">Select a Subject</option>');
                    $('#semester_id').prop('disabled', true).empty().append('<option value="">Select a Semester</option>');
                }
            });
        } else {
            $('#batch_id').empty().append('<option value="">Select a Batch</option>').prop('disabled', true);
            $('#subject_id').empty().append('<option value="">Select a Subject</option>').prop('disabled', true);
            $('#semester_id').empty().append('<option value="">Select a Semester</option>').prop('disabled', true);
        }
    });

    // Batch change event
    $('#batch_id').change(function() {
        const batchId = $(this).val();
        if (batchId) {
            $.ajax({
                url: 'get_semester.php',
                type: 'POST',
                data: { batch_id: batchId },
                dataType: 'json',
                success: function(data) {
                    $('#semester_id').empty().append('<option value="">Select a Semester</option>').prop('disabled', false);
                    $.each(data, function(index, semester) {
                        $('#semester_id').append('<option value="' + semester.semester_id + '">Semester ' + semester.semester_no + '</option>');
                    });
                }
            });
        } else {
            $('#semester_id').empty().append('<option value="">Select a Semester</option>').prop('disabled', true);
        }
    });

    // Semester change event to get subjects
    $('#semester_id').change(function() {
        const semesterId = $(this).val();
        if (semesterId) {
            $.ajax({
                url: 'get_subjects.php',
                type: 'POST',
                data: { semester_id: semesterId },
                dataType: 'json',
                success: function(data) {
                    $('#subject_id').empty().append('<option value="">Select a Subject</option>').prop('disabled', false);
                    $.each(data, function(index, subject) {
                        $('#subject_id').append('<option value="' + subject.subject_id + '">' + subject.subject_name + '</option>');
                    });
                }
            });
        } else {
            $('#subject_id').empty().append('<option value="">Select a Subject</option>').prop('disabled', true);
        }
    });
});
</script>

<?php
include '../includes/footer.php';
?>

</body>
</html>