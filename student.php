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


// Set the file path
$filePath = './admin/include/' . htmlspecialchars($Students['image_path']);

// Check if the file exists
if (file_exists($filePath)) {
    // If file exists, use the student's image
    $imagePath = $filePath;
} else {
    // If file does not exist, use a default image path
    $imagePath = './admin/include/uploads/pngwing.com.png';  // Update with your default image path
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
            <a class="navbar-brand" href="#">Studets Portal</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="./index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./student_timetable.php">View Timetable</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-logout" href="./include/logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-4 mb-4">
                <div class="usercard text-center shadow-effect">
                    <div class="ucard_pic mb-3">
                    <img src="<?php echo $imagePath; ?>" alt="Profile Image" class="img-fluid rounded-circle">
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
                                <p>Index Number: <?php echo htmlspecialchars($Students['index_number']); ?></p>
                                <p>Department: <?php echo htmlspecialchars($Students['department_id']); ?></p>
                                <p>Batch: <?php echo htmlspecialchars($Students['batch_id']); ?></p>
                            </div>
                            <div class="highlight mb-3">
                                <strong>Important:</strong> Make sure to check your timetable regularly!
                            </div>
                            <div class="button-group mb-3">
                                <a href="#" class="btn btn-custom btn-primary btn-block mb-2">Edit Profile</a>
                                <a href="./student_timetable.php" class="btn btn-custom btn-info btn-block mb-2">Your Timetable</a>
                                <a href="./include/logout.php" class="btn btn-custom btn-danger btn-block mb-2">Logout</a>
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

    <div class="sticky-theme-toggle">
    <button id="themeToggle" class="theme-toggle btn btn-primary light">🌚</button>
</div>

<style>
    .sticky-theme-toggle {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 1000;
    }

    .theme-toggle {
        padding: 0.5rem 1rem;
        border-radius: 13px;
        cursor: pointer;
        font-size: 1rem;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .theme-toggle.dark {
        background-color: #f8f9fa;
        color: #212529;
    }

    .theme-toggle.light {
        background-color: #212529;
        color: #f8f9fa;
    }
</style>

<script>
    const themeToggle = document.getElementById('themeToggle');
    const body = document.body;

    // Check and apply stored theme
    const storedTheme = localStorage.getItem('theme');
    if (storedTheme) {
        body.classList.toggle('dark-theme', storedTheme === 'dark');
        updateThemeToggleText(storedTheme === 'dark');
    }

    themeToggle.addEventListener('click', () => {
        body.classList.toggle('dark-theme');
        const theme = body.classList.contains('dark-theme') ? 'dark' : 'light';
        localStorage.setItem('theme', theme);
        updateThemeToggleText(theme === 'dark');
    });

    function updateThemeToggleText(isDark) {
        if (isDark) {
            themeToggle.innerText = '🌞';
            themeToggle.classList.remove('btn-primary');
            themeToggle.classList.add('btn-light', 'dark');
        } else {
            themeToggle.innerText = '🌚';
            themeToggle.classList.remove('btn-light', 'dark');
            themeToggle.classList.add('btn-primary', 'light');
        }
    }
</script>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
