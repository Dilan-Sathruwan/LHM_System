<?php include('../../includes/db_connection.php'); // Database Connection ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
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

        .usercard {
            border: 2px solid white;
            border-radius: 18px;
            padding: 2rem;
            text-align: center;
            background: linear-gradient(0deg, rgba(249, 131, 0, 1) 0%, rgba(255, 224, 0, 1) 100%);
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
        }

        .ucard_pic img {
            width: 150px;
            height: 150px;
            margin: auto;
            border-radius: 50%;
            border: 2px solid yellow;
        }

        .card {
            margin: 20px 0;
        }

        .welcome-message {
            font-size: 1.5rem;
        }

        .tbl {
            padding: 1rem;
            background: linear-gradient(0deg, rgba(249, 131, 0, 1) 0%, rgba(255, 224, 0, 1) 100%);
            border-radius: 18px;
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
        }

        table,
        th,
        td {
            border: 1px solid #000;
        }

        th,
        td {
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #d6501b;
            color: rgb(255, 255, 255);
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>

<body>
    <!-- <?php include('../sidebar.php'); ?> -->
    <?php
// include('includes/auth.php'); // Authentication check
include('../../includes/header.php'); // Common header 
?>

    <div class="container-fluid main-content">
        <h1 class="mb-4">Student Dashboard</h1>

        <!-- User Card Section -->
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="usercard">
                    <div class="ucard_pic">
                        <img src="https://dilan-sathruwan.github.io/Project_Grapher_Website/About%20Us/Photos/Loku.jpg" alt="Profile Image" />
                    </div>
                    <hr />
                    <h2 class="welcome-message">Welcome, [Student Name]</h2>
                </div>
            </div>

            <!-- About Section -->
            <div class="col-md-8 mb-4">
                <div class="card">
                    <div class="card-body">
                        <p>Here you can access your enrolled subjects, timetable, and attendance records.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Timetable Section -->
        <div class="row">
            <div class="col-12">
                <div class="tbl">
                    <h5>This is Your Timetable for Today.</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Time</th>
                                <th>Lecture</th>
                                <th>Lecture Hall</th>
                                <th>Lecturers</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>8:30 AM - 9:30 AM</td>
                                <td>OOP</td>
                                <td>B2</td>
                                <td>Ravindu</td>
                            </tr>
                            <tr>
                                <td>9:30 AM - 10:30 AM</td>
                                <td>OOP</td>
                                <td>B2</td>
                                <td>Ravindu</td>
                            </tr>
                            <tr>
                                <td>10:30 AM - 11:30 AM</td>
                                <td>Web</td>
                                <td>B3 (Lab)</td>
                                <td>Shehani</td>
                            </tr>
                            <tr>
                                <td>11:30 AM - 12:30 PM</td>
                                <td>Web</td>
                                <td>B3 (Lab)</td>
                                <td>Shehani</td>
                            </tr>
                            <tr>
                                <td>12:30 PM - 1:00 PM</td>
                                <td colspan="3">Interval</td>
                            </tr>
                            <tr>
                                <td>1:00 PM - 2:00 PM</td>
                                <td>Web</td>
                                <td>B2</td>
                                <td>Shehani</td>
                            </tr>
                            <tr>
                                <td>2:00 PM - 3:00 PM</td>
                                <td>OS</td>
                                <td>B2</td>
                                <td>Tharuka</td>
                            </tr>
                            <tr>
                                <td>3:00 PM - 4:00 PM</td>
                                <td>OS</td>
                                <td>B2</td>
                                <td>Tharuka</td>
                            </tr>
                            <tr>
                                <td>4:00 PM - 5:00 PM</td>
                                <td colspan="3"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
        <!-- Include footer -->
<?php include('../../includes/footer.php'); // Common header; ?> 
</body>

</html>
