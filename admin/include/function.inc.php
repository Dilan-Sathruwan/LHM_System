<?php
// Function to register a lecturers
function  lecturersCreate($conn, $index_num, $username, $email, $password, $lecturerole, $address, $phonenum,  $about)
{

    try {
        // Prepare SQL statement to insert student data

        $sql = "INSERT INTO lecturers (`index_number`, `username`, `email`, `password`, `expertise`, `address`, `mobile_no`, `role`) VALUES (:index_num, :username, :email, :password, :about, :address, :phone_num, :lecturerole)";

        $stmt = $conn->prepare($sql);

        // Execute the statement with the provided data
        $stmt->execute([

            ':index_num' => $index_num,
            ':username' => $username,
            ':email' => $email,
            ':password' => $password,
            ':lecturerole' => $lecturerole,
            ':address' => $address,
            ':about' => $about,
            ':phone_num' => $phonenum
            // ':target_file'=>$target_file

        ]);

        // Return success message
        // header("Location:../lectures.php?lecturers_register_sucssfully");
        return "lecturers registered successfully!";
        exit();
        
    } catch (PDOException $e) {
        return "Error: " . $e->getMessage();
    }
}