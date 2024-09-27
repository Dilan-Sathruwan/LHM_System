<?php
// Function to register a student
function registerStudent($conn, $username, $email, $password) {

    try {
        // Prepare SQL statement to insert student data
        // $sql = "INSERT INTO students (index_number, name, email, password, department_id) 
        //         VALUES (:index_number, :name, :email, :password, :department_id)";

        $sql = "INSERT INTO lecturers (`username`, `email`, `password`) VALUES (:username, :email, :password)";
        
        $stmt = $conn->prepare($sql);
        
        // Execute the statement with the provided data
        $stmt->execute([
            ':username' => $username,
            ':email' => $email,
            ':password' => $password,
        ]);

        // Return success message
        return "lecturers registered successfully!";
        
    } catch (PDOException $e) {
        // Return error message in case of failure
        return "Error: " . $e->getMessage();
    }
}
?>