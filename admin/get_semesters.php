
<?php

include './include/db_connection.inc.php';

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
?>
