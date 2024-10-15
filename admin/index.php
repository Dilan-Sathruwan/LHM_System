<?php include './include/header.php'; ?>
<?php

try {
    // Query total students
    $studentQuery = $conn->query("SELECT COUNT(*) as total_students FROM students");
    $total_students = $studentQuery->fetch(PDO::FETCH_ASSOC)['total_students'];

    // Query total lecturers
    $lecturerQuery = $conn->query("SELECT COUNT(*) as total_lecturers FROM lecturers");
    $total_lecturers = $lecturerQuery->fetch(PDO::FETCH_ASSOC)['total_lecturers'];

    // Query total subjects
    $subjectQuery = $conn->query("SELECT COUNT(*) as total_subjects FROM subjects");
    $total_subjects = $subjectQuery->fetch(PDO::FETCH_ASSOC)['total_subjects'];

    // Query total lecture halls
    $hallQuery = $conn->query("SELECT COUNT(*) as total_halls FROM lecture_halls");
    $total_halls = $hallQuery->fetch(PDO::FETCH_ASSOC)['total_halls'];



    // Query to get department names and number of students in each department
    $query = "
     SELECT departments.department_name, COUNT(students.id) as student_count 
     FROM departments 
     LEFT JOIN students ON departments.id = students.department_id
     GROUP BY departments.department_name";
    $stmt = $conn->query($query);
    $departments = [];
    $student_counts = [];

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $departments[] = $row['department_name'];
        $student_counts[] = $row['student_count'];


        // SQL query to get department names and number of students
    $query1 = "
    SELECT d.department_name, COUNT(s.id) AS student_count1
    FROM departments d
    LEFT JOIN students s ON d.id = s.department_id
    GROUP BY d.department_name
    ";
    
    // Execute the query
    $stmt1 = $conn->query($query1);
    $department = $stmt1->fetchAll(PDO::FETCH_ASSOC);
    }
} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
}
?>






<!-- Content Start -->
<div class="content">
    <!-- Navbar Start -->
    <?php include './include/navbar.php'; ?>
    <!-- Navbar End -->


    <!-- Total card Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-users fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Total Students</p>
                        <h6 class="mb-0"><?= $total_students ?></h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-user fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Total Lectures</p>
                        <h6 class="mb-0"><?= $total_lecturers ?></h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-book fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Total Subject</p>
                        <h6 class="mb-0"><?= $total_subjects ?></h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-building fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Total Lecture Halls</p>
                        <h6 class="mb-0"><?= $total_halls ?></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Total card End -->

    <!-- Chart Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <!-- HTML Structure for the Chart -->
            <div class="col-sm-12 col-xl-6">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Student Count per Department</h6>
                    <canvas id="bar-chart"></canvas>
                </div>
            </div>
            <!-- HTML to display the table -->
            <div class="col-sm-12 col-xl-6">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">All Students Of Departments</h6>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Department Name</th>
                                <th scope="col">Number</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($department)): ?>
                                <?php foreach ($department as $department1): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($department1['department_name']); ?></td>
                                        <td><?php echo htmlspecialchars($department1['student_count1']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="2">No data available</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Chart End -->




    <!-- Recent Sales Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Recent Salse</h6>
                <a href="">Show All</a>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">Date</th>
                            <th scope="col">Invoice</th>
                            <th scope="col">Customer</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>01 Jan 2045</td>
                            <td>INV-0123</td>
                            <td>Jhon Doe</td>
                            <td>$123</td>
                            <td>Paid</td>
                            <td><a class="btn btn-sm btn-primary" href="">Detail</a></td>
                        </tr>
                        <tr>
                            <td>01 Jan 2045</td>
                            <td>INV-0123</td>
                            <td>Jhon Doe</td>
                            <td>$123</td>
                            <td>Paid</td>
                            <td><a class="btn btn-sm btn-primary" href="">Detail</a></td>
                        </tr>
                        <tr>
                            <td>01 Jan 2045</td>
                            <td>INV-0123</td>
                            <td>Jhon Doe</td>
                            <td>$123</td>
                            <td>Paid</td>
                            <td><a class="btn btn-sm btn-primary" href="">Detail</a></td>
                        </tr>
                        <tr>
                            <td>01 Jan 2045</td>
                            <td>INV-0123</td>
                            <td>Jhon Doe</td>
                            <td>$123</td>
                            <td>Paid</td>
                            <td><a class="btn btn-sm btn-primary" href="">Detail</a></td>
                        </tr>
                        <tr>
                            <td>01 Jan 2045</td>
                            <td>INV-0123</td>
                            <td>Jhon Doe</td>
                            <td>$123</td>
                            <td>Paid</td>
                            <td><a class="btn btn-sm btn-primary" href="">Detail</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>


    </div>
    <!-- Recent Sales End -->

</div>
<!-- Content End -->

<?php include './include/footer.php'; ?>

 <!-- ##################department student count############## -->
 <script>
        document.addEventListener("DOMContentLoaded", function() {
            var ctx4 = document.getElementById("bar-chart").getContext("2d");

            // Fetching the PHP data into JavaScript
            var labels = <?php echo json_encode($departments); ?>;
            var data = <?php echo json_encode($student_counts); ?>;

            var myChart4 = new Chart(ctx4, {
                type: "bar",
                data: {
                    labels: labels, // Department names
                    datasets: [{
                        label: 'Number of Student',
                        backgroundColor: [
                            "rgba(0, 156, 255, .7)",
                            "rgba(0, 156, 255, .6)",
                            "rgba(0, 156, 255, .5)",
                            "rgba(0, 156, 255, .4)",
                            "rgba(0, 156, 255, .3)"
                        ],
                        data: data // Number of students per department
                    }]
                },
                options: {
                    responsive: true
                }
            });
        });
    </script>