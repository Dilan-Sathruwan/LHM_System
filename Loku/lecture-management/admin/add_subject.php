<?php
session_start();
include '../includes/db.php';  // Database connection

// Check if the user is logged in and is an admin
// if (!isset($_SESSION['user_id'])) {
//     header("Location: /pages/login.php");
//     exit();
// }

// Handle subject deletion
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['subject_id'])) {
    $subject_id = $_POST['subject_id'];

    // Prepare and execute the delete statement
    $stmt = $conn->prepare("DELETE FROM subjects WHERE id = ?");
    $stmt->bind_param('i', $subject_id);
    
    if ($stmt->execute()) {
        echo '<div class="alert alert-success">Subject deleted successfully!</div>';
    } else {
        echo '<div class="alert alert-danger">Error deleting subject: ' . $stmt->error . '</div>';
    }
}

// Fetch all subjects for deletion
$result = $conn->query("SELECT id, name FROM subjects");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Subject</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Delete Subject</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="subject_id">Select Subject to Delete:</label>
                <select class="form-control" id="subject_id" name="subject_id" required>
                    <option value="">Select a subject</option>
                    <?php
                    // Check if there are subjects
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row['id'] . '">' . htmlspecialchars($row['name']) . '</option>';
                        }
                    } else {
                        echo '<option value="">No subjects available</option>';
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-danger">Delete Subject</button>
            <a href="manage_subjects.php" class="btn btn-secondary">Cancel</a>
        </form>
        <hr>
        <a href="manage_subjects.php" class="btn btn-primary">Back to Manage Subjects</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
