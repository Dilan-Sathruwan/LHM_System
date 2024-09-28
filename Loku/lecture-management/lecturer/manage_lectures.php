<?php
session_start();
include '../includes/db.php'; // Include your database connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: /auth/login.php");
    exit();
}

$error = '';
$success = '';

// Handle lecture addition
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST['title']);
    $date = trim($_POST['date']);
    $time = trim($_POST['time']);
    $departmentId = $_POST['department_id'];

    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO lectures (title, date, time, department_id, lecturer_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param('ssssi', $title, $date, $time, $departmentId, $_SESSION['user_id']);

    // Execute and check for errors
    if ($stmt->execute()) {
        $success = "Lecture added successfully.";
    } else {
        $error = "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Fetch current lectures
$stmt = $conn->prepare("SELECT lectures.id, lectures.title, lectures.date, lectures.time, departments.name AS department FROM lectures JOIN departments ON lectures.department_id = departments.id WHERE lectures.lecturer_id = ?");
$stmt->bind_param('i', $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$lectures = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
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
        <h2>Manage Your Lectures</h2>
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
        <?php elseif (!empty($success)): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
        <?php endif; ?>

        <h4>Add New Lecture</h4>
        <form method="POST" action="">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" class="form-control" id="date" name="date" required>
            </div>
            <div class="form-group">
                <label for="time">Time:</label>
                <input type="time" class="form-control" id="time" name="time" required>
            </div>
            <div class="form-group">
                <label for="department_id">Department:</label>
                <select class="form-control" id="department_id" name="department_id" required>
                    <option value="">Select Department</option>
                    <option value="1">IT Department</option>
                    <option value="2">Accounting Department</option>
                    <option value="3">English Department</option>
                    <option value="4">Project Management Department</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Add Lecture</button>
        </form>

        <h4 class="mt-5">Current Lectures</h4>
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Department</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($lectures) > 0): ?>
                    <?php foreach ($lectures as $lecture): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($lecture['title']); ?></td>
                            <td><?php echo htmlspecialchars($lecture['date']); ?></td>
                            <td><?php echo htmlspecialchars($lecture['time']); ?></td>
                            <td><?php echo htmlspecialchars($lecture['department']); ?></td>
                            <td>
                                <form method="POST" action="delete_lecture.php">
                                    <input type="hidden" name="lecture_id" value="<?php echo $lecture['id']; ?>">
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">No lectures found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <a href="dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
