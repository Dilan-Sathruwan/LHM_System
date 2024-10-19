<?php
// ############################ Function to register a lecturers #####################

function lecturersCreate($conn, $index_num, $username, $email, $password, $lecturerole, $address, $phonenum, $about, $imageUploadResult)
{
    try {
        // Prepare SQL statement to insert lecturer data, including the image path
        $sql = "INSERT INTO lecturers (`index_number`, `username`, `email`, `password`, `expertise`, `address`, `mobile_no`, `role`, `image_path`) 
                VALUES (:index_num, :username, :email, :password, :about, :address, :phone_num, :lecturerole, :image_path)";

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
            ':phone_num' => $phonenum,
            ':image_path' => $imageUploadResult  // Include the image path here
        ]);

        return "Lecturer registered successfully!";
    } catch (PDOException $e) {
        return "Error: " . $e->getMessage();
    }
}


 // Hash the password if it's being updated (if not empty)
        // $password_sql = '';
        // if (!empty($password)) {
        //     $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        //     $password_sql = ", password = :password";
        // }





// ############################# Function to update the lecturer's details ######################
function lecturersUpdate($conn, $id, $index_num, $username, $email, $password, $lecturerole, $address, $phonenum, $about)
{
    try {
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
function batchCreate($conn, $batch_name, $batch_year, $dept_id, $sem_id)
{
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

function batchUpdate($conn, $id, $batch_name, $batch_year, $dept_id, $sem_id)
{
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




// ############################# Function to Create Lecture time ######################
function lectureCreate($conn, $lname, $dept, $batches, $subjects, $lecture_halls, $days, $time_slot)
{
    try {
        // Prepare SQL statement to insert lecture schedule data
        $sql = "INSERT INTO lhm_system2.lecture_schedule (lecturer_id, hall_id, department_id, batch_id, subject_id, slot_id, days)
                VALUES (:lecturer_id, :hall_id, :department_id, :batch_id, :subject_id, :slot_id, :days)";

        $stmt = $conn->prepare($sql);

        // Execute the statement with the provided data
        $stmt->execute([
            ':lecturer_id' => $lname,
            ':hall_id' => $lecture_halls,
            ':department_id' => $dept,
            ':batch_id' => $batches,
            ':subject_id' => $subjects,
            ':slot_id' => $time_slot,
            ':days' => $days
        ]);

        return "Lecture scheduled successfully!";
        exit();
    } catch (PDOException $e) {
        return "Error: " . $e->getMessage();
    }
}




// ############################# Function Update to Lecture time ######################
function lectureUpdate($conn, $id, $lname, $dept, $batches, $subjects, $lecture_halls, $days, $time_slot)
{
    try {
        $sql = "UPDATE lhm_system2.lecture_schedule SET 
                lecturer_id = :lecturer_id,
                hall_id = :hall_id, 
                department_id = :department_id, 
                batch_id = :batch_id, 
                subject_id = :subject_id, 
                slot_id = :slot_id, 
                days = :days
                WHERE id = :id";

        $stmt = $conn->prepare($sql);

        $stmt->execute([
            ':lecturer_id' => $lname,
            ':hall_id' => $lecture_halls,
            ':department_id' => $dept,
            ':batch_id' => $batches,
            ':subject_id' => $subjects,
            ':slot_id' => $time_slot,
            ':days' => $days,
            ':id' => $id
        ]);

        return "Lecture updated successfully!";
        exit();
    } catch (PDOException $e) {
        return "Error: " . $e->getMessage();
    }
}



// ############################# Function Update to image ######################
function uploadOrUpdateImage($conn, $file, $id = null) {
    // Check if the file was uploaded
    if ($file['error'] === UPLOAD_ERR_NO_FILE) {
        return;
    }

    // Define allowed file types and size limit
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    $maxFileSize = 2 * 1024 * 1024; // 2MB

    // Validate file type
    if (!in_array($file['type'], $allowedTypes)) {
        return "Only JPG, PNG, and GIF files are allowed!";
    }

    // Validate file size
    if ($file['size'] > $maxFileSize) {
        return "File size exceeds the 2MB limit!";
    }

    // Define upload directory
    $uploadDir = "uploads/profile_images/";
    
    // Ensure directory exists, if not create it
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    // Generate a unique file name
    $fileName = uniqid() . '_' . time() . '_' . basename($file['name']);
    $targetFile = $uploadDir . $fileName;

    // Attempt to move the uploaded file to the directory
    if (move_uploaded_file($file['tmp_name'], $targetFile)) {
        // If this is a creation process (no ID), return the file path
        if (!$id) {
            return $targetFile;
        } else {
            // For updates, update the existing lecturer's image path
            try {
                $sql = "UPDATE lecturers SET image_path = :image_path WHERE id = :id";
                $stmt = $conn->prepare($sql);
                $stmt->execute([':image_path' => $targetFile, ':id' => $id]);
                return "Image updated successfully!";
            } catch (PDOException $e) {
                return "Database error: " . $e->getMessage();
            }
        }
    } else {
        return "There was an error uploading the file!";
    }
}





  // ############################# Function to Create the Subject ######################
function SubjectCreate($conn, $subject_nam, $subject_number, $credits, $dept, $semester){

    try {
        // Check if batch name or batch year already exists
        $sql_check = "SELECT * FROM subjects WHERE subject_name = :subject_name";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->bindParam(':subject_name', $subject_nam);

        $stmt_check->execute();
        $existingSubject = $stmt_check->fetch(PDO::FETCH_ASSOC);
        if ($existingSubject) {
            return "Error: Subject with this name already exists.";
        }

        // If no batch exists, proceed to insert the new batch
        $sql_insert = "INSERT INTO subjects (subject_name, subject_number, department_id, semester_id, credits) VALUES (:subject_name, :subject_number, :department_id, :semester_id, :credits)";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bindParam(':subject_name', $subject_nam);
        $stmt_insert->bindParam(':subject_number', $subject_number);
        $stmt_insert->bindParam(':department_id', $dept);
        $stmt_insert->bindParam(':credits', $credits);
        $stmt_insert->bindParam(':semester_id', $semester);

        if ($stmt_insert->execute()) {
            return "Subject successfully created!";
        } else {
            return "Error creating Subject.";
        }
    } catch (PDOException $e) {
        return "Error: " . $e->getMessage();
    }
}  




function SubjectUpdate($conn, $id, $subject_nam, $subject_number, $credits, $dept, $semester){
    try {
        // Check if batch name already exists
        $sql_check = "SELECT * FROM subjects WHERE subject_name = :subject_name AND id != :id";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->bindParam(':subject_name', $subject_nam);
        $stmt_check->bindParam(':id', $id);  // Exclude current batch from the check

        $stmt_check->execute();
        $existingBatch = $stmt_check->fetch(PDO::FETCH_ASSOC);
        if ($existingBatch) {
            return "Error: Subject with this name already exists.";
        }

        $sql_update = "UPDATE subjects 
                       SET subject_name = :subject_name,
                           subject_number = :subject_number,
                           credits = :credits,
                           department_id = :department_id, 
                           semester_id = :semester_id
                       WHERE id = :id";

        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bindParam(':subject_name', $subject_nam);
        $stmt_update->bindParam(':subject_number', $subject_number);
        $stmt_update->bindParam(':credits', $credits);
        $stmt_update->bindParam(':department_id', $dept);
        $stmt_update->bindParam(':semester_id', $semester);
        $stmt_update->bindParam(':id', $id);

        if ($stmt_update->execute()) {
            return "Subject successfully updated!";
        } else {
            return "Error updating batch.";
        }
    } catch (PDOException $e) {
        return "Error: " . $e->getMessage();
    }
}
?>
