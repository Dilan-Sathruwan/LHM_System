<?php
session_start();
include '../includes/db_connection.inc.php';

if (isset($_POST['dept_id'])) {
    $dept_id = $_POST['dept_id'];

    $query = "SELECT batch_id, batch_name FROM Batches WHERE dept_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $dept_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $batches = [];
    while ($row = $result->fetch_assoc()) {
        $batches[] = $row;
    }

    echo json_encode($batches);
}
?>
