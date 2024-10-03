<?php
// ############################ Function to register a lecturers #####################

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





// ############################# Function to update the lecturer's details ######################

function lecturersUpdate($conn, $id, $index_num, $username, $email, $password, $lecturerole, $address, $phonenum, $about)
{
    try {
        // Hash the password if it's being updated (if not empty)
        // $password_sql = '';
        // if (!empty($password)) {
        //     $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        //     $password_sql = ", password = :password";
        // }

        // Prepare SQL statement to update lecturer data
        $sql = "UPDATE lecturers SET 
                    `index_number` = :index_num, 
                    `username` = :username, 
                    `email` = :email, 
                    `role` = :role, 
                    `address` = :address, 
                    `mobile_no` = :phonenum, 
                    `expertise` = :expertise, 
                    `password` = :password 
                WHERE id = :id";

        $stmt = $conn->prepare($sql);

        // Execute the statement with the provided data
        $stmt->execute([
            ':index_num' => $index_num,
            ':username' => $username,
            ':email' => $email,
            ':password' => $password,
            ':role' => $lecturerole,
            ':address' => $address,
            ':phonenum' => $phonenum,
            ':expertise' => $about, // Make sure the parameter name matches
            ':id' => $id
        ]);

        // Return success message
        return "Lecturer updated successfully!";
    } catch (PDOException $e) {
        return "Error: " . $e->getMessage();
    }
}





// ############################# Function to Add the student's details ######################

function studentCreate($conn, $index_num, $student_name, $email, $mobile_num, $address, $courses, $sem_year)
{
    try {
        $sql = "INSERT INTO students (`index_number`, `username`, `email`, `mobile_num`, `address`, `sem_year`, `department_id`) VALUES (:index_num, :username, :email, :mobile_num, :address, :sem_year, :department_id)";

        $stmt = $conn->prepare($sql);
        $stmt->execute([

            ':index_num' => $index_num,
            ':username' => $student_name,
            ':email' => $email,
            ':mobile_num' => $mobile_num,
            ':address' => $address,
            ':sem_year' => $sem_year,
            ':department_id' => $courses
        ]);

        return "student registered successfully!";
        exit();
    } catch (PDOException $e) {
        return "Error: " . $e->getMessage();
    }
}


// ############################# Function to Add the student's details ######################
function studentUpdate($conn, $id, $index_num, $student_name, $email, $mobile_num, $address, $courses, $sem_year)
{
    try {
        $sql = "UPDATE students SET 
                    `index_number` = :index_num, 
                    `username` = :username, 
                    `email` = :email, 
                    `mobile_num` = :mobile_num, 
                    `address` = :address, 
                    `sem_year` = :sem_year, 
                    `department_id` = :department_id
                WHERE id = :id";

        $stmt = $conn->prepare($sql);
        $stmt->execute([

            ':id' => $id,
            ':index_num' => $index_num,
            ':username' => $student_name,
            ':email' => $email,
            ':mobile_num' => $mobile_num,
            ':address' => $address,
            ':sem_year' => $sem_year,
            ':department_id' => $courses
        ]);

        return "student registered successfully!";
        exit();
    } catch (PDOException $e) {
        return "Error: " . $e->getMessage();
    }
}
