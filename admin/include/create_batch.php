<?php 
include 'db_connection.inc.php';
include 'function.inc.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    
    
    $batch_name = filter_input(INPUT_POST, 'batch_name',  FILTER_SANITIZE_SPECIAL_CHARS);
    $batch_year = filter_input(INPUT_POST, 'batch_year',  FILTER_SANITIZE_SPECIAL_CHARS);
    $dept_id = filter_input(INPUT_POST, 'dept', FILTER_SANITIZE_SPECIAL_CHARS);
    $sem_id = filter_input(INPUT_POST, 'semester',  FILTER_SANITIZE_SPECIAL_CHARS);
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

    
    if(!empty($id)) {
        //update lectures details
        $result = batchUpdate($conn, $id,$batch_name, $batch_year, $dept_id, $sem_id);
    }else{
         // Creating a new lecturer
         $result = batchCreate($conn, $batch_name, $batch_year, $dept_id, $sem_id);
    }

    header("Location:../Batches.php?message=" . urlencode($result));
}

?>