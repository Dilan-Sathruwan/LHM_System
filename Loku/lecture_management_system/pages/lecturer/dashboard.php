<?php
// session_start(); // Start the session
include('../../includes/db_connection.php'); // Database Connection

// // Check if user is logged in
// if (!isset($_SESSION['user_id'])) {
//     header('Location: login.php'); // Redirect to login if not logged in
//     exit;
// }

// Fetch user data
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    echo "Lecturer not found.";
    exit;
}

// Fetch upcoming lectures
$lectures_query = "SELECT * FROM lectures WHERE lecturer_id = ? ORDER BY date ASC";
$lectures_stmt = $conn->prepare($lectures_query);
$lectures_stmt->bind_param("i", $user_id);
$lectures_stmt->execute();
$lectures_result = $lectures_stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Responsive Web Page</title>
  <!-- Bootstrap CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
      min-height: 100vh;
    }

    .usercard {
      border: 2px solid white;
      border-radius: 18px;
      padding: 2rem;
      text-align: center;
      background: rgb(87, 0, 204);
      background: linear-gradient(0deg, rgba(87, 0, 204, 1) 0%, rgba(94, 231, 255, 1) 100%);
      box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
    }

    .ucard_pic img {
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      width: 150px;
      height: 150px;
      margin: auto;
      border-radius: 50%;
      border: 2px solid yellow;
    }

    .ag,
    .tbl {
      padding: 1rem;
      background: rgb(87, 0, 204);
      background: linear-gradient(0deg, rgba(87, 0, 204, 1) 0%, rgba(94, 231, 255, 1) 100%);
      border-radius: 18px;
      box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
    }

    .agp {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }

    .ag {
      position: static;
      align-items: center;
      justify-content: center;
      text-align: center;
      margin: auto;
    }

    .tbl p {
      text-align: center;
      font-size: 1.5rem;
      font-weight: bolder;
    }

    .tbl table {
      width: 100%;
      border-collapse: collapse;
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
      background-color: #300cfd;
      color: rgb(0, 0, 0);
    }

    tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    td[colspan="3"] {
      background-color: #ff5e00;
      color: #f9f9f9;
      font-weight: bold;
    }

    /* Dark Theme */
    .dark-theme {
      background-color: #1e1e1e;
      color: white;
    }

    .dark-theme .usercard {
      background: linear-gradient(0deg, rgba(0, 0, 0, 1) 0%, rgba(0, 0, 0, 1) 100%);
    }

    .dark-theme th {
      background-color: #0051ff;
      color: #fff;
    }

    .dark-theme td {
      color: #fff;
    }

    .dark-theme tr:nth-child(even) {
      background-color: #333;
    }

    .dark-theme td[colspan="3"] {
      background-color: #a200ff;
      color: #fff;
    }

    .light-theme th {
      background-color: #a200ff;
      color: rgb(255, 255, 255);
    }

    .light-theme td {
      color: black;
    }

    .light-theme tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    .light-theme td[colspan="3"] {
      background-color: #0051ff;
      color: white;
    }

    /* Buttons Section */
    .btn-group {
      display: flex;
      justify-content: center;
      gap: 5rem;
      margin: 2rem;
    }

    .Mbtn {
      all: unset;
      width: 8rem;
      display: inline-block;
      padding: 0.75rem 1.5rem;
      background-color: rgb(250, 171, 0);
      color: #212121;
      font-size: 1.2rem;
      font-weight: bold;
      text-align: center;
      cursor: pointer;
      border: 2px solid rgb(250, 92, 0);
      border-radius: 0.5rem;
      transition: background-color 0.3s ease;
    }

    .Mbtn:hover {
      background-color: transparent;
      color: rgb(250, 150, 0);
    }

    /* Mobile View Adjustments */
    @media (max-width: 768px) {
      .btn-group {
        flex-direction: column;
        gap: 1.5rem;
        margin: 1rem;
        justify-content: center;
        align-items: center;
      }

      .Mbtn {
        width: 75%;
        padding: 0.75rem;
      }
    }
  </style>
</head>

<body class="light-theme">
  <div class="container py-5">
    <!-- Theme Toggle Button -->
    <div class="text-center mb-4">
      <button id="themeToggle" class="btn btn-primary">Switch to Dark Theme</button>
    </div>

    <div class="row">
      <!-- User Card Section -->
      <div class="col-md-4 mb-4">
        <div class="usercard">
          <div class="ucard_pic">
            <img src="https://dilan-sathruwan.github.io/Project_Grapher_Website/About%20Us/Photos/Awishka.jpg"
              alt="Profile Image" />
          </div>
          <hr />
          <h2>Hello, <?php echo htmlspecialchars($user['username']); ?></h2>
        </div>
      </div>

      <!-- About Section -->
      <div class="col-md-8 mb-4">
        <div class="agp">
          <div class="ag">
            <p>
              Lorem ipsum dolor sit amet consectetur, adipisicing elit. Blanditiis
              culpa commodi nesciunt alias consequatur, ad explicabo repudiandae
              esse nisi illum ab eius, sed iure! Veritatis molestias perspiciatis
              excepturi reiciendis sapiente.
            </p>
          </div>
          <div class="dwnbp">
            <button class="buttonDownload">Download Your TimeTable</button>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <!-- Timetable Section -->
      <div class="col-12">
        <div class="tbl">
          <p>Your Upcoming Lectures</p>
          <div class="ag">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Time</th>
                  <th>Lecture</th>
                  <th>Lecture Hall</th>
                  <th>Department</th>
                </tr>
              </thead>
              <tbody>
                <?php while ($lecture = $lectures_result->fetch_assoc()): ?>
                <tr>
                  <td><?php echo htmlspecialchars($lecture['time']); ?></td>
                  <td><?php echo htmlspecialchars($lecture['title']); ?></td>
                  <td><?php echo htmlspecialchars($lecture['hall']); ?></td>
                  <td><?php echo htmlspecialchars($lecture['department']); ?></td>
                </tr>
                <?php endwhile; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- Button Section -->
    <div class="btn-group">
      <button class="Mbtn">Button 1</button>
      <button class="Mbtn">Button 2</button>
      <button class="Mbtn">Button 3</button>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    const themeToggle = document.getElementById('themeToggle');
    const body = document.body;

    themeToggle.addEventListener('click', function () {
      body.classList.toggle('dark-theme');
      if (body.classList.contains('dark-theme')) {
        themeToggle.textContent = 'Switch to Light Theme';
      } else {
        themeToggle.textContent = 'Switch to Dark Theme';
      }
    });
  </script>
</body>

</html>
