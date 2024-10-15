<?php
session_start();
include '../../include/database.inc.php'; // Ensure this path is correct

// Check if user is logged in and is a lecturer
if (!isset($_SESSION['user_id'])) {
    header("Location:../../signin.php"); // Redirect to login if not logged in
    exit();
}

// Get the logged-in lecturer's information
$lecturer_id = $_SESSION['user_id'];
$query = "SELECT * FROM Lecturers WHERE id = :id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $lecturer_id, PDO::PARAM_INT);
$stmt->execute();

// Check if lecturer exists
if ($stmt->rowCount() > 0) {
    $lecturer = $stmt->fetch(PDO::FETCH_ASSOC);
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
    <title>Lecturer Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/button.css" rel="stylesheet">
    
    <style>
        body {
            transition: background-color 0.3s, color 0.3s;
            font-family: Arial, sans-serif;
        }
        body.light-theme {
            background-color: #f8f9fa;
            color: #212529;
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
        }
        .usercard:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }
        .ucard_pic img {
            width: 100%; /* Responsive image */
            max-width: 250px;
            border-radius: 50%;
        }
        .card {
            transition: box-shadow 0.3s;
            border: 1px solid #ddd;
            background-color: #495057; /* Darker background for card */
            /* border: none; Remove default border for a cleaner look */
        }
        .text-light {
            color: #f8f9fa; /* Light text color for readability in dark mode */
        }
        .theme-toggle {
            transition: background-color 0.3s, color 0.3s;
        }
        .btn-primary, .btn-warning, .btn-danger {
            transition: background-color 0.3s, border-color 0.3s; /* Add transitions for smooth effect */
        }
        .btn-primary:hover, .btn-warning:hover, .btn-danger:hover {
            filter: brightness(1.1); /* Slightly brighten buttons on hover for better feedback */
        }
        .download-btn {
            background-color: #dc3545; /* Bootstrap danger color */
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
        }
        .download-btn:hover {
            background-color: #c82333; /* Darken on hover */
        }

        .card.bg-transparent {
    background-color: rgba(255, 255, 255, 0.15); /* Transparent white background for light theme */
    border-radius: 15px;
    transition: background-color 0.3s ease;
}

body.dark-theme .card.bg-transparent {
    background-color: rgba(0, 0, 0, 0.4); /* Transparent dark background for dark theme */
}

.btn-custom {
    margin: 0.5rem 0;
    padding: 0.75rem 1.5rem;
    font-size: 1rem;
    transition: transform 0.3s ease, background-color 0.3s ease;
}

.download-btn {
    margin-top: 1rem;
    padding: 0.5rem 1.2rem;
    border-radius: 8px;
    transition: background-color 0.3s ease;
}

.btn-primary:hover, .btn-warning:hover, .btn-danger:hover, .download-btn:hover {
    transform: scale(1.05); /* Slight scale on hover for better interaction */
    filter: brightness(1.2);
}

.card-header.bg-transparent {
    padding: 2rem;
    background: none; /* Ensure header is transparent */
}

.text-center p {
    color: inherit; /* Make sure text color adapts to theme */
}

        @media (max-width: 576px) {
            .usercard {
                padding: 15px; /* Adjust padding for smaller screens */
            }
            .ucard_pic img {
                max-width: 150px; /* Adjust image size for smaller screens */
            }
        }
    </style>
</head>
<body>

<?php
$page_title = "Lecturer Dashboard";
include '../includes/lecturer_header.php';
?>
<!-- <div class="text-center mb-4 mt-5">
    <button id="themeToggle" class="btn btn-primary theme-toggle">Switch to Dark Theme</button>
</div> -->


    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-4 mb-4">
                <div class="usercard">
                    <div class="ucard_pic mb-3">
                        <img src="https://dilan-sathruwan.github.io/Project_Grapher_Website/About%20Us/Photos/Loku.jpg" alt="Profile Image" class="img-fluid rounded-circle" />
                    </div>
                    <h2>Hello, <?php echo htmlspecialchars($lecturer['username']); ?></h2>
                </div>
            </div>

            <div class="col-md-8 mb-4">
                <div class="card bg-transparent"> <!-- Transparent card with no border -->
                    <div class="card-header text-center bg-transparent"> <!-- Transparent card header -->
                        <h2 class="text-center">Welcome, <?php echo htmlspecialchars($lecturer['username']); ?></h2>
                        <h4>This is Your Lecturer Dashboard</h4>
                        <p class="card-text">(Manage your lectures and view your schedule from here.)</p>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <br>
                            <div class="f">
                                <a href="view_schedule.php" class="but2">View Your Schedule</a>
                                <a href="manage_lectures.php" class="but2">Manage Lectures</a>
                                <a href="time_table.php" class="but2">View Timetable</a>
                                <a href="view_all_lectures.php" class="but2">View All Lectures</a>
                                <a href="../auth/logout.php" class="but2">Logout</a>
                            </div>
                            <br><br>
                            <hr>
                                <p>Download your Timetable</p>
                            <div class="f">
                                <div class="coco">
                                    <a href="download_timetable.php" class="but1">Download Now</a> <!-- Download link styled as button -->
                                </div>
                            </div>
                            <br><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    include '../includes/footer.php';
    ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script>
        // Toggle between light and dark themes
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
                themeToggle.innerText = 'Switch to Light Theme';
                themeToggle.classList.remove('btn-primary');
                themeToggle.classList.add('btn-light');
            } else {
                themeToggle.innerText = 'Switch to Dark Theme';
                themeToggle.classList.remove('btn-light');
                themeToggle.classList.add('btn-primary');
            }
        }
    </script>
</body>
</html>
<!-- This Page Create by Loku -->