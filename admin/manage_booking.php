<?php
session_start();
include '../includes/db_connection.inc.php'; // Ensure this path is correct

// Check if the user is logged in as Admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    header("Location: ../auth/login.php");
    exit();
}

// Handle approving a booking
if (isset($_GET['approve'])) {
    $booking_id = $_GET['approve'];

    // Fetch booking details for approval
    $booking_query = "SELECT * FROM BookingTimetable WHERE booking_id = ?";
    $stmt = $conn->prepare($booking_query);
    $stmt->bind_param("i", $booking_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $booking = $result->fetch_assoc();

        // Insert the approved booking into the Timetable table
        $insert_query = "INSERT INTO Timetable (lecturer_id, subject_id, hall_id, batch_id, semester_id, day_of_week, slot_id)
                         VALUES (?, ?, ?, ?, ?, ?, ?)";
        $insert_stmt = $conn->prepare($insert_query);
        $insert_stmt->bind_param("iiissii", $booking['lecturer_id'], $booking['subject_id'], $booking['hall_id'], $booking['batch_id'], $booking['semester_id'], $booking['day_of_week'], $booking['slot_id']);
        $insert_stmt->execute();
        $insert_stmt->close();

        // Update the status of the booking in the BookingTimetable table to 'approved'
        $update_query = "UPDATE BookingTimetable SET status = 'approved', approval_date = CURRENT_TIMESTAMP WHERE booking_id = ?";
        $update_stmt = $conn->prepare($update_query);
        $update_stmt->bind_param("i", $booking_id);
        $update_stmt->execute();
        $update_stmt->close();
    }

    header("Location: manage_booking.php");
    exit();
}

// Handle disapproving a booking
if (isset($_GET['disapprove'])) {
    $booking_id = $_GET['disapprove'];

    // Delete the disapproved booking from the BookingTimetable table
    $delete_query = "DELETE FROM BookingTimetable WHERE booking_id = ?";
    $delete_stmt = $conn->prepare($delete_query);
    $delete_stmt->bind_param("i", $booking_id);
    $delete_stmt->execute();
    $delete_stmt->close();

    header("Location: manage_booking.php");
    exit();
}

// Fetch all bookings for the admin to manage
$query = "
    SELECT 
        bt.booking_id,
        s.subject_name,
        h.hall_name,
        b.batch_name,
        d.dept_name,
        ts.start_time,
        ts.end_time,
        bt.day_of_week,
        bt.semester_id,
        bt.status,
        bt.request_date
    FROM BookingTimetable bt
    JOIN Subjects s ON bt.subject_id = s.subject_id
    JOIN Halls h ON bt.hall_id = h.hall_id
    JOIN Batches b ON bt.batch_id = b.batch_id
    JOIN Departments d ON b.dept_id = d.dept_id
    JOIN TimeSlots ts ON bt.slot_id = ts.slot_id
    ORDER BY FIELD(bt.day_of_week, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'), ts.start_time
";

$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();

$bookings = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $bookings[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Lecturer Bookings</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-W3A60z9z8tQKvkl+EXU+IvmWQyEnmWveq2B+miqLsJxd2PrsZKHqPHG6P62c69H" crossorigin="anonymous">
    <!-- Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>

<?php
$page_title = "Lecturer Dashboard";
include '../pages/admin_header2.php';
?>

<div class="container-fluid mt-4">
    <h1 class="mb-4">Manage Lecturer Bookings</h1>

    <?php if (isset($error_message)) { echo "<div class='alert alert-danger'>$error_message</div>"; } ?>

    <div class="table-responsive">
        <table class="table table-bordered ">
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Batch</th>
                    <th>Hall</th>
                    <th>Time Slot</th>
                    <th>Day</th>
                    <th>Status</th>
                    <th>Request Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bookings as $booking) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($booking['subject_name']); ?></td>
                        <td><?php echo htmlspecialchars($booking['batch_name']); ?></td>
                        <td><?php echo htmlspecialchars($booking['hall_name']); ?></td>
                        <td><?php echo htmlspecialchars($booking['start_time']) . ' - ' . htmlspecialchars($booking['end_time']); ?></td>
                        <td><?php echo htmlspecialchars($booking['day_of_week']); ?></td>
                        <td>
                            <?php 
                            $status = ucfirst(htmlspecialchars($booking['status']));
                            echo "<span class='badge " . ($status == 'Approved' ? 'bg-success' : ($status == 'Rejected' ? 'bg-danger' : 'bg-warning')) . "'>$status</span>";
                            ?>
                        </td>
                        <td><?php echo htmlspecialchars($booking['request_date']); ?></td>
                        <td>
                            <?php if ($booking['status'] == 'pending') : ?>
                                <a href="manage_booking.php?approve=<?php echo $booking['booking_id']; ?>" class="btn btn-success btn-sm">
                                    <i class="fas fa-check"></i> Approve
                                </a>
                                <a href="manage_booking.php?disapprove=<?php echo $booking['booking_id']; ?>" class="btn btn-danger btn-sm">
                                    <i class="fas fa-times"></i> Disapprove
                                </a>
                            <?php else : ?>
                                <span class="text-muted">No action needed</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Bootstrap JS and Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybG3vsWzF7Pbm5bXy8r+Mtoh3vB63d0ItpdWnNvxj0p3L1P2L" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-cuXxexi8gc8fzEwwIuZdbv7hRfs+JfZqzkzNhf5Ify96mU0g8rp06Y9y3lR4P/ZC" crossorigin="anonymous"></script>

</body>
</html>
