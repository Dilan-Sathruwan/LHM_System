<?php
session_start();
include '../includes/db.php'; // Include your database connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: /auth/login.php");
    exit();
}

// Check if the lecture ID is set in the POST request
if (isset($_POST['lecture_id'])) {
    $lectureId = intval($_POST['lecture_id']); // Get the lecture ID from the POST request

    // Prepare SQL statement to delete the lecture
    $stmt = $conn->prepare("DELETE FROM lectures WHERE id = ? AND lecturer_id = ?");
    $stmt->bind_param('ii', $lectureId, $_SESSION['user_id']);

    // Execute the statement and check for errors
    if ($stmt->execute()) {
        // Successful deletion
        $_SESSION['message'] = "Lecture deleted successfully.";
    } else {
        // Error in deletion
        $_SESSION['error'] = "Error deleting lecture: " . $stmt->error;
    }

    $stmt->close();
} else {
    // Lecture ID was not set
    $_SESSION['error'] = "Lecture ID is missing.";
}

// Redirect back to the manage lectures page
header("Location: manage_lectures.php");
exit();
?>
