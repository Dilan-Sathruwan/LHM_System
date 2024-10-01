<?php
session_start();
include '../includes/header.php';  // Common header
include '../includes/db.php';      // Database connection

// Handle the form submission to schedule a lecture
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $lecturer_id = $_POST['lecturer'];
    $subject_id = $_POST['subject'];
    $department_id = $_POST['department'];
    $hall_id = $_POST['hall'];
    $lecture_date = $_POST['date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];

    // Insert the lecture into the database
    $stmt = $conn->prepare("INSERT INTO lectures (lecturer_id, subject_id, department_id, hall_id, lecture_date, start_time, end_time)
                            VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('iiiiiss', $lecturer_id, $subject_id, $department_id, $hall_id, $lecture_date, $start_time, $end_time);
    
    if ($stmt->execute()) {
        echo '<div class="alert alert-success">Lecture scheduled successfully!</div>';
    } else {
        echo '<div class="alert alert-danger">Failed to schedule lecture.</div>';
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule Lectures</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Schedule a Lecture</h1>
        <form method="POST" action="schedule_lectures.php">
            <div class="form-group">
                <label for="lecturer">Select Lecturer</label>
                <select class="form-control" id="lecturer" name="lecturer" required>
                    <option value="">Choose...</option>
                    <?php
                    $result = $conn->query("SELECT id, full_name FROM lecturers");
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='{$row['id']}'>{$row['full_name']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="subject">Select Subject</label>
                <select class="form-control" id="subject" name="subject" required>
                    <option value="">Choose...</option>
                    <?php
                    $result = $conn->query("SELECT id, subject_name FROM subjects");
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='{$row['id']}'>{$row['subject_name']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="department">Select Department</label>
                <select class="form-control" id="department" name="department" required>
                    <option value="">Choose...</option>
                    <?php
                    $result = $conn->query("SELECT id, name FROM departments");
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='{$row['id']}'>{$row['name']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="hall">Select Lecture Hall</label>
                <select class="form-control" id="hall" name="hall" required>
                    <option value="">Choose...</option>
                    <?php
                    $result = $conn->query("SELECT id, hall_name FROM lecture_halls");
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='{$row['id']}'>{$row['hall_name']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="date">Lecture Date</label>
                <input type="date" class="form-control" id="date" name="date" required>
            </div>

            <div class="form-group">
                <label for="start_time">Start Time</label>
                <input type="time" class="form-control" id="start_time" name="start_time" required>
            </div>

            <div class="form-group">
                <label for="end_time">End Time</label>
                <input type="time" class="form-control" id="end_time" name="end_time" required>
            </div>

            <button type="submit" class="btn btn-primary">Schedule Lecture</button>
        </form>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php include '../includes/footer.php'; // Common footer ?>
