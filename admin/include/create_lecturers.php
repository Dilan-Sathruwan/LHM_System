<?php 
include 'db_connection.inc.php';
include 'function.inc.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    
    $profile_image = filter_input(INPUT_POST, 'profile_image',  FILTER_SANITIZE_SPECIAL_CHARS);
    $index_num = filter_input(INPUT_POST, 'Index_num',  FILTER_SANITIZE_SPECIAL_CHARS);
    $username = filter_input(INPUT_POST, 'username',  FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password',  FILTER_SANITIZE_SPECIAL_CHARS);
    $phonenum = filter_input(INPUT_POST, 'phonenumber',  FILTER_VALIDATE_INT);
    $lecturerole = filter_input(INPUT_POST, 'lecturerole', FILTER_SANITIZE_SPECIAL_CHARS);
    $address = filter_input(INPUT_POST, 'address',  FILTER_SANITIZE_SPECIAL_CHARS);
    $about = filter_input(INPUT_POST, 'about',  FILTER_SANITIZE_SPECIAL_CHARS);
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT); // Hidden input field for the lecturer ID

    if ($email === false) {
        die('Invalid email address.');
    }


    $file = $_FILES['profile_image'] ?? null; // Get the uploaded file

    if (!empty($id)) {
        // Update lecturer details
        $imageUploadResult = uploadOrUpdateImage($conn, $file, $id); // Call your image upload function
        $result = lecturersUpdate($conn, $id, $index_num, $username, $email, $password, $lecturerole, $address, $phonenum, $about);
    } else {
        // Create a new lecturer
        $imageUploadResult = uploadOrUpdateImage($conn, $file);
        $result = lecturersCreate($conn, $index_num, $username, $email, $password, $lecturerole, $address, $phonenum, $about, $imageUploadResult);

    }
    

    
    header("Location:../lectures.php?message=" . urlencode($result));
}

?>