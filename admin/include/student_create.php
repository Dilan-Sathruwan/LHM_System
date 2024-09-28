<?php 
include 'db_connection.inc.php';
include 'function.inc.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    
    $index_num = filter_input(INPUT_POST, 'Index_num',  FILTER_SANITIZE_SPECIAL_CHARS);
    $username = filter_input(INPUT_POST, 'username',  FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password',  FILTER_SANITIZE_SPECIAL_CHARS);
    $phonenum = filter_input(INPUT_POST, 'phonenumber',  FILTER_VALIDATE_INT);
    $lecturerole = filter_input(INPUT_POST, 'lecturerole', FILTER_SANITIZE_SPECIAL_CHARS);
    $address = filter_input(INPUT_POST, 'address',  FILTER_SANITIZE_SPECIAL_CHARS);
    $about = filter_input(INPUT_POST, 'about',  FILTER_SANITIZE_SPECIAL_CHARS);

    if ($email === false) {
        die('Invalid email address.');
    }

    $result = lecturersCreate($conn, $index_num, $username, $email, $password, $lecturerole, $address, $phonenum, $about);

    // Display the result (success or error message)
    echo $result;
}

// ,$target_file

?>