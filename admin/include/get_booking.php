<?php
include 'db_connection.inc.php';

if (isset($_GET['id'])) if (isset($_GET['id'])) {
    $lectureId = $_GET['id'];

    // Fetch lecture details
    $stmt = $conn->prepare("SELECT * FROM lecture_book WHERE id = :id");
    $stmt->bindParam(':id', $lectureId);
    $stmt->execute();
    $lecture = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($lecture) {
        // Prepare the response
        $response = [
            'id' => $lecture['id'],
            'lecturer_id' => $lecture['lecturer_id'],
            'department_id' => $lecture['department_id'],
            'batch_id' => $lecture['batch_id'],
            'subject_id' => $lecture['subject_id'],
            'hall_id' => $lecture['hall_id'],
            'days' => $lecture['days'],
            'time_slot' => $lecture['slot_id'],
        ];

        // Send the response as JSON
        echo json_encode($response);
    } else {
        echo json_encode(['error' => 'Lecture not found']);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}

?>
