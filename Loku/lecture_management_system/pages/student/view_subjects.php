<?php include('../../includes/db_connection.php'); // Database Connection ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Lecture Schedule</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #f8f9fa; /* Light background color */
        }
        .main-content {
            padding: 20px;
        }
        .table {
            margin-top: 20px;
        }
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .table thead {
                display: none;
            }
            .table tr {
                display: block;
                margin-bottom: 10px;
            }
            .table td {
                display: flex;
                justify-content: space-between;
                padding: 10px;
                text-align: right;
                position: relative;
                padding-left: 50%;
            }
            .table td:before {
                content: attr(data-label);
                position: absolute;
                left: 10px;
                text-align: left;
                font-weight: bold;
            }
        }
    </style>
</head>
<body>
    <!-- <?php include('../sidebar.php'); ?> -->

    <div class="container-fluid main-content">
        <h1 class="mb-4">Enrolled Subjects</h1>

        <!-- Options for the user -->
        <div class="mb-4">
            <a href="view_timetable.php" class="btn btn-info">View Timetable</a>
            <a href="update_subjects.php" class="btn btn-warning">Update Subjects</a>
            <a href="print_schedule.php" class="btn btn-success">Print Schedule</a>
        </div>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Subject Name</th>
                    <th>Credits</th>
                    <th>Semester</th>
                </tr>
            </thead>
            <tbody>
                <!-- Sample Data -->
                <tr>
                    <td data-label="Subject Name">Mathematics</td>
                    <td data-label="Credits">3</td>
                    <td data-label="Semester">First Semester</td>
                </tr>
                <tr>
                    <td data-label="Subject Name">Physics</td>
                    <td data-label="Credits">4</td>
                    <td data-label="Semester">First Semester</td>
                </tr>
                <tr>
                    <td data-label="Subject Name">Chemistry</td>
                    <td data-label="Credits">3</td>
                    <td data-label="Semester">First Semester</td>
                </tr>
                <!-- Additional data rows can be added here -->
            </tbody>
        </table>
    </div>

    <!-- Include footer -->
    <?php include('../../includes/footer.php'); // Common footer ?>
</body>
</html>
