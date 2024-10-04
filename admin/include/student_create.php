<?php 
include 'db_connection.inc.php';
include 'function.inc.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    
    $index_num = filter_input(INPUT_POST, 'Index_num',  FILTER_SANITIZE_SPECIAL_CHARS);
    $student_name = filter_input(INPUT_POST, 'Student_name',  FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $mobile_num = filter_input(INPUT_POST, 'Mobile_num',  FILTER_VALIDATE_INT);
    $address = filter_input(INPUT_POST, 'address',  FILTER_SANITIZE_SPECIAL_CHARS);
    $courses = filter_input(INPUT_POST, 'courses', FILTER_SANITIZE_SPECIAL_CHARS);
    $sem_year = filter_input(INPUT_POST, 'sem_year',  FILTER_SANITIZE_SPECIAL_CHARS);
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT); // Hidden input field for the lecturer ID

    if ($email === false) {
        die('Invalid email address.');
    }


    if(!empty($id)) {
        //update lectures details
        $result = studentUpdate($conn, $id, $index_num, $student_name, $email, $mobile_num, $address, $courses, $sem_year);
    }else{
         // Creating a new lecturer
        $result = studentCreate($conn, $index_num, $student_name, $email, $mobile_num, $address, $courses, $sem_year);
    }

    

    // Display the result (success or error message)
    // echo $result;
    header("Location:../student.php?message=" . urlencode($result));
}

?>