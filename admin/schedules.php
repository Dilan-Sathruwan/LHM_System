<?php include './include/header.php'; ?>

<!-- Content Start -->
<div class="content">
    <!-- Navbar Start -->
    <?php include './include/navbar.php'; ?>
    <!-- Navbar End -->


    <!-- Modal Lecture Add-->
    <div class="modal fade" id="batchModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="BackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-color-fram">
                    <h1 class="modal-title fs-5" id="BackdropLabel">Add Lecture</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="./include/create_lecture.php" class="row g-3 " id="batchForm" method="POST">
                        <input type="hidden" name="id" id="id">


                        <div class="col-12">
                            <label for="inputlec" class="form-label">Lecturers</label>
                            <select id="inputlec" class="form-select" name="lecturers" required>
                                <option selected value="">Select lecturers</option>
                                <?php
                                $stmt = $conn->query("SELECT id, username FROM lecturers");
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<option value='" . $row['id'] . "'>" . $row['username'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="inputdept" class="form-label">Department</label>
                            <select id="inputdept" class="form-select" name="dept" onchange="fetchSemesters(this.value)" required>
                                <option selected value="">Choose...</option>
                                <?php
                                $stmt = $conn->query("SELECT id, department_name FROM departments");
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<option value='" . $row['id'] . "'>" . $row['department_name'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="batch_id" class="form-label">Batch</label>
                            <select id="batch_id" class="form-select" name="batches" onchange="fetchSubjects()" required>
                                <option value="" selected>Choose...</option>
                                <?php
                                $stmt = $conn->query("SELECT id, batch_name FROM batches");
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<option value='" . $row['id'] . "'>" . $row['batch_name'] . "</option>";
                                }
                                ?>
                                <!-- Batches will be loaded dynamically -->
                            </select>
                        </div>

                        <div class="col-12">
                            <label for="inputsub" class="form-label">Subject</label>
                            <select id="inputsub" class="form-select" name="subjects" required>
                                <option selected value="">Select Subject</option>
                                <!-- Subjects will be loaded dynamically -->
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="inpthall" class="form-label">Hall</label>
                            <select id="inpthall" class="form-select" name="lecture_halls">
                                <option value="">Select Lecture Hall</option>
                                <?php
                                $stmt = $conn->query("SELECT id, hall_name FROM lecture_halls");
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<option value='" . $row['id'] . "'>" . $row['hall_name'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="days" class="form-label">Days</label>
                            <select id="days" class="form-select" name="days">
                                <option value="">Select Days </option>
                                <option value="Monday">Monday </option>
                                <option value="Tuesday">Tuesday</option>
                                <option value="Wednesday">Wednesday</option>
                                <option value="Thursday">Thursday </option>
                                <option value="Friday">Friday </option>

                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="time_slot" class="form-label">Batch Year</label>
                            <select id="inputtime" class="form-select" name="time_slot">
                                <option selected>Add your time</option>
                                <?php
                                $stmt = $conn->query("SELECT slot_id, start_time, end_time FROM timeslot");
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<option value='" . $row['slot_id'] . "'>" . $row['start_time'] . "-" . $row['end_time'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="batchForm" class="btn btn-primary" id="submitButton">Save</button>
                </div>
            </div>
        </div>

    </div>
    <!-- Modal Lecture Add-->
    <script>
        var selectedDepartmentId = null;
        var selectedBatchId = null;

        function fetchSemesters(departmentId) {
            selectedDepartmentId = departmentId;

            // Reset batch and subject dropdowns when department is changed
            document.getElementById("batch_id").innerHTML = "<option selected>Choose...</option>";
            document.getElementById("inputsub").innerHTML = "<option selected>Select Subject</option>";
            if (departmentId === "") {
                return;
            }

            // Create AJAX request
            var xhr = new XMLHttpRequest();
            xhr.open("GET", 'include/get_batches.php?department_id=' + departmentId, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    document.getElementById("batch_id").innerHTML = xhr.responseText;
                }
            };
            xhr.send();
        }



        function fetchSubjects() {
            selectedBatchId = document.getElementById('batch_id').value;

            // Reset subject dropdown when batch is changed
            document.getElementById("inputsub").innerHTML = "<option selected>Select Subject</option>";
            if (selectedBatchId === "" || selectedDepartmentId === "") {
                return;
            }

            // Create AJAX request to fetch subjects based on department and batch (semester)
            var xhr = new XMLHttpRequest();
            xhr.open("GET", 'include/get_semsubject.php?department_id=' + selectedDepartmentId + '&batch_id=' + selectedBatchId, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    document.getElementById("inputsub").innerHTML = xhr.responseText;
                }
            };
            xhr.send();
        }
    </script>




    <!-- Modal Lecture Edit-->
    <div class="modal fade" id="EditbatchModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="BackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-color-fram">
                    <h1 class="modal-title fs-5" id="BackdropLabel">Change Lecture</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="./include/create_lecture.php" class="row g-3 " id="EbatchForm" method="POST">
                        <input type="hidden" name="id" id="eid">


                        <div class="col-12">
                            <label for="inputlec" class="form-label">Lecturers</label>
                            <select id="einputlec" class="form-select" name="lecturers" required>
                                <option selected value="">Select lecturers</option>
                                <?php
                                $stmt = $conn->query("SELECT id, username FROM lecturers");
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<option value='" . $row['id'] . "'>" . $row['username'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="inputdept" class="form-label">Department</label>
                            <select id="einputdept" class="form-select" name="dept" onchange="fetchSemesters(this.value)" disabled>
                                <option selected value="">Choose...</option>
                                <?php
                                $stmt = $conn->query("SELECT id, department_name FROM departments");
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<option value='" . $row['id'] . "'>" . $row['department_name'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="batch_id" class="form-label">Batch</label>
                            <select id="ebatch_id" class="form-select" name="batches" onchange="fetchSubjects()" disabled>
                                <option value="" selected>No select batch</option>
                                <?php
                                $stmt = $conn->query("SELECT id, batch_name FROM batches");
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<option value='" . $row['id'] . "'>" . $row['batch_name'] . "</option>";
                                }
                                ?>
                                <!-- Batches will be loaded dynamically -->
                            </select>
                        </div>

                        <div class="col-12">
                            <label for="inputsub" class="form-label">Subject</label>
                            <select id="einputsub" class="form-select" name="subjects" disabled>
                                <option selected value="">Select Subject</option>
                                <?php
                                $stmt = $conn->query("SELECT id, subject_name FROM subjects");
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<option value='" . $row['id'] . "'>" . $row['subject_name'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="inpthall" class="form-label">Hall</label>
                            <select id="einpthall" class="form-select" name="lecture_halls">
                                <option value="">Select Lecture Hall</option>
                                <?php
                                $stmt = $conn->query("SELECT id, hall_name FROM lecture_halls");
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<option value='" . $row['id'] . "'>" . $row['hall_name'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="days" class="form-label">Days</label>
                            <select id="edays" class="form-select" name="days">
                                <option value="">Select Days </option>
                                <option value="Monday">Monday </option>
                                <option value="Tuesday">Tuesday</option>
                                <option value="Wednesday">Wednesday</option>
                                <option value="Thursday">Thursday </option>
                                <option value="Friday">Friday </option>

                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="time_slot" class="form-label">Batch Year</label>
                            <select id="einputtime" class="form-select" name="time_slot">
                                <option selected>Add your time</option>
                                <?php
                                $stmt = $conn->query("SELECT slot_id, start_time, end_time FROM timeslot");
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<option value='" . $row['slot_id'] . "'>" . $row['start_time'] . "-" . $row['end_time'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="EbatchForm" class="btn btn-primary" id="submitButton">Save</button>
                </div>
            </div>
        </div>

    </div>
    <!-- Modal Lecture Edit-->



    <!-- Blank Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-3 mb-2">
            <div class="d-flex align-items-center justify-content-start mb-1">
                <a class="btn  btn-primary" href="timetable_lecture.php">Lecture Timetables</a>
                <a class="btn  btn-primary ms-4" href="timetable_batch.php">Batch Timetables</a>
                <a class="btn  btn-primary ms-4" href="timetable_hall.php">Hall Timetables</a>
            </div>

        </div>

        <div class="bg-light text-center rounded p-4">
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

        <div class="bg-light text-center rounded p-4 mt-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h3 class="mb-0">All Avalible Lecturers</h3>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#batchModal">Add Lecturers</button>
            </div>
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
                            <th scope="col">Action</th>
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
                                echo '<td class="d-flex align-items-lg-center justify-content-around">';
                                echo '<a href="#" class="edit-lecture ms-4" data-id="' . $row['id'] . '" data-bs-toggle="modal" data-bs-target="#EditbatchModal"><i class="fas fa-user-edit fa-lg"></i></a>';
                                echo '<a href="" class="ms-4 me-3"><i class="fas fa-trash-alt fa-lg"></i></a>';
                                echo '</td>';
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

        <script>
            document.querySelectorAll('.edit-lecture').forEach(function(editButton) {
                editButton.addEventListener('click', function() {
                    var lectureId = this.getAttribute('data-id');

                    // Fetch lecture details via AJAX
                    var xhr = new XMLHttpRequest();
                    xhr.open('GET', 'include/get_lecture.php?id=' + lectureId, true);
                    xhr.responseType = 'json';
                    xhr.onload = function() {
                        if (xhr.status === 200) {
                            
                            var data = xhr.response;
                            if (data) {
                                // Populate form with lecture data
                                document.getElementById('eid').value = data.id;
                                document.getElementById('einputlec').value = data.lecturer_id;
                                document.getElementById('einputdept').value = data.department_id;
                                document.getElementById('ebatch_id').value = data.batch_id;
                                document.getElementById('einputsub').value = data.subject_id;
                                document.getElementById('einpthall').value = data.hall_id;
                                document.getElementById('edays').value = data.days;
                                document.getElementById('einputtime').value = data.time_slot;
                            } else {
                                console.error('Data is null or undefined');
                            }
                        } else {
                            console.error('Error:', xhr.statusText);
                        }
                    };


                    xhr.onerror = function() {
                        console.error('Request error...');
                    };

                    xhr.send();
                });
            });
        </script>


    </div>

    <!-- Blank End -->


    <!-- Content End -->

    <?php include './include/footer.php'; ?>