<?php
session_start();
require_once '../includes/db_connection.inc.php'; // Include database connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: /LHM_System/auth/login.php");
    exit();
}

// Handle adding a lecture
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_lecture'])) {
    // Prepare and execute the insertion of a new lecture
    $stmt = $conn->prepare("INSERT INTO lectures (subject_id, hall_id, lecture_date, start_time, end_time, lecturer_id) VALUES (:subject_id, :hall_id, :lecture_date, :start_time, :end_time, :lecturer_id)");
    $stmt->bindValue(':subject_id', $_POST['subject_id'], PDO::PARAM_INT);
    $stmt->bindValue(':hall_id', $_POST['hall_id'], PDO::PARAM_INT);
    $stmt->bindValue(':lecture_date', $_POST['lecture_date']);
    $stmt->bindValue(':start_time', $_POST['start_time']);
    $stmt->bindValue(':end_time', $_POST['end_time']);
    $stmt->bindValue(':lecturer_id', $_SESSION['user_id'], PDO::PARAM_INT); // Save the logged-in user's ID
    $stmt->execute();
}

// Fetch existing lectures with the lecturer's name
$lecturesStmt = $conn->prepare("
    SELECT l.id, s.name AS subject_name, d.name AS department_name, h.name AS hall_name, l.lecture_date, l.start_time, l.end_time, le.id AS lecturer_id, le.first_name, le.last_name
    FROM lectures l 
    JOIN subjects s ON l.subject_id = s.id 
    JOIN halls h ON l.hall_id = h.id 
    JOIN departments d ON s.department_id = d.id
    JOIN lecturers le ON l.lecturer_id = le.id
");
$lecturesStmt->execute();
$lectures = $lecturesStmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch subjects, departments, and halls for the dropdowns
$subjectsStmt = $conn->query("SELECT id, name FROM subjects");
$departmentsStmt = $conn->query("SELECT id, name FROM departments");
$hallsStmt = $conn->query("SELECT id, name FROM halls");
$subjects = $subjectsStmt->fetchAll(PDO::FETCH_ASSOC);
$departments = $departmentsStmt->fetchAll(PDO::FETCH_ASSOC);
$halls = $hallsStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Lectures</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Manage Lectures</h2>
        
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
                        <label for="lecture_date">Lecture Date:</label>
                        <input type="date" class="form-control" id="lecture_date" name="lecture_date" required>
                    </div>
                    <div class="form-group">
                        <label for="start_time">Start Time:</label>
                        <input type="time" class="form-control" id="start_time" name="start_time" required>
                    </div>
                    <div class="form-group">
                        <label for="end_time">End Time:</label>
                        <input type="time" class="form-control" id="end_time" name="end_time" required>
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
                            <th>Date</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Lecturer</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lectures as $lecture): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($lecture['subject_name']); ?></td>
                                <td><?php echo htmlspecialchars($lecture['department_name']); ?></td>
                                <td><?php echo htmlspecialchars($lecture['hall_name']); ?></td>
                                <td><?php echo htmlspecialchars($lecture['lecture_date']); ?></td>
                                <td><?php echo htmlspecialchars($lecture['start_time']); ?></td>
                                <td><?php echo htmlspecialchars($lecture['end_time']); ?></td>
                                <td><?php echo htmlspecialchars($lecture['first_name'] . ' ' . $lecture['last_name']); ?></td>
                                <td>
                                    <?php if ($lecture['lecturer_id'] == $_SESSION['user_id']): ?>
                                        <a href="edit_lecture.php?id=<?php echo $lecture['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <form method="POST" action="delete_lecture.php" style="display:inline;">
                                            <input type="hidden" name="lecture_id" value="<?php echo $lecture['id']; ?>">
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
