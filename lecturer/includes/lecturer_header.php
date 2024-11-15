<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            transition: background-color 0.3s, color 0.3s;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body.light-theme {
            background-color: #f8f9fa;
            color: #212529;
        }
        body.dark-theme {
            background-color: #343a40;
            color: #f8f9fa;
        }   

        .navbar {
            padding: 1rem;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
        }

        .navbar-dark {
            background-color: #212529;
        }
     
        .navbar-brand {
            color: #ffffff !important;
            font-size: 1.5rem;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .navbar-brand:hover {
            color: #00bfff !important;
        }

        .nav-link {
            color: #ffffff !important;
            margin-left: 1rem;
            transition: color 0.3s ease, transform 0.3s;
        }

        .nav-link:hover {
            color: #00bfff !important;
            transform: translateY(-3px);
        }

        .btn-logout {
            padding: 0.5rem 1.5rem;
            font-size: 0.9rem;
            background-color: #dc3545;
            border: none;
            border-radius: 13px;
            transition: background-color 0.4s ease, transform 0.3s ease;
        }
        .text-light {
            color: #f8f9fa; /* Light text color for readability in dark mode */
        }

        .btn-logout:hover {
            background-color: #c82333;
            transform: scale(1.05);
        }

        /* Remove the white dot next to the logout button */
        .nav-item:last-child {
            margin-right: 0;
        }
    </style>
</head>
<body class="light-theme">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="dashboard.php">Lecturer Portal</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../../index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view_schedule.php">View Schedule</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="manage_lectures.php">Manage Lectures</a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" href="time_table.php">View Timetable</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view_all_lectures.php">View All Lectures</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-logout" href="../auth/logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Include the theme toggle -->
    <?php include 'theme_toggle.php'; ?>
    

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
<!-- This Page Create by Loku -->