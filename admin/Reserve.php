<?php include './include/header.php'; ?>

<!-- Content Start -->
<div class="content">
    <!-- Navbar Start -->
    <?php include './include/navbar.php'; ?>
    <!-- Navbar End -->



    <!-- Modal Lecture booking Model-->
    <div class="modal fade" id="EditbatchModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="BackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-color-fram">
                    <h1 class="modal-title fs-5" id="BackdropLabel">Enroll Lectures booking</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="./include/create_lecture.php" class="row g-3 " id="EbatchForm" method="POST">
                        <input type="hidden" name="id" id="eid">


                        <div class="col-12">
                            <label for="inputlec" class="form-label">Lecturers</label>
                            <select id="einputlec" class="form-select" name="lecturers" disabled>
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
                            <select id="einpthall" class="form-select" name="lecture_halls" disabled>
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
                            <select id="edays" class="form-select" name="days" disabled>
                                <option value="">Select Days </option>
                                <option value="Monday">Monday </option>
                                <option value="Tuesday">Tuesday</option>
                                <option value="Wednesday">Wednesday</option>
                                <option value="Thursday">Thursday </option>
                                <option value="Friday">Friday </option>

                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="time_slot" class="form-label">Time</label>
                            <select id="einputtime" class="form-select" name="time_slot" disabled>
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
                    <button type="submit" form="EbatchForm" class="btn btn-primary" id="submitButton">Add Shedules</button>
                </div>
            </div>
        </div>

        <!-- disable input befor submitiing form-->
        <script>
            document.getElementById('EbatchForm').addEventListener('submit', function() {
                const inputs = document.querySelectorAll('#EbatchForm select:disabled');
                inputs.forEach(input => input.disabled = false);
            });
        </script>

    </div>
    <!-- Modal Lecture Booking Model-->



    <!-- Blank Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-3 mb-2">
            <div class="d-flex align-items-center justify-content-start mb-1">
                <a class="btn  btn-primary" href="timetable_lecture.php">Lecture Timetables</a>
                <a class="btn  btn-primary ms-4" href="timetable_batch.php">Batch Timetables</a>
                <a class="btn  btn-primary ms-4" href="timetable_hall.php">Hall Timetables</a>
            </div>

        </div>

        <div class="bg-light text-center rounded p-4 mt-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h3 class="mb-0">Booking Lecturers</h3>
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

                        $stmt = $conn->query("SELECT ls.id, 
                                      l.username AS lecturer_name, 
                                      d.department_name, 
                                      b.batch_name, 
                                      s.subject_number AS subject_num, 
                                      lh.hall_name, 
                                      ls.days, 
                                      ts.start_time, ts.end_time 
                               FROM lecture_book ls 
                               JOIN lecturers l ON ls.lecturer_id = l.id 
                               JOIN departments d ON ls.department_id = d.id 
                               JOIN batches b ON ls.batch_id = b.id 
                               JOIN subjects s ON ls.subject_id = s.id 
                               JOIN lecture_halls lh ON ls.hall_id = lh.id 
                               JOIN timeslot ts ON ls.slot_id = ts.slot_id");

                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
                                echo '<a href="#" class="edit-lecture ms-4" data-id="' . $row['id'] . '" data-bs-toggle="modal" data-bs-target="#EditbatchModal"><i class="fa fa-plus-circle fa-lg""></i></a>';
                                echo '<a href="include/delete.php?type=Reserve&id=' . $row['id'] . '" class="ms-4 me-3"><i class="fas fa-trash-alt fa-lg" onclick="return confirm(\'Are you sure you want to delete this booking?\')"></i></a>';
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
                    xhr.open('GET', 'include/get_booking.php?id=' + lectureId, true);
                    xhr.responseType = 'json';
                    xhr.onload = function() {
                        if (xhr.status === 200) {

                            var data = xhr.response;
                            if (data) {
                                // Populate form with lecture data
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