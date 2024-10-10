
<?php

include './include/db_connection.inc.php';

//show depertment avalible semester
if (isset($_GET['department_id'])) {
    $department_id = $_GET['department_id'];

    // Fetch semesters for the given department
    $stmt = $conn->prepare("SELECT id, batch_name FROM batches WHERE department_id = :department_id");
    $stmt->bindParam(':department_id', $department_id);
    $stmt->execute();

    $semesters = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (count($semesters) > 0) {
        foreach ($semesters as $semester) {
            echo "<option value='" . $semester['id'] . "'>" . $semester['batch_name'] . "</option>";
        }
    } else {
        echo "<option value=''>No Semesters Available</option>";
    }
}



//################## batch model form fill current Id number > link batches page ######################
if (isset($_GET['id'])) {
    $batchId = $_GET['id'];

    // Fetch batch details
    $stmt = $conn->prepare("SELECT * FROM batches WHERE id = :id");
    $stmt->bindParam(':id', $batchId);
    $stmt->execute();
    $batch = $stmt->fetch(PDO::FETCH_ASSOC);

    // Fetch departments and semesters for select options
    $stmtDept = $conn->query("SELECT id, department_name FROM departments");
    $departments = $stmtDept->fetchAll(PDO::FETCH_ASSOC);

    $stmtSem = $conn->query("SELECT id, sem_name FROM semester");
    $semesters = $stmtSem->fetchAll(PDO::FETCH_ASSOC);

    // Prepare the response
    $response = [
        'id' => $batch['id'],
        'batch_name' => $batch['batch_name'],
        'batch_year' => $batch['batch_year'],
        'department_id' => $batch['department_id'],
        'semester_id' => $batch['semester_id'],
        'departments' => $departments,
        'semesters' => $semesters
    ];

    // Send the response as JSON
    echo json_encode($response);
}





?>
