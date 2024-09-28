<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
<?php
// include('includes/auth.php'); // Authentication check
include('../../includes/header.php'); // Common header 
?>
<div class="container mt-5">
    <h1 class="text-center">Administrator Dashboard</h1>
    <p class="text-center">Welcome to the Admin Dashboard. Use the navigation to manage system settings, users, lectures, and more.</p>

    <div class="row mt-4">
        <div class="col-lg-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Manage Users</h5>
                    <a href="manage_users.php" class="btn btn-primary">Go to Users</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Manage Departments</h5>
                    <a href="manage_departments.php" class="btn btn-primary">Go to Departments</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Manage Subjects</h5>
                    <a href="manage_subjects.php" class="btn btn-primary">Go to Subjects</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include footer -->
<?php include('../../includes/footer.php'); // Common header; ?> 
    
</body>
</html>
