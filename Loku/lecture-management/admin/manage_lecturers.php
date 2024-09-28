<?php
session_start();
include '../includes/header.php';  // Common header
include '../includes/db.php';  // Database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Lecturers</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Manage Lecturers</h1>
        <a href="add_lecturer.php" class="btn btn-success mb-3">Add New Lecturer</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Department</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch lecturers from the database
                $result = $conn->query("SELECT lecturers.id, lecturers.full_name, lecturers.email, departments.name AS department
                                        FROM lecturers
                                        LEFT JOIN departments ON lecturers.department_id = departments.id");

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['full_name']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['department']}</td>
                            <td>
                                <a href='edit_lecturer.php?id={$row['id']}' class='btn btn-warning'>Edit</a>
                                <a href='delete_lecturer.php?id={$row['id']}' class='btn btn-danger'>Delete</a>
                            </td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php include '../includes/footer.php'; // Common footer ?>
