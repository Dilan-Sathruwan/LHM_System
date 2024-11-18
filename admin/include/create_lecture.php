<?php 
include 'db_connection.inc.php';
include 'function.inc.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $lname = filter_input(INPUT_POST, 'lecturers',  FILTER_SANITIZE_SPECIAL_CHARS);
    $dept = filter_input(INPUT_POST, 'dept',  FILTER_SANITIZE_SPECIAL_CHARS);
    $batches = filter_input(INPUT_POST, 'batches', FILTER_SANITIZE_SPECIAL_CHARS);
    $subjects = filter_input(INPUT_POST, 'subjects',  FILTER_SANITIZE_SPECIAL_CHARS);
    $lecture_halls = filter_input(INPUT_POST, 'lecture_halls',  FILTER_SANITIZE_SPECIAL_CHARS);
    $days = filter_input(INPUT_POST, 'days',  FILTER_SANITIZE_SPECIAL_CHARS);
    $time_slot = filter_input(INPUT_POST, 'time_slot',  FILTER_SANITIZE_SPECIAL_CHARS);
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);


    if(!empty($id)) {

        $result = lectureUpdate($conn, $id, $lname, $lecture_halls, $days, $time_slot);
    }else{

        $result = lectureCreate($conn, $lname, $dept, $batches, $subjects, $lecture_halls, $days, $time_slot);
    }

    
    header("Location:../schedules.php?message=" . urlencode($result));
}


?>