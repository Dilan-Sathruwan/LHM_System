<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="frm.css">
    <title>Add Subject Details</title>
    


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
            <option value="1">Higher National Diploma In INformation Technology</option>
            <option value="2">Higher National Diploma In English</option>
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

        <button type="submit">Add Subject</button>
    </form>
</body>
</html>


