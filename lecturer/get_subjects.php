<?php
session_start();
include '../includes/db_connection.inc.php';

if (isset($_POST['semester_id'])) {
    $semester_id = $_POST['semester_id'];

    $query = "SELECT subject_id, subject_name FROM Subjects WHERE semester_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $semester_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $subjects = [];
    while ($row = $result->fetch_assoc()) {
        $subjects[] = $row;
    }

    echo json_encode($subjects);
}
?>
