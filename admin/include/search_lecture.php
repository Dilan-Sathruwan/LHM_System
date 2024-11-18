<?php
require_once 'db_connection.inc.php';

try {
    
    if (isset($_GET["query"])) {
        $query = $_GET["query"];

        // SQL query to fetch all data if "init" or search by email otherwise
        if ($query === "init") {
            $sql = "SELECT id, index_number, username, email, password, expertise, address, mobile_no, role, image_path, created_at FROM lecturers";
        } else {
            $sql = "SELECT id, index_number, username, email, password, expertise, address, mobile_no, role, image_path, created_at FROM lecturers WHERE email LIKE :query";
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
