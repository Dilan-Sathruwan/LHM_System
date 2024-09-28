<?php include('../../includes/db_connection.php'); // Database Connection ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Lectures</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <style>
        .main-content {
            padding: 20px;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .action-buttons button {
            margin-right: 5px;
        }
        @media (max-width: 576px) {
            .action-buttons button {
                margin-bottom: 5px;
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <!-- <?php include('../sidebar.php'); ?> -->

    <div class="container-fluid main-content">
        <h1 class="mb-4">Manage Assigned Lectures</h1>

        <div class="mb-4">
            <h3>Add New Lecture</h3>
            <form id="addLectureForm">
                <div class="form-group">
                    <label for="lectureName">Lecture Name</label>
                    <input type="text" class="form-control" id="lectureName" name="lectureName" required>
                </div>
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" class="form-control" id="subject" name="subject" required>
                </div>
                <div class="form-group">
                    <label for="time">Time</label>
                    <input type="text" class="form-control" id="time" name="time" placeholder="e.g. 10:00 AM - 12:00 PM" required>
                </div>
                <button type="submit" class="btn btn-primary">Add Lecture</button>
            </form>
        </div>

        <table class="table table-bordered table-responsive">
            <thead>
                <tr>
                    <th>Lecture Name</th>
                    <th>Subject</th>
                    <th>Time</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Sample Data -->
                <tr>
                    <td>Lecture 1</td>
                    <td>Mathematics</td>
                    <td>10:00 AM - 12:00 PM</td>
                    <td class="action-buttons">
                        <button class="btn btn-warning" onclick="editLecture(1)">Edit</button>
                        <button class="btn btn-danger" onclick="deleteLecture(1)">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td>Lecture 2</td>
                    <td>Physics</td>
                    <td>1:00 PM - 3:00 PM</td>
                    <td class="action-buttons">
                        <button class="btn btn-warning" onclick="editLecture(2)">Edit</button>
                        <button class="btn btn-danger" onclick="deleteLecture(2)">Delete</button>
                    </td>
                </tr>
                <!-- Add more lecture entries as needed -->
            </tbody>
        </table>
    </div>

    <!-- Include footer -->
<?php include('../../includes/footer.php'); // Common header; ?> 

    <script>
        // JavaScript function to handle form submission
        document.getElementById('addLectureForm').onsubmit = function(e) {
            e.preventDefault();
            const lectureName = document.getElementById('lectureName').value;
            const subject = document.getElementById('subject').value;
            const time = document.getElementById('time').value;

            // Here you can add your AJAX request to submit the data to the server
            console.log('Lecture Added:', { lectureName, subject, time });

            // Clear the form
            this.reset();
        };

        function editLecture(id) {
            // Logic for editing the lecture
            console.log('Edit Lecture ID:', id);
        }

        function deleteLecture(id) {
            // Logic for deleting the lecture
            console.log('Delete Lecture ID:', id);
        }
    </script>
</body>
</html>
