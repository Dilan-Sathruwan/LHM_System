<?php include './include/header.php'; ?>

<!-- Content Start -->
<div class="content">
    <!-- Navbar Start -->
    <?php include './include/navbar.php'; ?>
    <!-- Navbar End -->

    <!-- Subject Add model Start -->
    <div class="modal fade" id="subModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="BackdropLabel" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="BackdropLabel">Add Subject</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="./include/create_subject.php" class="row g-3 " id="subaForm" method="POST">
                        <input type="hidden" name="subject_id" id="subject_id">
                        <div class="col-12">
                            <label for="subject_name" class="form-label">Subject Name</label>
                            <input type="name" class="form-control" id="subject_name" name="subject_name" required>
                        </div>
                        <div class="col-12">
                            <label for="subject_code" class="form-label">Subject Code</label>
                            <input type="name" class="form-control" id="subject_code" name="subject_number" required>
                        </div>
                        <div class="col-md-6">
                            <label for="credits" class="form-label">Credits</label>
                            <input type="number" class="form-control" id="credits" name="credits" min="0" max="9">
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
                    <button type="submit" form="subaForm" class="btn btn-primary" id="submitButton">Save</button>
                </div>
            </div>
        </div>

    </div>
    <!-- Subject Add model End -->



    <!-- Subject update model Start -->
    <div class="modal fade" id="subUpdateModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="BackdropLabel" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="BackdropLabel">Update Subject</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="./include/create_subject.php" class="row g-3 " id="subuForm" method="POST">
                        <input type="hidden" name="subject_id" id="subject_idu">
                        <div class="col-12">
                            <label for="subject_name" class="form-label">Subject Name</label>
                            <input type="name" class="form-control" id="subject_nameu" name="subject_name" required>
                        </div>
                        <div class="col-12">
                            <label for="subject_code" class="form-label">Subject Code</label>
                            <input type="name" class="form-control" id="subject_codeu" name="subject_number" required>
                        </div>
                        <div class="col-md-6">
                            <label for="credits" class="form-label">Credits</label>
                            <input type="number" class="form-control" id="creditsu" name="credits" min="0" max="9">
                        </div>
                        <div class="col-12">
                            <label for="inputdept" class="form-label">Department</label>
                            <select id="inputdeptu" class="form-select" name="dept">
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
                            <select id="inptsemu" class="form-select" name="semester">

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
                    <button type="submit" form="subuForm" class="btn btn-primary" id="submitButton">Save</button>
                </div>
            </div>
        </div>

    </div>
    <!-- Subject update model End -->


    <!-- data Subject table Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h3 class="mb-0">Higher National Diploma All Subject</h3>
                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#subModal">Add Subject
                </button>
            </div>
            <form method="GET" action="">
                <div class="input-group mb-3 ">
                    <input type="text" class="form-control" name="search" placeholder="Search subjects..." aria-label="Search subjects" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                    <button class="btn btn-outline-secondary btn-primary" type="submit">Find subject</button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">Id</th>
                            <th scope="col">Subject Index</th>
                            <th scope="col">Subject Name</th>
                            <th scope="col">Semester</th>
                            <th scope="col">Credits</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Retrieve the search term from the query parameters
                        $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

                        // Modify the query to join the semester table and add search functionality
                        $query = "
            SELECT s.id, s.subject_number, s.subject_name, s.credits, sem.sem_name AS semester_name 
            FROM subjects s
            JOIN semester sem ON s.semester_id = sem.id
        ";

                        // Add a search condition if a search term is provided
                        if (!empty($searchTerm)) {
                            $query .= " WHERE s.subject_name LIKE :searchTerm OR s.subject_number LIKE :searchTerm";
                        }

                        $stmt = $conn->prepare($query);

                        // Bind the search term if provided
                        if (!empty($searchTerm)) {
                            $searchWildcard = '%' . $searchTerm . '%'; // Add wildcards for partial matches
                            $stmt->bindParam(':searchTerm', $searchWildcard);
                        }

                        $stmt->execute();
                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        if (!empty($result)) {
                            foreach ($result as $row) {
                                echo '<tr>';
                                echo '<td>' . htmlspecialchars($row['id']) . '</td>';
                                echo '<td>' . htmlspecialchars($row['subject_number']) . '</td>';
                                echo '<td>' . htmlspecialchars($row['subject_name']) . '</td>';
                                echo '<td>' . htmlspecialchars($row['semester_name']) . '</td>';
                                echo '<td>' . htmlspecialchars($row['credits']) . '</td>';
                                echo '<td class="d-flex align-items-lg-center justify-content-around">';
                                echo '<a href="#" class="edit-subject me-3" data-bs-toggle="modal" data-bs-target="#subUpdateModal" data-id="' . $row['id'] . '"><i class="fas fa-user-edit fa-lg"></i></a>';
                                echo '<a href="include/delete.php?type=Subject&id=' . $row['id'] . '" class="me-1" onclick="return confirm(\'Are you sure you want to delete this subject?\')"> <i class="fas fa-trash-alt fa-lg"></i> </a>';
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


            <!-- <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-1semester-tab" data-bs-toggle="tab"
                        data-bs-target="#nav-1semester" type="button" role="tab" aria-controls="nav-1semester"
                        aria-selected="true">1 Semester</button>
                    <button class="nav-link" id="nav-2semester-tab" data-bs-toggle="tab" data-bs-target="#nav-2semester"
                        type="button" role="tab" aria-controls="nav-2semester" aria-selected="false">2 Semester</button>
                    <button class="nav-link" id="nav-3semester-tab" data-bs-toggle="tab" data-bs-target="#nav-3semester"
                        type="button" role="tab" aria-controls="nav-3semester" aria-selected="false">3 Semester</button>
                    <button class="nav-link" id="nav-4semester-tab" data-bs-toggle="tab" data-bs-target="#nav-4semester"
                        type="button" role="tab" aria-controls="nav-4semester" aria-selected="false">4 Semester</button>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-1semester" role="tabpanel"
                    aria-labelledby="nav-1semester-tab">
                    
                </div>
                <div class="tab-pane fade" id="nav-2semester" role="tabpanel" aria-labelledby="nav-2semester-tab">
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark">
                                    <th scope="col">Subject Index</th>
                                    <th scope="col">Subject Name</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Enroll Lecture</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>01 Jan 2045</td>
                                    <td>INV-0123</td>
                                    <td>Jhon Doe</td>
                                    <td>$123</td>
                                    <td class="d-flex align-items-lg-center justify-content-around">
                                        <a href="" class=""><i class="fas fa-eye fa-lg"></i></a>
                                        <a href="" class=""><i class="fas fa-user-edit fa-lg"></i></a>
                                        <a href="" class=""><i class="fas fa-trash-alt fa-lg"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>01 Jan 2045</td>
                                    <td>INV-0123</td>
                                    <td>Jhon Doe</td>
                                    <td>$123</td>
                                    <td class="d-flex align-items-lg-center justify-content-around">
                                        <a href="" class=""><i class="fas fa-eye fa-lg"></i></a>
                                        <a href="" class=""><i class="fas fa-user-edit fa-lg"></i></a>
                                        <a href="" class=""><i class="fas fa-trash-alt fa-lg"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>01 Jan 2045</td>
                                    <td>INV-0123</td>
                                    <td>Jhon Doe</td>
                                    <td>$123</td>
                                    <td class="d-flex align-items-lg-center justify-content-around">
                                        <a href="" class=""><i class="fas fa-eye fa-lg"></i></a>
                                        <a href="" class=""><i class="fas fa-user-edit fa-lg"></i></a>
                                        <a href="" class=""><i class="fas fa-trash-alt fa-lg"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>01 Jan 2045</td>
                                    <td>INV-0123</td>
                                    <td>Jhon Doe</td>
                                    <td>$123</td>
                                    <td class="d-flex align-items-lg-center justify-content-around">
                                        <a href="" class=""><i class="fas fa-eye fa-lg"></i></a>
                                        <a href="" class=""><i class="fas fa-user-edit fa-lg"></i></a>
                                        <a href="" class=""><i class="fas fa-trash-alt fa-lg"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>01 Jan 2045</td>
                                    <td>INV-0123</td>
                                    <td>Jhon Doe</td>
                                    <td>$123</td>
                                    <td class="d-flex align-items-lg-center justify-content-around">
                                        <a href="" class=""><i class="fas fa-eye fa-lg"></i></a>
                                        <a href="" class=""><i class="fas fa-user-edit fa-lg"></i></a>
                                        <a href="" class=""><i class="fas fa-trash-alt fa-lg"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-3semester" role="tabpanel" aria-labelledby="nav-3semester-tab">
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark">
                                    <th scope="col">Subject Index</th>
                                    <th scope="col">Subject Name</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Enroll Lecture</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>01 Jan 2045</td>
                                    <td>INV-0123</td>
                                    <td>Jhon Doe</td>
                                    <td>$123</td>
                                    <td class="d-flex align-items-lg-center justify-content-around">
                                        <a href="" class=""><i class="fas fa-eye fa-lg"></i></a>
                                        <a href="" class=""><i class="fas fa-user-edit fa-lg"></i></a>
                                        <a href="" class=""><i class="fas fa-trash-alt fa-lg"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>01 Jan 2045</td>
                                    <td>INV-0123</td>
                                    <td>Jhon Doe</td>
                                    <td>$123</td>
                                    <td class="d-flex align-items-lg-center justify-content-around">
                                        <a href="" class=""><i class="fas fa-eye fa-lg"></i></a>
                                        <a href="" class=""><i class="fas fa-user-edit fa-lg"></i></a>
                                        <a href="" class=""><i class="fas fa-trash-alt fa-lg"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>01 Jan 2045</td>
                                    <td>INV-0123</td>
                                    <td>Jhon Doe</td>
                                    <td>$123</td>
                                    <td class="d-flex align-items-lg-center justify-content-around">
                                        <a href="" class=""><i class="fas fa-eye fa-lg"></i></a>
                                        <a href="" class=""><i class="fas fa-user-edit fa-lg"></i></a>
                                        <a href="" class=""><i class="fas fa-trash-alt fa-lg"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>01 Jan 2045</td>
                                    <td>INV-0123</td>
                                    <td>Jhon Doe</td>
                                    <td>$123</td>
                                    <td class="d-flex align-items-lg-center justify-content-around">
                                        <a href="" class=""><i class="fas fa-eye fa-lg"></i></a>
                                        <a href="" class=""><i class="fas fa-user-edit fa-lg"></i></a>
                                        <a href="" class=""><i class="fas fa-trash-alt fa-lg"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>01 Jan 2045</td>
                                    <td>INV-0123</td>
                                    <td>Jhon Doe</td>
                                    <td>$123</td>
                                    <td class="d-flex align-items-lg-center justify-content-around">
                                        <a href="" class=""><i class="fas fa-eye fa-lg"></i></a>
                                        <a href="" class=""><i class="fas fa-user-edit fa-lg"></i></a>
                                        <a href="" class=""><i class="fas fa-trash-alt fa-lg"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-4semester" role="tabpanel" aria-labelledby="nav-4semester-tab">
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark">
                                    <th scope="col">Subject Index</th>
                                    <th scope="col">Subject Name</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Enroll Lecture</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>01 Jan 2045</td>
                                    <td>INV-0123</td>
                                    <td>Jhon Doe</td>
                                    <td>$123</td>
                                    <td class="d-flex align-items-lg-center justify-content-around">
                                        <a href="" class=""><i class="fas fa-eye fa-lg"></i></a>
                                        <a href="" class=""><i class="fas fa-user-edit fa-lg"></i></a>
                                        <a href="" class=""><i class="fas fa-trash-alt fa-lg"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>01 Jan 2045</td>
                                    <td>INV-0123</td>
                                    <td>Jhon Doe</td>
                                    <td>$123</td>
                                    <td class="d-flex align-items-lg-center justify-content-around">
                                        <a href="" class=""><i class="fas fa-eye fa-lg"></i></a>
                                        <a href="" class=""><i class="fas fa-user-edit fa-lg"></i></a>
                                        <a href="" class=""><i class="fas fa-trash-alt fa-lg"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>01 Jan 2045</td>
                                    <td>INV-0123</td>
                                    <td>Jhon Doe</td>
                                    <td>$123</td>
                                    <td class="d-flex align-items-lg-center justify-content-around">
                                        <a href="" class=""><i class="fas fa-eye fa-lg"></i></a>
                                        <a href="" class=""><i class="fas fa-user-edit fa-lg"></i></a>
                                        <a href="" class=""><i class="fas fa-trash-alt fa-lg"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>01 Jan 2045</td>
                                    <td>INV-0123</td>
                                    <td>Jhon Doe</td>
                                    <td>$123</td>
                                    <td class="d-flex align-items-lg-center justify-content-around">
                                        <a href="" class=""><i class="fas fa-eye fa-lg"></i></a>
                                        <a href="" class=""><i class="fas fa-user-edit fa-lg"></i></a>
                                        <a href="" class=""><i class="fas fa-trash-alt fa-lg"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>01 Jan 2045</td>
                                    <td>INV-0123</td>
                                    <td>Jhon Doe</td>
                                    <td>$123</td>
                                    <td class="d-flex align-items-lg-center justify-content-around">
                                        <a href="" class=""><i class="fas fa-eye fa-lg"></i></a>
                                        <a href="" class=""><i class="fas fa-user-edit fa-lg"></i></a>
                                        <a href="" class=""><i class="fas fa-trash-alt fa-lg"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> -->


            <script>
                //################## batch model form fill current Id number ######################
                document.querySelectorAll('.edit-subject').forEach(function(editButton) {
                    editButton.addEventListener('click', function() {
                        var subId = this.getAttribute('data-id');

                        // Fetch batch details via AJAX using XMLHttpRequest
                        var xhr = new XMLHttpRequest();
                        xhr.open('GET', 'include/get_subjects.php?id=' + subId, true);
                        xhr.responseType = 'json';

                        xhr.onload = function() {
                            if (xhr.status === 200) {
                                var data = xhr.response;
                                // Populate form with batch data
                                document.getElementById('subject_idu').value = data.id;
                                document.getElementById('subject_nameu').value = data.subject_name;
                                document.getElementById('subject_codeu').value = data.subject_number;
                                document.getElementById('creditsu').value = data.credits;

                                // Populate department select options
                                var deptSelect = document.getElementById('inputdeptu');
                                deptSelect.innerHTML = '';
                                data.departments.forEach(function(dept) {
                                    var selected = dept.id == data.department_id ? 'selected' : '';
                                    deptSelect.innerHTML += `<option value="${dept.id}" ${selected}>${dept.department_name}</option>`;
                                });

                                // Populate semester select options
                                var semesterSelect = document.getElementById('inptsemu');
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


    </div>
    <!-- data Subject table End -->

</div>
<!-- Content End -->

<?php include './include/footer.php'; ?>