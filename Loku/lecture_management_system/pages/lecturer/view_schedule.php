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
            background-color: #f8f9fa;
        }
        .main-content {
            padding: 20px;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        @media (max-width: 576px) {
            .table {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <!-- <?php include('../sidebar.php'); ?> -->

    <div class="container-fluid main-content">
        <h1 class="mb-4">View Lecture Schedule</h1>
        <table class="table table-bordered table-striped table-responsive">
            <thead class="thead-dark">
                <tr>
                    <th>Date</th>
                    <th>Lecture</th>
                    <th>Time</th>
                    <th>Hall</th>
                </tr>
            </thead>
            <tbody>
                <!-- Sample Data -->
                <tr>
                    <td>2024-09-30</td>
                    <td>Lecture 1</td>
                    <td>10:00 AM - 12:00 PM</td>
                    <td>Hall A</td>
                </tr>
                <tr>
                    <td>2024-09-30</td>
                    <td>Lecture 2</td>
                    <td>1:00 PM - 3:00 PM</td>
                    <td>Hall B</td>
                </tr>
                <tr>
                    <td>2024-09-30</td>
                    <td>Lecture 3</td>
                    <td>3:30 PM - 5:30 PM</td>
                    <td>Hall C</td>
                </tr>
                <!-- Add more lecture entries as needed -->
            </tbody>
        </table>
    </div>
    <!-- Include footer -->
<?php include('../../includes/footer.php'); // Common header; ?> 
</body>
</html>
