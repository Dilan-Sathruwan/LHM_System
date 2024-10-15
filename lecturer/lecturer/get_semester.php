<?php
session_start();
include '../includes/db_connection.inc.php';

if (isset($_POST['batch_id'])) {
    $batch_id = $_POST['batch_id'];

    $query = "SELECT semester_id, semester_no FROM Semesters WHERE batch_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $batch_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $semesters = [];
    while ($row = $result->fetch_assoc()) {
        $semesters[] = $row;
    }

    echo json_encode($semesters);
}
?>
