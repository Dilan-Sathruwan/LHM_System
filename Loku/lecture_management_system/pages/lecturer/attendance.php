<?php include('../../includes/db_connection.php'); // Database Connection ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mark Attendance</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa; /* Light background color */
            margin: 0;
            padding: 20px;
        }
        .main-content {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 600px;
            margin: 0 auto;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #007bff; /* Bootstrap primary color */
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1; /* Hover effect */
        }
        button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007bff; /* Bootstrap primary color */
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3; /* Darker shade on hover */
        }
    </style>
    <script>
        function submitAttendance() {
            // Get all attendance checkboxes
            const checkboxes = document.querySelectorAll('input[name="attendance[]"]');
            const attendanceData = [];

            checkboxes.forEach((checkbox, index) => {
                attendanceData.push({
                    studentId: checkbox.value,
                    present: checkbox.checked
                });
            });

            // Make an AJAX call to submit attendance data (you can adjust the URL as needed)
            fetch('submit_attendance.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(attendanceData),
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message); // Show success message
            })
            .catch((error) => {
                console.error('Error:', error);
            });
        }
    </script>
</head>
<body>
    <div class="main-content">
        <h1>Mark Attendance</h1>
        <table>
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Present</th>
                </tr>
            </thead>
            <tbody>
                <!-- Sample Data - Replace with PHP to fetch student names and IDs from the database -->
                <tr>
                    <td>John Doe</td>
                    <td><input type="checkbox" name="attendance[]" value="1"></td> <!-- Sample Student ID -->
                </tr>
                <tr>
                    <td>Jane Smith</td>
                    <td><input type="checkbox" name="attendance[]" value="2"></td> <!-- Sample Student ID -->
                </tr>
                <!-- Add more student rows as necessary -->
            </tbody>
        </table>
        <button onclick="submitAttendance()">Submit Attendance</button>
    </div>

    <!-- Include footer -->
<?php include('../../includes/footer.php'); // Common header; ?> 


</body>
</html>
