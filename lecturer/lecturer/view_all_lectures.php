<?php
session_start();
include '../../admin/include/db_connection.inc.php';

// Check if user is logged in and is a lecturer
if (!isset($_SESSION['user'])) {
    header("Location:../../signin.php"); // Redirect to login if not logged in
    exit();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View All Lectures</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Table Theme Optimization */
        .table {
            background-color: rgba(255, 255, 255, 0.8);
            /* Light background for table */
            transition: background-color 0.3s, color 0.3s;
            border-radius: 15px;
        }

        .table thead {
            background-color: rgba(0, 123, 255, 0.9);
            /* Bootstrap's primary color */
            color: white;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(0, 123, 255, 0.1);
            /* Hover effect for rows */
        }

        body.dark-theme .table {
            background-color: rgba(0, 0, 0, 0.6);
            /* Dark theme background for table */
            color: #f8f9fa;
        }

        body.dark-theme .table thead {
            background-color: rgba(40, 167, 69, 0.9);
            /* Different color for dark theme */
        }

        body.dark-theme .table-hover tbody tr:hover {
            background-color: rgba(40, 167, 69, 0.1);
            /* Hover effect for dark theme */
        }

        /* Adjustments for text and container */
        .container {
            transition: background-color 0.3s ease, color 0.3s ease;
            border-radius: 15px;
        }

        body.light-theme .container {
            background-color: rgba(255, 255, 255, 0.85);
            /* Light theme container background */
            color: black;
            border-radius: 13px;
            padding: 0.75%;
        }

        body.dark-theme .container {
            background-color: rgba(0, 0, 0, 0.85);
            /* Dark theme container background */
            color: white;
            border-radius: 13px;
            padding: 0.75%;
        }

        /* For mobile responsiveness */
        @media (max-width: 768px) {
            .table {
                font-size: 0.9rem;
                /* Reduce font size slightly for mobile view */
            }
        }
    </style>
</head>

<body>
    <?php
    $page_title = "View All Lectures";
    include '../includes/lecturer_header.php';
    ?>
    <div class="container mt-5">
        <div class=" text-center rounded p-4">
            <div class="">
                <h5 class="mb-2 text-start">Search Lecture Schedule</h5>
                <form class="search-form" method="POST" action="">
                    <div class="row g-3 text-start">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="lecturer_name" class="form-label">Lecturer Name</label>
                                <input type="text" id="lecturer_name" name="lecturer_name" class="form-control" placeholder="Enter Lecturer's Name">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="department_name" class="form-label">Department</label>
                                <select id="department_name" name="department_name" class="form-select">
                                    <option value="">Select Department</option>
                                    <?php
                                    $stmt = $conn->query("SELECT id, department_name FROM departments");
                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        echo "<option value='" . $row['department_name']  . "'>" . $row['department_name'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="batch_name" class="form-label">Batch</label>
                                <input type="text" id="batch_name" name="batch_name" class="form-control" placeholder="Enter Batch Name">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="subject_num" class="form-label">Subject Number</label>
                                <input type="text" id="subject_num" name="subject_num" class="form-control" placeholder="Enter Subject Number">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="hall_name" class="form-label">Lecture Hall</label>
                                <input type="text" id="hall_name" name="hall_name" class="form-control" placeholder="Enter Hall Name">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="days" class="form-label">Days</label>
                                <select id="days" name="days" class="form-select">
                                    <option value="">Select Day</option>
                                    <option value="Monday">Monday</option>
                                    <option value="Tuesday">Tuesday</option>
                                    <option value="Wednesday">Wednesday</option>
                                    <option value="Thursday">Thursday</option>
                                    <option value="Friday">Friday</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 text-center ">
                            <button type="submit" class="btn btn-primary mt-3">Find avalible lecture</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark">
                        <th scope="col">ID</th>
                        <th scope="col">Lecture Name</th>
                        <th scope="col">Department Name</th>
                        <th scope="col">Batch Name</th>
                        <th scope="col">Subject Name</th>
                        <th scope="col">Hall Name</th>
                        <th scope="col">Days</th>
                        <th scope="col">Time</th>

                    </tr>
                </thead>
                <tbody>

                    <?php

                    // Capture the search inputs
                    $lecturer_name = $_POST['lecturer_name'] ?? '';
                    $department_name = $_POST['department_name'] ?? '';
                    $batch_name = $_POST['batch_name'] ?? '';
                    $subject_num = $_POST['subject_num'] ?? '';
                    $hall_name = $_POST['hall_name'] ?? '';
                    $days = $_POST['days'] ?? '';
                    $time_slot = $_POST['time_slot'] ?? '';

                    // Start building the SQL query
                    $sql = "SELECT ls.id, 
                                      l.username AS lecturer_name, 
                                      d.department_name, 
                                      b.batch_name, 
                                      s.subject_number AS subject_num, 
                                      lh.hall_name, 
                                      ls.days, 
                                      ts.start_time, ts.end_time 
                               FROM lecture_schedule ls 
                               JOIN lecturers l ON ls.lecturer_id = l.id 
                               JOIN departments d ON ls.department_id = d.id 
                               JOIN batches b ON ls.batch_id = b.id 
                               JOIN subjects s ON ls.subject_id = s.id 
                               JOIN lecture_halls lh ON ls.hall_id = lh.id 
                               JOIN timeslot ts ON ls.slot_id = ts.slot_id
                               WHERE 1=1"; // Default condition to allow appending other conditions

                    // Append conditions based on the search inputs
                    if (!empty($lecturer_name)) {
                        $sql .= " AND l.username LIKE :lecturer_name";
                    }

                    if (!empty($department_name)) {
                        $sql .= " AND d.department_name = :department_name";
                    }

                    if (!empty($batch_name)) {
                        $sql .= " AND b.batch_name LIKE :batch_name";
                    }

                    if (!empty($subject_num)) {
                        $sql .= " AND s.subject_number LIKE :subject_num";
                    }

                    if (!empty($hall_name)) {
                        $sql .= " AND lh.hall_name LIKE :hall_name";
                    }

                    if (!empty($days)) {
                        $sql .= " AND ls.days = :days";
                    }

                    if (!empty($time_slot)) {
                        // Parse time slot if needed or implement additional logic for handling time slots
                    }

                    // Prepare and execute the statement
                    $stmt = $conn->prepare($sql);

                    // Bind parameters
                    if (!empty($lecturer_name)) {
                        $stmt->bindValue(':lecturer_name', '%' . $lecturer_name . '%', PDO::PARAM_STR);
                    }

                    if (!empty($department_name)) {
                        $stmt->bindValue(':department_name', $department_name, PDO::PARAM_STR);
                    }

                    if (!empty($batch_name)) {
                        $stmt->bindValue(':batch_name', '%' . $batch_name . '%', PDO::PARAM_STR);
                    }

                    if (!empty($subject_num)) {
                        $stmt->bindValue(':subject_num', '%' . $subject_num . '%', PDO::PARAM_STR);
                    }

                    if (!empty($hall_name)) {
                        $stmt->bindValue(':hall_name', '%' . $hall_name . '%', PDO::PARAM_STR);
                    }

                    if (!empty($days)) {
                        $stmt->bindValue(':days', $days, PDO::PARAM_STR);
                    }

                    // Execute and fetch results
                    $stmt->execute();
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    // Display results here...

                    if (!empty($result)) {
                        foreach ($result as $row) {
                            echo '<tr>';
                            echo '<td>' . htmlspecialchars($row['id']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['lecturer_name']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['department_name']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['batch_name']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['subject_num']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['hall_name']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['days']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['start_time'] . ' - ' . $row['end_time']) . '</td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr><td colspan="9">No results found</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php
    include '../includes/footer.php';
    ?>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

<!-- This Page Create by Loku -->