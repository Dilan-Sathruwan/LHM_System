<?php
session_start();
require_once '../includes/db_connection.inc.php'; // Include database connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: /LHM_System/auth/login.php");
    exit();
}

// Fetch existing lecture details if id is provided
if (isset($_GET['id'])) {
    $lecture_id = intval($_GET['id']);
    $lectureStmt = $conn->prepare("SELECT l.id, l.subject_id, l.hall_id, l.lecture_date, l.start_time, l.end_time, s.name AS subject_name, d.name AS department_name 
                                    FROM lectures l 
                                    JOIN subjects s ON l.subject_id = s.id 
                                    JOIN departments d ON s.department_id = d.id 
                                    WHERE l.id = :id");
    $lectureStmt->bindValue(':id', $lecture_id, PDO::PARAM_INT);
    $lectureStmt->execute();
    $lecture = $lectureStmt->fetch(PDO::FETCH_ASSOC);

    // Check if the lecture exists
    if (!$lecture) {
        die("Lecture not found.");
    }
} else {
    die("Invalid request.");
}

// Handle the update of the lecture
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_lecture'])) {
    $stmt = $conn->prepare("UPDATE lectures SET subject_id = :subject_id, hall_id = :hall_id, lecture_date = :lecture_date, start_time = :start_time, end_time = :end_time WHERE id = :id");
    $stmt->bindValue(':subject_id', $_POST['subject_id'], PDO::PARAM_INT);
    $stmt->bindValue(':hall_id', $_POST['hall_id'], PDO::PARAM_INT);
    $stmt->bindValue(':lecture_date', $_POST['lecture_date']);
    $stmt->bindValue(':start_time', $_POST['start_time']);
    $stmt->bindValue(':end_time', $_POST['end_time']);
    $stmt->bindValue(':id', $lecture_id, PDO::PARAM_INT);
    $stmt->execute();
    
    // Redirect back to manage lectures after update
    header("Location: manage_lectures.php");
    exit();
}

// Fetch subjects and halls for the dropdowns
$subjectsStmt = $conn->query("SELECT id, name FROM subjects");
$hallsStmt = $conn->query("SELECT id, name FROM halls");
$subjects = $subjectsStmt->fetchAll(PDO::FETCH_ASSOC);
$halls = $hallsStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Lecture</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Edit Lecture</h2>

        <div class="card mt-4">
            <div class="card-header">
                <h4 class="mb-0">Edit Lecture Details</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="">
                    <input type="hidden" name="lecture_id" value="<?php echo $lecture['id']; ?>">
                    
                    <div class="form-group">
                        <label for="subject_id">Subject:</label>
                        <select class="form-control" id="subject_id" name="subject_id" required>
                            <option value="">Select Subject</option>
                            <?php foreach ($subjects as $subject): ?>
                                <option value="<?php echo $subject['id']; ?>" <?php echo ($subject['id'] == $lecture['subject_id']) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($subject['name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="hall_id">Hall:</label>
                        <select class="form-control" id="hall_id" name="hall_id" required>
                            <option value="">Select Hall</option>
                            <?php foreach ($halls as $hall): ?>
                                <option value="<?php echo $hall['id']; ?>" <?php echo ($hall['id'] == $lecture['hall_id']) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($hall['name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="lecture_date">Lecture Date:</label>
                        <input type="date" class="form-control" id="lecture_date" name="lecture_date" value="<?php echo htmlspecialchars($lecture['lecture_date']); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="start_time">Start Time:</label>
                        <input type="time" class="form-control" id="start_time" name="start_time" value="<?php echo htmlspecialchars($lecture['start_time']); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="end_time">End Time:</label>
                        <input type="time" class="form-control" id="end_time" name="end_time" value="<?php echo htmlspecialchars($lecture['end_time']); ?>" required>
                    </div>
                    
                    <button type="submit" name="update_lecture" class="btn btn-primary">Update Lecture</button>
                    <a href="manage_lectures.php" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
