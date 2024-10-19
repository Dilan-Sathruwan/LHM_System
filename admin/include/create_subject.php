<?php 
include 'db_connection.inc.php';
include 'function.inc.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    
    
    $subject_nam = filter_input(INPUT_POST, 'subject_name',  FILTER_SANITIZE_SPECIAL_CHARS);
    $subject_number = filter_input(INPUT_POST, 'subject_number',  FILTER_SANITIZE_SPECIAL_CHARS);
    $credits = filter_input(INPUT_POST, 'credits', FILTER_SANITIZE_SPECIAL_CHARS);
    $dept = filter_input(INPUT_POST, 'dept',  FILTER_SANITIZE_SPECIAL_CHARS);
    $semester = filter_input(INPUT_POST, 'semester', FILTER_SANITIZE_SPECIAL_CHARS);
    $id = filter_input(INPUT_POST, 'subject_id',  FILTER_SANITIZE_NUMBER_INT);

    
    if(!empty($id)) {
        //update lectures details
        $result = SubjectUpdate($conn, $id, $subject_nam, $subject_number, $credits, $dept, $semester);
    }else{
         // Creating a new lecturer
         $result = SubjectCreate($conn, $subject_nam, $subject_number, $credits, $dept, $semester);
    }

    header("Location:../subject.php?message=" . urlencode($result));
}

?>