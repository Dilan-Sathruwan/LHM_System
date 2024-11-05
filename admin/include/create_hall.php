<?php
include 'db_connection.inc.php';
include 'function.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    $hall_name = filter_input(INPUT_POST, 'hall_name', FILTER_SANITIZE_SPECIAL_CHARS);
    $capacity = filter_input(INPUT_POST, 'capacity', FILTER_SANITIZE_SPECIAL_CHARS);
    $location = filter_input(INPUT_POST, 'hall_location', FILTER_SANITIZE_SPECIAL_CHARS);

    if (!empty($id)) {
        //update lectures details
        $result = updateHall($conn, $hall_name, $capacity, $location, $id);
    } else {
        // Creating a new lecturer
        $result = createHall($conn, $hall_name, $capacity, $location);
    }

    header("Location:../subject.php?message=" . urlencode($result));

    header("Location: ../LectureHall.php?message=" . urlencode($result));
}
