<?php
session_start();
include 'admin/include/db_connection.inc.php';

// Check if user is logged in and is a lecturer
if (!isset($_SESSION['St_id'])) {
    header("Location: signin.php"); // Redirect to login if not logged in
    exit();
}

// Get the logged-in lecturer's information
$Student_id = $_SESSION['St_id'];
$query = "SELECT * FROM students WHERE id = :id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $Student_id, PDO::PARAM_INT);
$stmt->execute();


// Check if lecturer exists
if ($stmt->rowCount() > 0) {
    $Students = $stmt->fetch(PDO::FETCH_ASSOC);

} else {
    echo "Lecturer not found.";
    exit();
}

// Close the statement (optional with PDO, but you can unset it)
$stmt = null;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link href="./assets/vendor/bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            transition: background-color 0.3s, color 0.3s;
            font-family: Arial, sans-serif;
            background-color: #f8f9fa; /* Default light background */
        }
        body.dark-theme {
            background-color: #343a40;
            color: #f8f9fa;
        }
        .usercard {
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            transition: box-shadow 0.3s;
            background-color: #ffffff;
        }
        .usercard:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }
        .ucard_pic img {
            width: 100%;
            max-width: 200px;
            border-radius: 50%;
            border: 3px solid #007bff; /* Blue border for profile picture */
        }
        .card {
            transition: box-shadow 0.3s;
            border: none;
            border-radius: 8px;
        }
        .card-header {
            background-color: #007bff;
            color: white;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }
        .text-dark {
            color: #212529;
        }
        .btn-custom {
            transition: transform 0.3s ease, background-color 0.3s ease;
        }
        .btn-custom:hover {
            transform: scale(1.05);
            filter: brightness(1.1);
        }
        .download-btn {
            background-color: #dc3545;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }
        .download-btn:hover {
            background-color: #c82333;
        }
        .profile-info p {
            margin: 0.5rem 0; /* Improved spacing between paragraphs */
        }
        @media (max-width: 768px) {
            .usercard {
                padding: 15px;
            }
            .ucard_pic img {
                max-width: 150px;
            }
            .card-header {
                font-size: 1.25rem; /* Smaller font size for mobile */
            }
        }
        @media (max-width: 576px) {
            .button-group .btn {
                font-size: 0.9rem; /* Smaller buttons on mobile */
            }
            .download-btn {
                width: 100%; /* Full width for download button */
            }
        }
        /* Additional styles for visual appeal */
        .shadow-effect {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .highlight {
            background-color: #e9ecef; /* Light gray for highlighting */
            border-left: 4px solid #007bff; /* Blue left border */
            padding: 10px;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-4 mb-4">
                <div class="usercard text-center shadow-effect">
                    <div class="ucard_pic mb-3">
                        <img src="./DP.png" alt="Profile Image" class="img-fluid rounded-circle">
                    </div>
                    <h2 class="mt-3 text-dark">Hello, <?php echo htmlspecialchars($Students['username']); ?></h2>
                </div>
            </div>

            <div class="col-md-8 mb-4">
                <div class="card shadow-effect">
                    <div class="card-header text-center">
                        <h4 class="mb-0">Profile Status</h4>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <div class="profile-info mb-4">
                                <p>Name: <?php echo htmlspecialchars($Students['username']); ?></p>
                                <p>Email: <?php echo htmlspecialchars($Students['email']); ?></p>
                                <p>Email: <?php echo htmlspecialchars($Students['index_number']); ?></p>
                                <p>Department: <?php echo htmlspecialchars($Students['username']); ?></p>
                                <p>Batch: <?php echo htmlspecialchars($Students['username']); ?></p>
                            </div>
                            <div class="highlight mb-3">
                                <strong>Important:</strong> Make sure to check your timetable regularly!
                            </div>
                            <div class="button-group mb-3">
                                <a href="#" class="btn btn-custom btn-primary btn-block mb-2">Edit Profile</a>
                                <a href="#" class="btn btn-custom btn-info btn-block mb-2">View Semester Timetable</a>
                                <a href="#" class="btn btn-custom btn-info btn-block mb-2">Timetable</a>
                                <a href="#" class="btn btn-custom btn-danger btn-block mb-2">Logout</a>
                            </div>
                            <hr />
                            <div class="download-section mb-4">
                                <p>Download your Timetable</p>
                                <a href="#" class="download-btn">Download Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>