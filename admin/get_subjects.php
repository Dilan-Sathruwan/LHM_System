<?php 

include './include/db_connection.inc.php';
//################## subjects model form fill current Id number > link subject page ######################
if (isset($_GET['id'])) {
    $subId = $_GET['id'];

    // Fetch batch details
    $stmt = $conn->prepare("SELECT * FROM subjects WHERE id = :id");
    $stmt->bindParam(':id', $subId);
    $stmt->execute();
    $sub = $stmt->fetch(PDO::FETCH_ASSOC);

    // Fetch departments and semesters for select options
    $stmtDept = $conn->query("SELECT id, department_name FROM departments");
    $departments = $stmtDept->fetchAll(PDO::FETCH_ASSOC);

    $stmtSem = $conn->query("SELECT id, sem_name FROM semester");
    $semesters = $stmtSem->fetchAll(PDO::FETCH_ASSOC);

    // Prepare the response
    $response = [
        'id' => $sub['id'],
        'subject_number' => $sub['subject_number'],
        'subject_name' => $sub['subject_name'],
        'credits' => $sub['credits'],
        'department_id' => $sub['department_id'],
        'semester_id' => $sub['semester_id'],
        'departments' => $departments,
        'semesters' => $semesters
    ];

    // Send the response as JSON
    echo json_encode($response);
}
?>