<?php
session_start();
require_once '../includes/db_connection.inc.php'; // Include database connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: /LHM_System/auth/login.php");
    exit();
}

// Check if a POST request was made with the lecture ID to delete
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['lecture_id'])) {
    $lecture_id = intval($_POST['lecture_id']);

    // Prepare the delete statement
    $stmt = $conn->prepare("DELETE FROM lectures WHERE id = :id");
    $stmt->bindValue(':id', $lecture_id, PDO::PARAM_INT);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to manage lectures with a success message
        $_SESSION['success_message'] = "Lecture deleted successfully.";
        header("Location: manage_lectures.php");
        exit();
    } else {
        // Redirect back to manage lectures with an error message
        $_SESSION['error_message'] = "Failed to delete lecture.";
        header("Location: manage_lectures.php");
        exit();
    }
} else {
    // Redirect back to manage lectures if no valid request was made
    header("Location: manage_lectures.php");
    exit();
}
