<?php
session_start();
include '../../admin/include/db_connection.inc.php';

// Check if user is logged in as Lecturer
// if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Lecturer') {
//     header("Location: ../auth/login.php");
//     exit();
// }

$lecturer_id = $_SESSION['user']; // Assuming this contains the lecturer's ID

// Handle adding a new lecture
if (isset($_POST['add_lecture'])) {
    $subject_id = $_POST['subject_id'];
    $hall_id = $_POST['hall_id'];
    $department_id = $_POST['department_id'];
    $batch_id = $_POST['batch_id'];
    $slot_id = $_POST['slot_id'];
    $days = $_POST['day_of_week'];

    try {
        // Check if the lecture already exists
        $check_query = "SELECT * FROM lecture_book 
                        WHERE subject_id = :subject_id 
                          AND hall_id = :hall_id 
                          AND department_id = :department_id 
                          AND batch_id = :batch_id 
                          AND slot_id = :slot_id 
                          AND days = :days 
                          AND lecturer_id = :lecturer_id";
        $check_stmt = $conn->prepare($check_query);
        $check_stmt->execute([
            ':subject_id' => $subject_id,
            ':hall_id' => $hall_id,
            ':department_id' => $department_id,
            ':batch_id' => $batch_id,
            ':slot_id' => $slot_id,
            ':days' => $days,
            ':lecturer_id' => $lecturer_id,
        ]);

        if ($check_stmt->rowCount() > 0) {
            $error_message = "This lecture booking already exists.";
        } else {
            // Insert the new lecture
            $add_query = "INSERT INTO lecture_book 
                          (subject_id, hall_id, department_id, batch_id, days, slot_id, lecturer_id) 
                          VALUES (:subject_id, :hall_id, :department_id, :batch_id, :days, :slot_id, :lecturer_id)";
            $add_stmt = $conn->prepare($add_query);
            $add_stmt->execute([
                ':subject_id' => $subject_id,
                ':hall_id' => $hall_id,
                ':department_id' => $department_id,
                ':batch_id' => $batch_id,
                ':days' => $days,
                ':slot_id' => $slot_id,
                ':lecturer_id' => $lecturer_id,
            ]);

            $success_message = "Lecture added success";
        }
    } catch (PDOException $e) {
        $error_message = "Error: " . $e->getMessage();
    }
}

// Fetch all lecture bookings
try {
    $query = "
        SELECT 
            lb.id AS booking_id,
            s.subject_name,
            b.batch_name,
            d.department_name AS dept_name,
            lb.days AS day_of_week,
            ts.start_time,
            ts.end_time,
            lh.hall_name
        FROM 
            lecture_book lb
        INNER JOIN 
            subjects s ON lb.subject_id = s.id
        INNER JOIN 
            batches b ON lb.batch_id = b.id
        INNER JOIN 
            departments d ON lb.department_id = d.id
        INNER JOIN 
            timeslot ts ON lb.slot_id = ts.slot_id
        INNER JOIN 
            lecture_halls lh ON lb.hall_id = lh.id
        WHERE 
            lb.lecturer_id = :lecturer_id
        ORDER BY 
            FIELD(lb.days, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'), ts.start_time;
    ";
    $stmt = $conn->prepare($query);
    $stmt->execute([':lecturer_id' => $lecturer_id]);
    $lectures = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Handle deletion
if (isset($_GET['delete'])) {
    $booking_id = $_GET['delete'];

    try {
        $delete_query = "DELETE FROM lecture_book WHERE id = :booking_id";
        $delete_stmt = $conn->prepare($delete_query);
        $delete_stmt->execute([':booking_id' => $booking_id]);

        header("Location: booking_time_table.php?massage=deleted success");
        exit();
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}

// Fetch data for dropdowns
try {
    $departments_query = "SELECT id AS dept_id, department_name AS dept_name FROM departments";
    $departments_stmt = $conn->query($departments_query);
    $departments = $departments_stmt->fetchAll(PDO::FETCH_ASSOC);

    $subjects_query = "SELECT id AS subject_id, subject_name FROM subjects";
    $subjects_stmt = $conn->query($subjects_query);
    $subjects = $subjects_stmt->fetchAll(PDO::FETCH_ASSOC);

    $batches_query = "SELECT id AS batch_id, batch_name FROM batches";
    $batches_stmt = $conn->query($batches_query);
    $batches = $batches_stmt->fetchAll(PDO::FETCH_ASSOC);

    $halls_query = "SELECT id AS hall_id, hall_name FROM lecture_halls";
    $halls_stmt = $conn->query($halls_query);
    $halls = $halls_stmt->fetchAll(PDO::FETCH_ASSOC);

    $timeslots_query = "SELECT slot_id, start_time, end_time FROM timeslot WHERE is_interval = 0";
    $timeslots_stmt = $conn->query($timeslots_query);
    $timeslots = $timeslots_stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Time Table</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link href="../assets/css/button.css" rel="stylesheet">
    <style>
        body {
            transition: background-color 0.5s, color 0.5s;
            font-family: Arial, sans-serif;
        }

        /* Table Styles */
        .table {
            background-color: rgba(255, 255, 255, 0.9);
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        body.dark-theme .table {
            background-color: rgba(52, 58, 64, 0.85);
            /* Dark table background */
            color: #f8f9fa;
        }

        .table thead {
            background-color: rgba(0, 123, 255, 0.9);
            color: #fff;
        }

        body.dark-theme .table thead {
            background-color: rgba(40, 167, 69, 0.9);
            /* Adjusted header color */
        }

        .table-hover tbody tr:hover {
            background-color: rgba(0, 123, 255, 0.1);
        }

        body.dark-theme .table-hover tbody tr:hover {
            background-color: rgba(40, 167, 69, 0.1);
        }

        h2,
        h3 {
            color: #007bff;
        }

        table th {
            background-color: #007bff;
            color: white;
        }

        .form-control,
        .form-group label {
            border-radius: 0.5rem;
        }

        /* Center heading and adjust form width on smaller devices */
        h3 {
            font-size: 1.75rem;
            font-weight: bold;
        }

        form {
            margin: 0 auto;
            max-width: 100%;
        }

        /* Add some padding to form elements */
        .form-control {
            padding: 10px;
            font-size: 1rem;
        }

        /* Style the form fields and buttons */
        .form-control {
            border-radius: 5px;
            border: 1px solid #ced4da;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #80bdff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.25);
        }

        button {
            font-size: 1.1rem;
            padding: 10px;
            border-radius: 5px;
        }
    </style>
</head>

<body>

    <?php
    $page_title = "Manage Booking Time Table";
    include '../includes/lecturer_header.php';
    ?>

    <div class="container mt-5">
        <h2>Manage Your Booking Time Table</h2>

        <!-- Display error message if exists -->
        <?php if (isset($error_message)): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>

        <?php if (isset($success_message)): ?>
            <div class="alert alert-primary text-center"><?php echo htmlspecialchars($success_message); ?></div>
        <?php endif; ?>

        <!-- Form to add new lecture -->
        <h3 class="mt-5 text-center">Add New Lecture</h3>
        <form id="lecture-form" action="booking_time_table.php" method="post" class="needs-validation" novalidate>
            <div class="row">
                <!-- Department Selection -->
                <div class="form-group col-lg-6 col-md-12 mb-3">
                    <label for="department_id">Department</label>
                    <select name="department_id" id="department_id" class="form-control" required>
                        <option value="">Select a Department</option>
                        <?php foreach ($departments as $department) : ?>
                            <option value="<?php echo $department['dept_id']; ?>"><?php echo $department['dept_name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">Please select a department.</div>
                </div>

                <!-- Batch Selection -->
                <div class="form-group col-lg-6 col-md-12 mb-3">
                    <label for="batch_id">Batch</label>
                    <select name="batch_id" id="batch_id" class="form-control" required>
                        <option value="">Select a Batch</option>
                        <?php foreach ($batches as $batch) : ?>
                            <option value="<?php echo $batch['batch_id']; ?>"><?php echo $batch['batch_name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">Please select a batch.</div>
                </div>
            </div>

            <div class="row">

                <!-- Subject Selection -->
                <div class="form-group col-lg-6 col-md-12 mb-3">
                    <label for="subject_id">Subject</label>
                    <select name="subject_id" id="subject_id" class="form-control" required>
                        <option value="">Select a Subject</option>
                        <?php foreach ($subjects as $subject) : ?>
                            <option value="<?php echo $subject['subject_id']; ?>"><?php echo $subject['subject_name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">Please select a subject.</div>
                </div>

                <!-- Hall Selection -->
                <div class="form-group col-lg-6 col-md-12 mb-3">
                    <label for="hall_id">Hall</label>
                    <select name="hall_id" class="form-control" required>
                        <option value="">Select a Hall</option>
                        <?php foreach ($halls as $hall) : ?>
                            <option value="<?php echo $hall['hall_id']; ?>"><?php echo $hall['hall_name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

            </div>

            <div class="row">


                <!-- Day of the Week -->
                <div class="form-group col-lg-6 col-md-12 mb-3">
                    <label for="day_of_week">Day of the Week</label>
                    <select name="day_of_week" class="form-control" required>
                        <option value="Monday">Monday</option>
                        <option value="Tuesday">Tuesday</option>
                        <option value="Wednesday">Wednesday</option>
                        <option value="Thursday">Thursday</option>
                        <option value="Friday">Friday</option>
                    </select>
                </div>

                <div class="form-group col-lg-6 col-md-12 mb-3">
                    <label for="slot_id">Time Slot</label>
                    <select name="slot_id" class="form-control" required>
                        <option value="">Select a Time Slot</option>
                        <?php foreach ($timeslots as $slot) : ?>
                            <option value="<?php echo $slot['slot_id']; ?>"><?php echo $slot['start_time'] . ' - ' . $slot['end_time']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="row">
                <!-- Time Slot Selection -->

            </div>

            <div class="row">
                <div class="col-12 text-center">
                    <button type="submit" name="add_lecture" class="btn btn-primary">Add Lecture</button>
                </div>
            </div>
        </form>


        <!-- Display the current bookings -->
        <h3 class="mt-5">Your Current Booking Time Table</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Batch</th>
                    <th>Department</th>
                    <th>Day of the Week</th>
                    <th>Time Slot</th>
                    <th>Hall</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($lectures) > 0) : ?>
                    <?php foreach ($lectures as $lecture) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($lecture['subject_name']); ?></td>
                            <td><?php echo htmlspecialchars($lecture['batch_name']); ?></td>
                            <td><?php echo htmlspecialchars($lecture['dept_name']); ?></td>
                            <td><?php echo htmlspecialchars($lecture['day_of_week']); ?></td>
                            <td><?php echo htmlspecialchars($lecture['start_time']) . ' - ' . htmlspecialchars($lecture['end_time']); ?></td>
                            <td><?php echo htmlspecialchars($lecture['hall_name']); ?></td>
                            <td>
                                <a href="?delete=<?php echo $lecture['booking_id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">No lectures found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-4.5.2/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            // Department change event
            $('#department_id').change(function() {
                const deptId = $(this).val();
                if (deptId) {
                    $.ajax({
                        url: 'get_batches.php',
                        type: 'POST',
                        data: {
                            dept_id: deptId
                        },
                        dataType: 'json',
                        success: function(data) {
                            $('#batch_id').empty().append('<option value="">Select a Batch</option>').prop('disabled', false);
                            $.each(data, function(index, batch) {
                                $('#batch_id').append('<option value="' + batch.batch_id + '">' + batch.batch_name + '</option>');
                            });
                            $('#subject_id').prop('disabled', true).empty().append('<option value="">Select a Subject</option>');
                            $('#semester_id').prop('disabled', true).empty().append('<option value="">Select a Semester</option>');
                        }
                    });
                } else {
                    $('#batch_id').empty().append('<option value="">Select a Batch</option>').prop('disabled', true);
                    $('#subject_id').empty().append('<option value="">Select a Subject</option>').prop('disabled', true);
                    $('#semester_id').empty().append('<option value="">Select a Semester</option>').prop('disabled', true);
                }
            });

            // Batch change event
            $('#batch_id').change(function() {
                const batchId = $(this).val();
                if (batchId) {
                    $.ajax({
                        url: 'get_semester.php',
                        type: 'POST',
                        data: {
                            batch_id: batchId
                        },
                        dataType: 'json',
                        success: function(data) {
                            $('#semester_id').empty().append('<option value="">Select a Semester</option>').prop('disabled', false);
                            $.each(data, function(index, semester) {
                                $('#semester_id').append('<option value="' + semester.semester_id + '">Semester ' + semester.semester_no + '</option>');
                            });
                        }
                    });
                } else {
                    $('#semester_id').empty().append('<option value="">Select a Semester</option>').prop('disabled', true);
                }
            });

            // Semester change event to get subjects
            $('#semester_id').change(function() {
                const semesterId = $(this).val();
                if (semesterId) {
                    $.ajax({
                        url: 'get_subjects.php',
                        type: 'POST',
                        data: {
                            semester_id: semesterId
                        },
                        dataType: 'json',
                        success: function(data) {
                            $('#subject_id').empty().append('<option value="">Select a Subject</option>').prop('disabled', false);
                            $.each(data, function(index, subject) {
                                $('#subject_id').append('<option value="' + subject.subject_id + '">' + subject.subject_name + '</option>');
                            });
                        }
                    });
                } else {
                    $('#subject_id').empty().append('<option value="">Select a Subject</option>').prop('disabled', true);
                }
            });
        });
    </script>

</body>

</html>