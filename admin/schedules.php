<?php include './include/header.php'; ?>

<!-- Content Start -->
<div class="content">
    <!-- Navbar Start -->
    <?php include './include/navbar.php'; ?>
    <!-- Navbar End -->


    <!-- Modal -->
    <div class="modal fade" id="batchModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="BackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="BackdropLabel">Add Lecture</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="./include/create_lecture.php" class="row g-3 " id="batchForm" method="POST">
                        <input type="hidden" name="id" id="id">


                        <div class="col-12">
                            <label for="inputlec" class="form-label">Lecturers</label>
                            <select id="inputlec" class="form-select" name="lecturers">
                                <option selected>Select lecturers</option>
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
                                <option selected>Choose...</option>
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
                                <option value="">Select Subject</option>
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
            xhr.open("GET", 'get_batches.php?department_id=' + departmentId, true);
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
            xhr.open("GET", 'get_subject.php?department_id=' + selectedDepartmentId + '&batch_id=' + selectedBatchId, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    document.getElementById("inputsub").innerHTML = xhr.responseText;
                }
            };
            xhr.send();
        }
    </script>



    <!-- Blank Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-start mb-4">
                <h2>Generate your Timetable</h2>
            </div>
            <div class="d-flex align-items-center justify-content-start mb-4">
                <a class="btn btn-lg btn-primary ms-4" href="./check_batch.php">Lecture Timetable</a>
                <a class="btn btn-lg btn-primary ms-4" href="">Batch Timetable</a>
                <a class="btn btn-lg btn-primary ms-4" href="">Hall Timetable</a>
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
                        $stmt = $conn->query("SELECT id, lecturer_id, hall_id, department_id, batch_id, subject_id, slot_id, days FROM lecture_schedule");
                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        if (!empty($result)) {
                            foreach ($result as $row) {
                                echo '<tr>';
                                echo '<td>' . htmlspecialchars($row['id']) . '</td>';
                                echo '<td>' . htmlspecialchars($row['lecturer_id']) . '</td>';
                                echo '<td>' . htmlspecialchars($row['department_id']) . '</td>';
                                echo '<td>' . htmlspecialchars($row['batch_id']) . '</td>';
                                echo '<td>' . htmlspecialchars($row['subject_id']) . '</td>';
                                echo '<td>' . htmlspecialchars($row['hall_id']) . '</td>';
                                echo '<td>' . htmlspecialchars($row['days']) . '</td>';
                                echo '<td>' . htmlspecialchars($row['slot_id']) . '</td>';
                                echo '<td class="d-flex align-items-lg-center justify-content-around">';
                                echo '<a href="" class=""><i class="fas fa-user-edit fa-lg"></i></a>';
                                echo '<a href="" class=""><i class="fas fa-trash-alt fa-lg"></i></a>';
                                echo '</td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="5">No results found</td></tr>';
                        }

                        ?>

                    </tbody>
                </table>
            </div>
        </div>


    </div>

    <!-- Blank End -->


    <!-- Content End -->

    <?php include './include/footer.php'; ?>