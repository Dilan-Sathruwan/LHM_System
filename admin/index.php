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
    }


// notyet!!!!!!!!!!!!!!!!!!!!!!
    $query1 = "
      SELECT b.batch_year, d.dept_code, COUNT(s.id) AS student_count
        FROM batches b
        JOIN students s ON s.batch_id = b.id
        JOIN departments d ON s.department_id = d.id
        WHERE s.batch_id IS NOT NULL
        GROUP BY b.batch_year, d.dept_code
        ORDER BY b.batch_year ASC";
    $stmt1 = $conn->query($query1);

    $batch_years = [];
    $department_data = [];

    // Organize data by batch year and department code
    while ($row = $stmt1->fetch(PDO::FETCH_ASSOC)) {
        $batch_year = $row['batch_year'];
        $department_code = $row['dept_code'];
        $student_count = $row['student_count'];

        // Populate the data for the chart
        if (!isset($batch_years[$batch_year])) {
            $batch_years[$batch_year] = $batch_year;
        }

        if (!isset($department_data[$department_code])) {
            $department_data[$department_code] = [];
        }

        $department_data[$department_code][] = $student_count;
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
            <!-- HTML Structure for the Chart -->
            <div class="col-sm-12 col-xl-6">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Multiple Bar Chart - Students per Department by Year</h6>
                    <canvas id="batch_students_of_year"></canvas>
                </div>
            </div>
        </div>
    </div>
    <!-- Chart End -->


    <!-- ##################batch year department student count!!!!!!!!!!!!!!not yet############## -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var ctx1 = document.getElementById("batch_students_of_year").getContext("2d");

            // Fetch the batch years and department data from PHP
            var labels = <?php echo json_encode(array_values($batch_years)); ?>;
            var datasets = [];
            var department_data = <?php echo json_encode($department_data); ?>;

            // Define some colors for the chart
            var colors = [
                "rgba(0, 156, 255, .7)",
                "rgba(0, 156, 255, .5)",
                "rgba(0, 156, 255, .3)"
            ];

            var i = 0;

            // Prepare datasets for each department code
            for (var department_code in department_data) {
                datasets.push({
                    label: department_code, // Department code as label
                    data: department_data[department_code], // Student count data
                    backgroundColor: colors[i % colors.length]
                });
                i++;
            }

            // Generate the chart
            var myChart1 = new Chart(ctx1, {
                type: "bar",
                data: {
                    labels: labels, // Batch years as labels
                    datasets: datasets // Department codes as dataset labels with student counts
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true // Ensure the y-axis starts at 0
                        }
                    }
                }
            });
        });
    </script>




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
                        label: 'Number of Students',
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


    <!-- data Student table Start -->
    <div class="container-fluid pt-4 px-4">

        <main id="" class="">

            <section class="section">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="card">
                            <div class="card-body table-responsive">
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <h3 class="mb-0">Student Datatable</h3>

                                </div>

                                <hr>

                                <!-- Table with stripped rows -->
                                <table class="table datatable text-start align-middle table-bordered table-hover mb-0">
                                    <thead>
                                        <tr>

                                            <th>Index Number</th>
                                            <th>Student Name</th>
                                            <th>Student Email</th>
                                            <th>Address</th>
                                            <th>Phone Number</th>
                                            <th data-type="date" data-format="YYYY/DD/MM">Re. Date</th>
                                            <th>View</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>KEG/V/0001</td>
                                            <td>Dilan</td>
                                            <td>dilan@gmail.com</td>
                                            <td>kegalle</td>
                                            <td>012345</td>
                                            <td>2024-2-3</td>
                                            <td class="d-flex align-items-lg-center justify-content-around">
                                                <a href="" class="m-1" data-bs-toggle="modal"
                                                    data-bs-target="#studentView"><i class="fas fa-eye fa-lg"></i></a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>KEG/V/0001</td>
                                            <td>Dilan</td>
                                            <td>dilan@gmail.com</td>
                                            <td>kegalle</td>
                                            <td>012345</td>
                                            <td>2024-2-3</td>
                                            <td class="d-flex align-items-lg-center justify-content-around">
                                                <a href="" class="m-1" data-bs-toggle="modal"
                                                    data-bs-target="#LectureView"><i class="fas fa-eye fa-lg"></i></a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>KEG/V/0003</td>
                                            <td>shehani</td>
                                            <td>shehanis@gmail.com</td>
                                            <td>kegalle</td>
                                            <td>0123454</td>

                                            <td>2024-6-3</td>
                                            <td class="d-flex align-items-lg-center justify-content-around">
                                                <a href="" class=""><i class="fas fa-eye fa-lg"></i></a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>KEG/V/0004</td>
                                            <td>ravindu</td>
                                            <td>ravindu@gmail.com</td>
                                            <td>kegalle</td>
                                            <td>012345</td>

                                            <td>2024-6-3</td>
                                            <td class="d-flex align-items-lg-center justify-content-around">
                                                <a href="" class=""><i class="fas fa-eye fa-lg"></i></a>
                                            </td>
                                        </tr>


                                    </tbody>
                                </table>
                                <!-- End Table with stripped rows -->

                            </div>
                        </div>

                    </div>
                </div>
            </section>

        </main><!-- End #main -->
    </div>
    <!-- data table End -->

    <hr>

    <!-- data lectures table Start -->
    <div class="container-fluid pt-4 px-4">

        <main id="" class="">

            <section class="section">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="card">
                            <div class="card-body table-responsive">
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <h3 class="mb-0">Lectures Datatable</h3>
                                </div>

                                <hr>

                                <!-- Table with stripped rows -->
                                <table class="table datatable text-start align-middle table-bordered table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>Index Number</th>
                                            <th>Lecture Name</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Roles</th>
                                            <th data-type="date" data-format="YYYY/DD/MM">Re. Date</th>
                                            <th>chekout</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>KEG/V/0001</td>
                                            <td>Dilan</td>
                                            <td>dilan@gmail.com</td>
                                            <td>012345</td>
                                            <th>permernat</th>
                                            <td>2024-2-3</td>
                                            <td class="d-flex align-items-lg-center justify-content-around">
                                                <a href="" class="" data-bs-toggle="modal"
                                                    data-bs-target="#LectureView"><i class="fas fa-eye fa-lg"></i></a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>KEG/V/0002</td>
                                            <td>tharuka</td>
                                            <td>tharuka@gmail.com</td>
                                            <td>012345</td>
                                            <th>visiting</th>
                                            <td>2024-6-3</td>
                                            <td class="d-flex align-items-lg-center justify-content-around">
                                                <a href="" class="m-1"><i class="fas fa-eye fa-lg"></i></a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>KEG/V/0003</td>
                                            <td>shehani</td>
                                            <td>shehanis@gmail.com</td>
                                            <td>0123454</td>
                                            <th>visiting</th>
                                            <td>2024-6-3</td>
                                            <td class="d-flex align-items-lg-center justify-content-around">
                                                <a href="" class=""><i class="fas fa-eye fa-lg"></i></a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>KEG/V/0004</td>
                                            <td>ravindu</td>
                                            <td>ravindu@gmail.com</td>
                                            <td>012345</td>
                                            <th>visiting</th>
                                            <td>2024-6-3</td>
                                            <td class="d-flex align-items-lg-center justify-content-around">
                                                <a href="" class=""><i class="fas fa-eye fa-lg"></i></a>
                                            </td>
                                        </tr>


                                    </tbody>
                                </table>
                                <!-- End Table with stripped rows -->

                            </div>
                        </div>

                    </div>
                </div>
            </section>

        </main><!-- End #main -->
    </div>
    <!-- data table End -->





</div>
<!-- Content End -->

<?php include './include/footer.php'; ?>