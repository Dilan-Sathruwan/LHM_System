<?php
session_start();
include '../includes/db_connection.inc.php';

// Ensure user is logged in and is a lecturer
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'Lecturer') {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $subject_id = $_POST['subject_id'];
    $batch_id = $_POST['batch_id'];
    $lecturer_id = $_SESSION['lecturer_id']; // Assuming lecturer ID is stored in session
    $semester_id = $_POST['semester_id']; // You may need to modify this based on your form

    // Insert the lecture into the Timetable
    $query = "INSERT INTO Timetable (subject_id, lecturer_id, hall_id, batch_id, semester_id, day_of_week, slot_id)
              VALUES (?, ?, ?, ?, ?, ?, ?)";
    // Replace ? with actual values and modify according to your logic

    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("iiisssss", $subject_id, $lecturer_id, $hall_id, $batch_id, $semester_id, $day_of_week, $slot_id);
        if ($stmt->execute()) {
            echo "Lecture successfully scheduled.";
        } else {
            echo "Error scheduling lecture: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}
// <!-- This Page Create by Loku -->