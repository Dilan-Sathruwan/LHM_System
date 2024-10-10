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

function studentCreate($conn, $index_num, $student_name, $email, $mobile_num, $address, $courses, $batch_id)
{
    try {
        $sql = "INSERT INTO students (`index_number`, `username`, `email`, `mobile_num`, `address`, `batch_id`, `department_id`) VALUES (:index_num, :username, :email, :mobile_num, :address, :batch_id, :department_id)";

        $stmt = $conn->prepare($sql);
        $stmt->execute([

            ':index_num' => $index_num,
            ':username' => $student_name,
            ':email' => $email,
            ':mobile_num' => $mobile_num,
            ':address' => $address,
            ':batch_id' => $batch_id,
            ':department_id' => $courses
        ]);

        return "student registered successfully!";
        exit();
    } catch (PDOException $e) {
        return "Error: " . $e->getMessage();
    }
}


// ############################# Function to Add the student's details ######################
function studentUpdate($conn, $id, $index_num, $student_name, $email, $mobile_num, $address, $courses, $batch_id)
{
    try {
        $sql = "UPDATE students SET 
                    `index_number` = :index_num, 
                    `username` = :username, 
                    `email` = :email, 
                    `mobile_num` = :mobile_num, 
                    `address` = :address, 
                    `batch_id` = :batch_id, 
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
            ':batch_id' => $batch_id,
            ':department_id' => $courses
        ]);

        return "student updated successfully!";
        exit();
    } catch (PDOException $e) {
        return "Error: " . $e->getMessage();
    }
}





// ############################# Function to Create the Batch ######################
function batchCreate($conn, $batch_name, $batch_year, $dept_id, $sem_id) {
    try {
        // Check if batch name or batch year already exists
        $sql_check = "SELECT * FROM batches WHERE batch_name = :batch_name";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->bindParam(':batch_name', $batch_name);

        $stmt_check->execute();
        $existingBatch = $stmt_check->fetch(PDO::FETCH_ASSOC);
        if ($existingBatch) {
            return "Error: Batch with this name already exists.";
        }

        // If no batch exists, proceed to insert the new batch
        $sql_insert = "INSERT INTO batches (batch_name, batch_year, department_id, semester_id) VALUES (:batch_name, :batch_year, :department_id, :semester_id)";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bindParam(':batch_name', $batch_name);
        $stmt_insert->bindParam(':batch_year', $batch_year);
        $stmt_insert->bindParam(':department_id', $dept_id);
        $stmt_insert->bindParam(':semester_id', $sem_id);
        
        if ($stmt_insert->execute()) {
            return "Batch successfully created!";
        } else {
            return "Error creating batch.";
        }
        
    } catch (PDOException $e) {
        return "Error: " . $e->getMessage();
    }
}




// ############################# Function to Update the Batch ######################

function batchUpdate($conn, $id,$batch_name, $batch_year, $dept_id, $sem_id){
    try {
        // Check if batch name already exists
        $sql_check = "SELECT * FROM batches WHERE batch_name = :batch_name AND id != :id";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->bindParam(':batch_name', $batch_name);
        $stmt_check->bindParam(':id', $id);  // Exclude current batch from the check
    
        $stmt_check->execute();
        $existingBatch = $stmt_check->fetch(PDO::FETCH_ASSOC);
        if ($existingBatch) {
            return "Error: Batch with this name already exists.";
        }
    
        $sql_update = "UPDATE batches 
                       SET batch_name = :batch_name, 
                           batch_year = :batch_year, 
                           department_id = :department_id, 
                           semester_id = :semester_id 
                       WHERE id = :id";  
        
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bindParam(':batch_name', $batch_name);
        $stmt_update->bindParam(':batch_year', $batch_year);
        $stmt_update->bindParam(':department_id', $dept_id);
        $stmt_update->bindParam(':semester_id', $sem_id);
        $stmt_update->bindParam(':id', $id);  
    
        if ($stmt_update->execute()) {
            return "Batch successfully updated!";
        } else {
            return "Error updating batch.";
        }
    } catch (PDOException $e) {
        return "Error: " . $e->getMessage();
    }
    
}