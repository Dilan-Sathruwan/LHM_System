<?php
// session_start();
include '../includes/db.php';  // Database connection

// Check if the user is logged in and is an admin
// if (!isset($_SESSION['user_id'])) {
//     header("Location: /pages/login.php");
//     exit();
// }

// Handle subject editing
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['subject_id'])) {
    $subject_id = $_POST['subject_id'];
    $subject_name = $_POST['subject_name'];

    // Prepare and execute the update statement
    $stmt = $conn->prepare("UPDATE subjects SET name = ? WHERE id = ?");
    $stmt->bind_param('si', $subject_name, $subject_id);
    
    if ($stmt->execute()) {
        echo '<div class="alert alert-success">Subject updated successfully!</div>';
    } else {
        echo '<div class="alert alert-danger">Error updating subject: ' . $stmt->error . '</div>';
    }
}

// Fetch subject details for editing
$subject_id = $_GET['id'];
$stmt = $conn->prepare("SELECT id, name FROM subjects WHERE id = ?");
$stmt->bind_param('i', $subject_id);
$stmt->execute();
$result = $stmt->get_result();
$subject = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Subject</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Subject</h2>
        <form method="POST" action="">
            <input type="hidden" name="subject_id" value="<?php echo $subject['id']; ?>">
            <div class="form-group">
                <label for="subject_name">Subject Name:</label>
                <input type="text" class="form-control" id="subject_name" name="subject_name" value="<?php echo $subject['name']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Subject</button>
            <a href="manage_subjects.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
