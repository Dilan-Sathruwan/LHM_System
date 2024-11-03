<?php

include './db_connection.inc.php';

if (isset($_GET['type']) && isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT); 
    $type = $_GET['type'];


    if (filter_var($id, FILTER_VALIDATE_INT)) {
        // Determine which table to delete from based on the type
        switch ($type) {
            case 'student':
                $sql = "DELETE FROM students WHERE id = :id";
                break;
            case 'lectures':
                $sql = "DELETE FROM lecturers WHERE id = :id";
                break;
            case 'batches':
                $sql = "DELETE FROM batches WHERE id = :id";
                break;
            case 'LectureHall':
                $sql = "DELETE FROM lecture_halls WHERE id = :id";
                break;
            default:
                echo "Invalid type!";
                exit();
        }

        $stmt = $conn->prepare($sql);
        if ($stmt->execute([':id' => $id])) {
            header("Location: ../{$type}.php?message=Record deleted successfully!"); 
            exit();
        } else {
            echo "Error deleting record.";
        }
    } else {
        echo "Invalid ID!";
    }
} else {
    echo "Invalid Request!";
}

?>


