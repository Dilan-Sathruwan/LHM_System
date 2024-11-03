<?php include './include/header.php'; ?>

<!-- Content Start -->
<div class="content">
    <!-- Navbar Start -->
    <?php include './include/navbar.php'; ?>
    <!-- Navbar End -->




    <!-- student Add /Edit Modal -->
    <div class="modal fade" id="studentcreate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Create Student profile</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- type here -->

                    <div class="container">
                        <div class="row">
                            <div class="justify-content-md-center">


                                <div class="card my-1">

                                    <form action="./include/create_student.php" method="POST" id="myFormS" class="card-body cardbody-color p-lg-2" enctype="multipart/form-data">

                                        <div class="row g-3">

                                            <input type="hidden" name="id" id="student_id">


                                            <div class="text-center">
                                                <img src="./include/uploads/pngwing.com.png"
                                                    class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3"
                                                    width="200px" alt="profile">
                                            </div>
                                            <div class="col-12">
                                                <input type="file" name="profile_image" class="form-control" id="image_path">
                                            </div>

                                            <div class="col-sm-6">
                                                <label for="Index_num" class="form-label">Student Index Number</label>
                                                <input type="text" name="Index_num" class="form-control" id="Index_Num" required>
                                            </div>

                                            <div class="col-12">
                                                <label for="Student_name" class="form-label">Student Name</label>
                                                <div class="input-group has-validation">
                                                    <input type="text" class="form-control" id="Student_name"
                                                        placeholder="Student name" name="Student_name" required>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <label for="email" class="form-label">Email </label>
                                                <input type="email" class="form-control" id="email" name="email">
                                                <div class="invalid-feedback">
                                                    Please enter a valid email address.
                                                </div>
                                            </div>


                                            <div class="col-sm-6">
                                                <label for="Mobile_num" class="form-label">Mobile Number</label>
                                                <input type="number" class="form-control" id="Mobile_num" name="Mobile_num">
                                            </div>

                                            <div class="col-12">
                                                <label for="address" class="form-label">Address</label>
                                                <input type="text" class="form-control" id="address" name="address"
                                                    placeholder="1234, Main St,kegalle" required>
                                            </div>

                                            <div class="col-12">
                                                <label for="department" class="form-label">Department Name</label>
                                                <select class="form-select" name="department_id" id="department_id" onchange="fetchSemesters(this.value)" required>
                                                    <option value="">Check your department</option>
                                                    <?php
                                                    // Fetch Departments
                                                    $stmt = $conn->query("SELECT id, department_name FROM departments");
                                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                        echo "<option value='" . $row['id'] . "'>" . $row['department_name'] . "</option>";
                                                    }
                                                    ?>

                                                </select>
                                            </div>


                                            <div class="col-sm-6">
                                                <label for="batch_id" class="form-label">Select Batch</label>
                                                <select class="form-select" name="batch_id" id="batch_id" required>
                                                    <option value="">Add your department</option>
                                                    <?php
                                                    // Fetch Departments
                                                    $stmt = $conn->query("SELECT id, batch_name FROM batches");
                                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                        echo "<option value='" . $row['id'] . "'>" . $row['batch_name'] . "</option>";
                                                    }
                                                    ?>

                                                </select>
                                            </div>

                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="myFormS" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <!-- student Add/Edit Modal end -->

    <script>
        function fetchSemesters(departmentId) {
            if (departmentId === "") {
                document.getElementById("batch_id").innerHTML = "<option value=''>Add Your Department</option>";
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
    </script>








<!-- Student View Modal start -->
<div class="modal fade" id="studentView" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">View Student Profile</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="justify-content-md-center">
                            <div class="card my-3">

                                <form id="myForm1" class="card-body cardbody-color p-lg-2">
                                    <div class="row g-3">
                                        <!-- Profile Image -->
                                        <div class="text-center">
                                            <img src="https://cdn.pixabay.com/photo/2016/03/31/19/56/avatar-1295397__340.png"
                                                 class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3"
                                                 width="200px" alt="profile" id="view-student-profile-image">
                                        </div>

                                        <!-- Student ID (Hidden Field) -->
                                        <input type="hidden" id="view-student_id">

                                        <!-- Student Index Number -->
                                        <div class="col-sm-6">
                                            <label for="Index_Num" class="form-label">Student Index Number</label>
                                            <input type="text" class="form-control" id="view-Index_Num" readonly>
                                        </div>

                                        <!-- Student Name -->
                                        <div class="col-12">
                                            <label for="Student_name" class="form-label">Student Name</label>
                                            <input type="text" class="form-control" id="view-Student_name" readonly>
                                        </div>

                                        <!-- Email -->
                                        <div class="col-sm-6">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="view-email" readonly>
                                        </div>

                                        <!-- Mobile Number -->
                                        <div class="col-sm-6">
                                            <label for="Mobile_num" class="form-label">Mobile Number</label>
                                            <input type="number" class="form-control" id="view-Mobile_num" readonly>
                                        </div>

                                        <!-- Address -->
                                        <div class="col-12">
                                            <label for="address" class="form-label">Address</label>
                                            <input type="text" class="form-control" id="view-address" readonly>
                                        </div>

                                        <!-- Department -->
                                        <div class="col-12">
                                            <label for="department_id" class="form-label">Department</label>
                                            <select class="form-select" id="view-department_id" disabled readonly>
                                            <option value="">No Department</option>
                                                    <?php
                                                    $stmt = $conn->query("SELECT id, department_name FROM departments");
                                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                        echo "<option value='" . $row['id'] . "'>" . $row['department_name'] . "</option>";
                                                    }
                                                    ?>
                                            </select>
                                        </div>

                                        <!-- Batch -->
                                        <div class="col-sm-6">
                                            <label for="batch_id" class="form-label">Batch</label>
                                            <select class="form-select" id="view-batch_id" disabled readonly>
                                            <option value="">No Batch</option>
                                                    <?php
                                                    $stmt = $conn->query("SELECT id, batch_name FROM batches");
                                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                        echo "<option value='" . $row['id'] . "'>" . $row['batch_name'] . "</option>";
                                                    }
                                                    ?>
                                            </select>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="printForm('myForm1')"><i class="bi bi-printer"></i> Print</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

    <!-- students view Modal end -->


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
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#studentcreate">
                                        Add Student
                                    </button>

                                </div>

                                <hr>



                                <!-- Search Input Above the Table -->
                                <div class="mb-3">
                                    <input type="search" placeholder="Search student name.." id="search_student" class="form-control" />
                                </div>
                                <!-- Table with stripped rows -->
                                <table class="table text-start align-middle table-bordered table-hover mb-0">
                                    <thead>
                                        <tr>

                                            <th>Index Number</th>
                                            <th>Student Name</th>
                                            <th>Student Email</th>
                                            <th>Mobile Number</th>
                                            <th>Semester year</th>
                                            <th>Re. Date</th>
                                            <th>chekout</th>
                                        </tr>
                                    </thead>
                                    <tbody id="output"></tbody>

                                </table>
                                <script>
                                    const searchInput = document.getElementById("search_student");
                                    const outputEl = document.getElementById("output");


                                    function fetchStudents(query = "") {
                                        const xhr = new XMLHttpRequest();
                                        xhr.open("GET", `./include/search_student.php?query=${query}`, true);

                                        xhr.onload = function() {
                                            if (xhr.status === 200) {
                                                const data = JSON.parse(xhr.responseText);
                                                outputEl.innerHTML = ""; // Clear previous output

                                                // Check if any results were returned
                                                if (data.length > 0) {
                                                    data.forEach((student) => {
                                                        const row = `
                            <tr>
                                <td>${student.index_number}</td>
                                <td>${student.username}</td>
                                <td>${student.email}</td>
                                <td>${student.mobile_num || "N/A"}</td>
                                <td>${student.batch_name}</td>
                                <td>${student.enrollment_date}</td>
                                <td class="d-flex justify-content-center">
                                    <a href="#" class="m-1" data-bs-toggle="modal" data-bs-target="#studentView"
                                        data-id="${student.id}"
                                        data-index_number="${student.index_number}" 
                                        data-username="${student.username}" 
                                        data-email="${student.email}" 
                                        data-mobile_num="${student.mobile_num}" 
                                        data-batch_id="${student.batch_id}" 
                                        data-address="${student.address}" 
                                        data-department_id="${student.department_id}" 
                                        data-re_date="${student.enrollment_date}"
                                        data-image_path="${student.image_path}">
                                        <i class="fas fa-eye fa-lg"></i>
                                    </a>
                                    <a href="#" class="m-1" data-bs-toggle="modal" data-bs-target="#studentcreate"
                                        data-id="${student.id}"
                                        data-index_number="${student.index_number}" 
                                        data-username="${student.username}" 
                                        data-email="${student.email}" 
                                        data-mobile_num="${student.mobile_num}" 
                                        data-batch_id="${student.batch_id}" 
                                        data-address="${student.address}" 
                                        data-department_id="${student.department_id}" 
                                        data-re_date="${student.enrollment_date}"
                                        data-image_path="${student.image_path}">
                                        <i class="fas fa-user-edit fa-lg"></i>
                                    </a>
                                    <a href="include/delete.php?type=student&id=${student.id}" 
                                        class="m-1" onclick="return confirm('Are you sure you want to delete this student?')">
                                        <i class="fas fa-trash-alt fa-lg"></i>
                                    </a>
                                </td>
                            </tr>`;
                                                        outputEl.innerHTML += row;
                                                    });
                                                } else {
                                                    outputEl.innerHTML = `<tr><td colspan="8" class="text-center">No results found</td></tr>`;
                                                }
                                            }
                                        };
                                        xhr.send();
                                    }

                                    // Event listener for search input
                                    searchInput.addEventListener("keyup", (e) => fetchStudents(e.target.value));

                                    // Initial fetch to display all lectures
                                    document.addEventListener("DOMContentLoaded", () => fetchStudents("init"));
                                </script>


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