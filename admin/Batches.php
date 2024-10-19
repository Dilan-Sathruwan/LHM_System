<?php include './include/header.php'; ?>

<!-- Content Start -->
<div class="content">
    <!-- Navbar Start -->
    <?php include './include/navbar.php'; ?>
    <!-- Navbar End -->

    <div>
        <!-- Modal -->
        <div class="modal fade" id="batchModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="BackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="BackdropLabel">Add / Update Batch</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="./include/create_batch.php" class="row g-3 " id="batchForm" method="POST">
                            <input type="hidden" name="batch_id" id="batch_id">
                            <div class="col-12">
                                <label for="batch_name" class="form-label">Batch Name</label>
                                <input type="name" class="form-control" id="batch_name" name="batch_name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="batch_year" class="form-label">Batch Year</label>
                                <input type="number" class="form-control" id="batch_year" name="batch_year" min="1" max="9999999999">
                            </div>
                            <div class="col-12">
                                <label for="inputdept" class="form-label">Department</label>
                                <select id="inputdept" class="form-select" name="dept">
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
                                <label for="inptsem" class="form-label">Semester</label>
                                <select id="inptsem" class="form-select" name="semester">
                                    
                                    <?php
                                    $stmt = $conn->query("SELECT id, sem_name FROM semester");
                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        echo "<option value='" . $row['id'] . "'>" . $row['sem_name'] . "</option>";
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
    </div>


    <!-- data Batches table Start -->
    <div class="container-fluid pt-4 px-4">

        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h3 class="mb-0">batches</h3>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#batchModal">Create Batch
                </button>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">Id</th>
                            <th scope="col">Batch year</th>
                            <th scope="col">Batch Name</th>
                            <th scope="col">department_name</th>
                            <th scope="col">Semester_name</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $stmt = $conn->query("SELECT b.id, b.batch_year, b.batch_name, d.department_name, s.sem_name FROM batches b LEFT JOIN departments d ON b.department_id = d.id INNER JOIN semester s ON b.semester_id = s.id;");
                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($result as $row) {
                            echo '<tr>';
                            echo '<td>' . htmlspecialchars($row['id']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['batch_year']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['batch_name']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['department_name']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['sem_name']) . '</td>';
                            echo '<td class="d-flex align-items-lg-center justify-content-around">';
                            echo '<a href="#" class="edit-batch" data-bs-toggle="modal" data-bs-target="#batchModal" data-id="' . $row['id'] . '"><i class="fas fa-user-edit fa-lg"></i></a>';
                            echo '<a href="include/delete.php?type=batches&id=' . $row['id'] . '" class="m-1" onclick="return confirm(\'Are you sure you want to delete this batch?\')"> <i class="fas fa-trash-alt fa-lg"></i> </a>';
                            echo '</td>';
                            echo '</tr>';
                        }

                        ?>

                    </tbody>
                </table>
            </div>
        </div>

        <script>

            //################## batch model form fill current Id number ######################
            document.querySelectorAll('.edit-batch').forEach(function(editButton) {
                editButton.addEventListener('click', function() {
                    var batchId = this.getAttribute('data-id');

                    // Fetch batch details via AJAX using XMLHttpRequest
                    var xhr = new XMLHttpRequest();
                    xhr.open('GET', 'include/get_batches.php?id=' + batchId, true);
                    xhr.responseType = 'json';

                    xhr.onload = function() {
                        if (xhr.status === 200) {
                            var data = xhr.response;
                            // Populate form with batch data
                            document.getElementById('batch_id').value = data.id;
                            document.getElementById('batch_name').value = data.batch_name;
                            document.getElementById('batch_year').value = data.batch_year;

                            // Populate department select options
                            var deptSelect = document.getElementById('inputdept');
                            deptSelect.innerHTML = '';
                            data.departments.forEach(function(dept) {
                                var selected = dept.id == data.department_id ? 'selected' : '';
                                deptSelect.innerHTML += `<option value="${dept.id}" ${selected}>${dept.department_name}</option>`;
                            });

                            // Populate semester select options
                            var semesterSelect = document.getElementById('inptsem');
                            semesterSelect.innerHTML = '';
                            data.semesters.forEach(function(sem) {
                                var selected = sem.id == data.semester_id ? 'selected' : '';
                                semesterSelect.innerHTML += `<option value="${sem.id}" ${selected}>${sem.sem_name}</option>`;
                            });
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
    <!-- data Batches table End -->
</div>
<!-- Content End -->

<?php include './include/footer.php'; ?>