<?php
session_start(); // Start the session

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    echo "Welcome, " . $_SESSION['user_name']; // Display the username
} else {
    echo "Please log in.";
}

?>
<?php
include "include/db_connection.inc.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Administrator</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">


    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="assets/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="assets/vendor/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/adminstyle.css">

</head>

<body class="back-colors">
    <div class="container-xxl position-relative d-flex p-0 back-colors">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Massage show -->
        <div id="messagePopup" class="alert alert-success message-popup">
            <i class="bi bi-check-square-fill">&nbsp;</i>
            <span id="messageText"></span>
        </div>
        <!--Massage End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3 back-colors">
            <nav class="navbar navbar-light bg-transparent">
                <a href="index.html" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><img src="./assets/img/Icon/FB.gif" alt=""></h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="./assets/img/Icon/Gest.gif" alt=""
                            style="width: 40px; height: 40px;">
                        <div
                            class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                        </div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">My Admin</h6>
                        <span><?php if (isset($_SESSION['user_id'])) {
                                    echo "Welcome, " . $_SESSION['user_name']; // Display the username
                                } ?></span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="index.php" class="nav-item nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'index.php') {
                                                                        echo 'active';
                                                                    } ?>">
                        <i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle <?php if (basename($_SERVER['PHP_SELF']) == 'lectures.php') {
                                                                        echo 'active';
                                                                    } elseif (basename($_SERVER['PHP_SELF']) == 'student.php') {
                                                                        echo 'active';
                                                                    }
                                                                    ?>" data-bs-toggle="dropdown"><i
                                class="fa fa-users me-2"></i>Users</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="lectures.php" class="dropdown-item <?php if (basename($_SERVER['PHP_SELF']) == 'lectures.php') {
                                                                            echo 'active';
                                                                        } ?>">Lectures</a>
                            <a href="student.php" class="dropdown-item <?php if (basename($_SERVER['PHP_SELF']) == 'student.php') {
                                                                            echo 'active';
                                                                        } ?>">Students</a>
                        </div>
                    </div>

                    <div class="nav-item dropdown">
                        <a href="" class="nav-link dropdown-toggle <?php if (basename($_SERVER['PHP_SELF']) == 'Department.php') {
                                                                        echo 'active';
                                                                    } elseif (basename($_SERVER['PHP_SELF']) == 'LectureHall.php') {
                                                                        echo 'active';
                                                                    } elseif (basename($_SERVER['PHP_SELF']) == 'Subject.php') {
                                                                        echo 'active';
                                                                    } elseif (basename($_SERVER['PHP_SELF']) == 'Batches.php') {
                                                                        echo 'active';
                                                                    }
                                                                    ?>" data-bs-toggle="dropdown"><i
                                class="fa fa-university me-2"></i>Campus Details</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="Department.php" class="dropdown-item <?php if (basename($_SERVER['PHP_SELF']) == 'Department.php') {
                                                                                echo 'active';
                                                                            } ?>">Department & Semester</a>
                            <a href="LectureHall.php" class="dropdown-item <?php if (basename($_SERVER['PHP_SELF']) == 'LectureHall.php') {
                                                                                echo 'active';
                                                                            } ?>">Lecture Hall</a>
                            <a href="Subject.php" class="dropdown-item <?php if (basename($_SERVER['PHP_SELF']) == 'Subject.php') {
                                                                            echo 'active';
                                                                        } ?>">Subjects</a>
                            <a href="Batches.php" class="dropdown-item <?php if (basename($_SERVER['PHP_SELF']) == 'Batches.php') {
                                                                            echo 'active';
                                                                        } ?>">Batches</a>
                        </div>
                    </div>

                    <a href="schedules.php" class="nav-item nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'schedules.php') {
                                                                            echo 'active';
                                                                        } ?>"><i
                            class="fa fa-table me-2"></i>Schedules</a>
                    <a href="Events.php" class="nav-item nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'Events.php') {
                                                                        echo 'active';
                                                                    } ?>"><i
                            class="fa fa-chart-bar me-2"></i>Events</a>


                    <div class="nav-item dropdown">
                        <a href="" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                                class="far fa-file-alt me-2"></i>Pages</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="signin.html" class="dropdown-item">Sign In</a>
                            <a href="signup.html" class="dropdown-item">Sign Up</a>
                            <a href="404.html" class="dropdown-item">404 Error</a>
                            <a href="blank.html" class="dropdown-item">Blank Page</a>
                        </div>
                    </div>

                </div>
            </nav>
        </div>
        <!-- Sidebar End -->