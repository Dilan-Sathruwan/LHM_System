<?php include './include/header.php'; ?>

<?php
include "include/db_connection.inc.php";

// Define all days of the week (Move this outside of the POST check)
$days_of_week = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];

// Define all time slots (Move this outside of the POST check)
$time_slots = [
    '08:30:00 - 09:30:00',
    '09:30:00 - 10:30:00',
    '10:30:00 - 11:30:00',
    '11:30:00 - 12:30:00',
    '12:30:00 - 13:00:00', // Interval
    '13:00:00 - 14:00:00',
    '14:00:00 - 15:00:00',
    '15:00:00 - 16:00:00',
    '16:00:00 - 17:00:00'
];

if (isset($_POST['lecturers'])) {
    // Fetch the lecturer ID from the POST request
    $lecturer_id = $_POST['lecturers'];

    // Fetch the lecturer's schedule
    $query = "
        SELECT 
            ls.id AS timetable_id,
            s.subject_number,
            lh.hall_name,
            b.batch_name,
            d.dept_code,
            ts.start_time,
            ts.end_time,
            ls.days AS day_of_week
        FROM lecture_schedule ls
        JOIN subjects s ON ls.subject_id = s.id
        JOIN lecture_halls lh ON ls.hall_id = lh.id
        JOIN batches b ON ls.batch_id = b.id
        JOIN departments d ON b.department_id = d.id
        JOIN timeslot ts ON ls.slot_id = ts.slot_id
        WHERE ls.lecturer_id = ?
        ORDER BY FIELD(ls.days, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'), ts.start_time
    ";

    // Prepare the statement using PDO
    $stmt = $conn->prepare($query);
    $stmt->execute([$lecturer_id]);

    // Fetch all results
    $lectures = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Create a 2D array to hold the timetable data [day][time] => lecture details
    $timetable = [];
    foreach ($days_of_week as $day) {
        $timetable[$day] = [];
    }

    // Fill the timetable with lecture details
    foreach ($lectures as $lecture) {
        $day = $lecture['day_of_week'];
        $time = $lecture['start_time'] . ' - ' . $lecture['end_time'];

        // Store the lecture details in the timetable array under the correct day and time
        $timetable[$day][$time] = [
            'subject_number' => $lecture['subject_number'],
            'dept_code' => $lecture['dept_code'],
            'batch_name' => $lecture['batch_name'],
            'hall_name' => $lecture['hall_name']
        ];
    }
}
?>

<!-- Content Start -->
<div class="content">
    <!-- Navbar Start -->
    <?php include './include/navbar.php'; ?>
    <!-- Navbar End -->

    <!-- Blank Start -->
    <div class="container-fluid pt-4 px-4 ">
        <div class="row rounded align-items-center justify-content-center mx-0">
            <div class="container mt-2 bg-light p-4 rounded">
                <form action="" id="lForm" method="post">
                    <div class="row g-3">
                        <!-- Lecturer Selection -->
                        <div class="col-md-4">
                            <label for="inputlec" class="form-label fw-bold">Select Lecturer</label>
                            <select id="inputlec" class="form-select" name="lecturers" required>
                                <option selected value="">Choose a Lecturer</option>
                                <?php
                                $stmt = $conn->query("SELECT id, username FROM lecturers");
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<option value='" . $row['id'] . "'>" . $row['username'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <div class="col-md-4 d-flex align-items-end ">
                            <button type="submit" form="lForm" class="btn btn-primary btn-md w-15">
                                Check Timetable
                            </button>
                        </div>
                        <div class=" col-md-4  d-flex align-items-end justify-content-end mx-0">
                            <button class="btn btn-success print-btn text-end " onclick="printTimetable()">Print Timetable</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="container mt-5 bg-light p-4 rounded printLectures">
                <h3 class="text-start">Lecture Timetable for
                    <?php
                    if (isset($_POST['lecturers'])) {
                        $lecturer_id = $_POST['lecturers'];

                        $stmt = $conn->prepare("SELECT id, username FROM lecturers WHERE id = :lecturer_id");
                        $stmt->bindParam(':lecturer_id', $lecturer_id, PDO::PARAM_INT);
                        $stmt->execute();

                        $row = $stmt->fetch(PDO::FETCH_ASSOC);

                        if ($row) {
                            echo htmlspecialchars($row['username']);
                        } else {
                            echo "Lecturer not found";
                        }
                    }
                    ?>
                </h3>

                <div onload="fetchTime()">
                    <p>Date and Time: <span id="time"></span></p>
                </div>
                <script>
                    function fetchTime() {
                        // Create a new XMLHttpRequest object
                        const xhr = new XMLHttpRequest();
                        xhr.open('GET', 'time.php', true); // Send a GET request to time.php

                        xhr.onload = function() {
                            if (this.status === 200) {
                                // Parse the JSON response
                                const dateTime = JSON.parse(this.responseText);
                                // Update the HTML content with the current date and time
                                document.getElementById('time').innerHTML = dateTime;
                            }
                        };

                        xhr.send(); // Send the request
                    }

                    // Call fetchTime every second
                    setInterval(fetchTime, 1000);
                </script>



                <div class="table-responsive">
                    <table class="table table-bordered timetable-table table-striped">
                        <thead>
                            <tr>
                                <th>Time</th>
                                <?php foreach ($days_of_week as $day) : ?>
                                    <th><?php echo $day; ?></th>
                                <?php endforeach; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($time_slots as $time) : ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($time); ?></td>
                                    <?php foreach ($days_of_week as $day) : ?>
                                        <td>
                                            <?php
                                            // Extract start and end time for comparison
                                            list($start_time, $end_time) = explode(' - ', $time);
                                            $lecture_found = false;

                                            // Check if the lecture exists in this time slot
                                            if (isset($timetable[$day][$start_time . ' - ' . $end_time])) {
                                                $lecture = $timetable[$day][$start_time . ' - ' . $end_time];
                                                echo "<strong>" . htmlspecialchars($lecture['subject_number']) . "</strong><br>";
                                                echo "<em>" . htmlspecialchars($lecture['dept_code']) . "</em><br>";
                                                echo "Batch: " . htmlspecialchars($lecture['batch_name']) . "<br>";
                                                echo "Hall: " . htmlspecialchars($lecture['hall_name']);
                                                $lecture_found = true;
                                            }

                                            // If no lecture found, show empty cell or Interval label
                                            if (!$lecture_found) {
                                                if ($time === '12:30:00 - 13:00:00') {
                                                    echo "<div class='interval-label'>Interval</div>";
                                                } else {
                                                    echo "<span>--</span>";
                                                }
                                            }
                                            ?>
                                        </td>
                                    <?php endforeach; ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <?php if (empty($lectures)) : ?>
                    <div class="alert alert-warning text-center">
                        <p>No scheduled lectures found for you.</p>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </div>

    <script>
        function printTimetable() {
            var printContent = document.querySelector('.printLectures').innerHTML; // Select the timetable container
            var originalContent = document.body.innerHTML;

            document.body.innerHTML = printContent; // Replace body with the timetable content
            window.print(); // Open the print dialog
            document.body.innerHTML = originalContent; // Restore original content after printing
        }
    </script>


    <!-- Blank End -->
</div>
<!-- Content End -->

<?php include './include/footer.php'; ?>