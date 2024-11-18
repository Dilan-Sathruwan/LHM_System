<?php
require_once 'db_connection.inc.php';

try {
    
    if (isset($_GET["query"])) {
        $query = $_GET["query"];

        // SQL query to fetch all data if "init" or search by email otherwise
        if ($query === "init") {
            $sql = "SELECT students.id, students.index_number, students.username, students.email, students.mobile_num, students.address, students.image_path, students.enrollment_date,students.department_id, students.batch_id, batches.batch_name AS batch_name
                                    FROM students 
                                    JOIN batches ON students.batch_id = batches.id";
        } else {
            $sql = "SELECT students.id, students.index_number, students.username, students.email, students.mobile_num, students.address, students.image_path, students.enrollment_date,students.department_id, students.batch_id, batches.batch_name AS batch_name
                                    FROM students 
                                    JOIN batches ON students.batch_id = batches.id WHERE username LIKE :query";
        }

        $stmt = $conn->prepare($sql);

        // Bind parameter for partial email search if applicable
        if ($query !== "init") {
            $stmt->bindValue(':query', "%$query%", PDO::PARAM_STR);
        }

        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Return JSON-encoded data
        echo json_encode($result);
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
