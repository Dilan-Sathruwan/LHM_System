<?php
include 'db_connection.inc.php';
include 'function.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $profile_image = filter_input(INPUT_POST, 'profile_image',  FILTER_SANITIZE_SPECIAL_CHARS);
    $index_num = filter_input(INPUT_POST, 'Index_num',  FILTER_SANITIZE_SPECIAL_CHARS);
    $student_name = filter_input(INPUT_POST, 'Student_name',  FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $mobile_num = filter_input(INPUT_POST, 'mobile_num',  FILTER_SANITIZE_SPECIAL_CHARS);
    $address = filter_input(INPUT_POST, 'address',  FILTER_SANITIZE_SPECIAL_CHARS);
    $courses = filter_input(INPUT_POST, 'department_id', FILTER_SANITIZE_SPECIAL_CHARS);
    $batch_id = filter_input(INPUT_POST, 'batch_id',  FILTER_SANITIZE_SPECIAL_CHARS);
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

    if ($email === false) {
        die('Invalid email address.');
    }

    $file = $_FILES['profile_image'] ?? null;

    $imageUploadResult = sUploadOrUpdateImage($conn, $file, $id);

    if (!empty($id)) {
        $result = studentUpdate($conn, $id, $index_num, $student_name, $email, $mobile_num, $address, $courses, $batch_id);
    } else {

        $imagePath = $imageUploadResult ? $imageUploadResult : './include/uploads/pngwing.com.png';
        $result = studentCreate($conn, $index_num, $student_name, $email, $mobile_num, $address, $courses, $batch_id, $imagePath);
    }

    header("Location:../student.php?message=" . urlencode($result));
    exit();
}

