<?php
// session_start();
include '../includes/header.php';  // Common header
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Welcome, Admin!</h1>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Manage Lecturers</h5>
                        <p class="card-text">View and manage lecturers in the system.</p>
                        <a href="manage_lecturers.php" class="btn btn-primary">Manage Lecturers</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Manage Departments</h5>
                        <p class="card-text">Add, edit, and delete departments.</p>
                        <a href="manage_departments.php" class="btn btn-primary">Manage Departments</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Manage Subjects</h5>
                        <p class="card-text">Add, edit, and delete subjects for each department.</p>
                        <a href="manage_subjects.php" class="btn btn-primary">Manage Subjects</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Manage Halls</h5>
                        <p class="card-text">View and manage lecture halls.</p>
                        <a href="manage_halls.php" class="btn btn-primary">Manage Halls</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Schedule Lectures</h5>
                        <p class="card-text">Schedule lectures for lecturers in different halls.</p>
                        <a href="schedule_lectures.php" class="btn btn-primary">Schedule Lectures</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php include '../includes/footer.php'; // Common footer ?>
