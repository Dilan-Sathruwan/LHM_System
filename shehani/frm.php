<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="frm.css">
    <title>Add Subject</title>
    


</head>
<body>
    <h1>Add Subject</h1>
    <form action="process.php" method="post">
        <label for="subject_number">Subject Number:</label>
        <input type="text" id="subject_number" name="subject_number" required><br><br>

        <label for="subject_name">Subject Name:</label>
        <input type="text" id="subject_name" name="subject_name" required><br><br>

        <label for="credits">Credits:</label>
        <input
          type="number" 
          id="credits"
           name="credits" 
           min="1"
           max="10"
           required/>
           <br><br>

        <label for="department">Department:</label>
        <select id="department" name="department" required>
            <option value=""disabled selected>Select Department</option>
            <option value="Higher National Diploma In INformation Technology">Higher National Diploma In INformation Technology</option>
            <option value="Higher National Diploma In English">Higher National Diploma In English</option>
            <option value="Higher National Diploma In Acoountancy">Higher National Diploma In Acoountancy</option>
            <option value="Higher National Diploma In Projecct Management">Higher National Diploma In Projecct Management</option>
            <!-- Add more department as needed -->
        </select><br><br>

        <label for="semester">Semester:</label>
        <select id="semester" name="semester" required>
            <option value=""disabled selected>Select Semester</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            
        </select><br><br>

        <button type="submit" >Add Subject</button>
    </form>
</body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collecting form data
    $subject_number = $_POST['subject_number'];
    $subject_name = $_POST['subject_name'];
    $credits = $_POST['credits'];
    $department = $_POST['department'];
    $semester = $_POST['semester'];

    

    // For now, just display the collected data
    echo "<h1>Subject Added</h1>";
    echo "Subject Number: " . htmlspecialchars($subject_number) . "<br>";
    echo "Subject Name: " . htmlspecialchars($subject_name) . "<br>";
    echo "Credits: " . htmlspecialchars($credits) . "<br>";
    echo "Department: " . htmlspecialchars($department) . "<br>";
    echo "Semester: " . htmlspecialchars($semester) . "<br>";
}
?>

