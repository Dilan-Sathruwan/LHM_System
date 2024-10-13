<?php
// require_once 'db_connection.inc.php';
include './include/db_connection.inc.php';

if (isset($_GET['department_id']) && isset($_GET['batch_id'])) {
    $department_id = $_GET['department_id'];
    $batch_id = $_GET['batch_id'];

    // Fetch the semester ID of the selected batch
    $stmt = $conn->prepare("SELECT semester_id FROM batches WHERE id = :batch_id");
    $stmt->bindParam(':batch_id', $batch_id, PDO::PARAM_INT);
    $stmt->execute();

    $batch = $stmt->fetch(PDO::FETCH_ASSOC);
    $semester_id = $batch['semester_id'];

    // Fetch subjects for the selected department and semester
    $stmt = $conn->prepare("SELECT id, subject_name FROM subjects WHERE department_id = :department_id AND semester_id = :semester_id");
    $stmt->bindParam(':department_id', $department_id, PDO::PARAM_INT);
    $stmt->bindParam(':semester_id', $semester_id, PDO::PARAM_INT);
    $stmt->execute();

    $subjects = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<option selected value=''>Select your subject</option>";
    
    if (count($subjects) > 0) {
        foreach ($subjects as $subject) {
            echo "<option value='" . $subject['id'] . "'>" . $subject['subject_name'] . "</option>";
        }
    } else {
        echo "<option value=''>No Subjects Available</option>";
    }
}
?>



