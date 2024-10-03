<?php include './include/header.php'; ?>

<!-- Content Start -->
<div class="content">
    <!-- Navbar Start -->
    <?php include './include/navbar.php'; ?>
    <!-- Navbar End -->

    <div id="messagePopup" class="alert alert-success message-popup">
        <i class="bi bi-check-square-fill">&nbsp;</i>
        <span id="messageText"></span>
    </div>

    <!-- Lecture Add /Edit Modal -->
    <div class="modal fade" id="Lecturecreate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1 "
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg ">
            <div class="modal-content bg-colors2">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Create Lecture profile</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">
                    <!-- type here -->

                    <div class="container ">
                        <div class="row ">
                            <div class="justify-content-md-center ">


                                <div class="card my-1 bg-transparent">

                                    <form action="./include/student_create.php" id="myForm" method="POST"
                                        class="card-body cardbody-color p-lg-2">

                                        <div class="row g-3">

                                            <input type="number" name="id" id="lecturer-id">

                                            <div class="text-center">
                                                <img src="https://cdn.pixabay.com/photo/2016/03/31/19/56/avatar-1295397__340.png"
                                                    class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3"
                                                    width="200px" alt="profile">
                                            </div>

                                            <div class="col-sm-6">
                                                <label for="Index_num" class="form-label">Lecture Index Number</label>
                                                <input type="text" class="form-control" id="Index_num" placeholder=""
                                                    name="Index_num" required>
                                                <div class="invalid-feedback">
                                                    Valid Lecture name is required.
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <label for="inputPassword" class="form-label">Password</label>
                                                <input type="password" class="form-control" id="inputPassword"
                                                    name="password">
                                                <div class="invalid-feedback">
                                                    Valid password is required.
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <label for="username" class="form-label">Username</label>
                                                <div class="input-group has-validation">
                                                    <input type="text" class="form-control" id="username"
                                                        name="username" placeholder="Username" required>
                                                    <div class="invalid-feedback">
                                                        Your username is required.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <label for="email" class="form-label">Email </label>
                                                <input type="email" class="form-control" id="email" name="email"
                                                    placeholder="you@example.com">
                                                <div class="invalid-feedback">
                                                    Please enter a valid email address.
                                                </div>
                                            </div>


                                            <div class="col-sm-6">
                                                <label for="phonenumber" class="form-label">Mobile Number</label>
                                                <input type="number" class="form-control" id="phonenumber"
                                                    name="phonenumber">
                                                <div class="invalid-feedback">
                                                    Valid Mobile Number is required.
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <label for="address" class="form-label">Address</label>
                                                <input type="text" class="form-control" id="address" name="address"
                                                    placeholder="1234, Main St,kegalle" required>
                                                <div class="invalid-feedback">
                                                    Please enter your address.
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <label for="Lecturerole" class="form-label">Lecture Roles</label>
                                                <select class="form-select" id="lecturerole" name="lecturerole"
                                                    required>
                                                    <option></option>
                                                    <option value="Visiting">Visiting Lecture</option>
                                                    <option value="Permernet">Permernet Lecture</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select a valid Roles.
                                                </div>
                                            </div>


                                            <div class="mb-3">
                                                <label for="about" class="form-label">About
                                                    Lecture</label>
                                                <textarea class="form-control" id="about"
                                                    name="about" rows="3"></textarea>
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
                    <button type="submit" form="myForm" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Lecture Add/Edit Modal end -->





    <!-- Lecture view Modal model start-->
    <div class="modal fade" id="LectureView" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Create Lecture profile</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- type here -->

                    <div class="container bg-primary">
                        <div class="row ">
                            <div class="justify-content-md-center ">
                                <div class="card my-3 bg-primary">

                                    <form id="myForm2" class=" card-body cardbody-color p-lg-2 ">

                                        <div class=" row g-3">

                                            <div class="text-center">
                                                <img src="https://cdn.pixabay.com/photo/2016/03/31/19/56/avatar-1295397__340.png"
                                                    class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3"
                                                    width="200px" alt="profile">
                                            </div>

                                            <div class="col-sm-6">
                                                <label for=" " class="form-label">Lecture Id</label>
                                                <input type="text" class="form-control" id="view-Index_num" placeholder=""
                                                    value="" readonly>
                                                <div class="invalid-feedback">
                                                    Valid Lecture name is required.
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <label for=" " class="form-label">Username</label>
                                                <div class="input-group has-validation">
                                                    <input type="text" class="form-control" id="view-username" readonly>
                                                    <div class="invalid-feedback">
                                                        Your username is required.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <label for=" " class="form-label">Email </label>
                                                <input type="email" class="form-control" id="view-email" readonly>
                                                <div class="invalid-feedback">
                                                    Please enter a valid email address.
                                                </div>
                                            </div>


                                            <div class="col-sm-6">
                                                <label for=" " class="form-label">Mobile Number</label>
                                                <input type="number" class="form-control" id="view-phonenumber" readonly>
                                                <div class="invalid-feedback">
                                                    Valid Mobile Number is required.
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <label for=" " class="form-label">Address</label>
                                                <input type="text" class="form-control" id="view-address"
                                                    placeholder="1234, Main St,kegalle" readonly>
                                                <div class="invalid-feedback">
                                                    Please enter your address.
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <label for=" " class="form-label">Lecture Roles</label>
                                                <select class="form-select" id="view-lecturerole" disabled readonly>
                                                    <option value="">Choose...</option>
                                                    <option>Part time Lecture</option>
                                                    <option>Visiting Lecture</option>
                                                    <option>Permernet Lecture</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select a valid Roles.
                                                </div>
                                            </div>


                                            <div class="mb-3">
                                                <label for=" " class="form-label">About
                                                    Lecture</label>
                                                <textarea class="form-control" id="view-about" rows="5"
                                                    readonly></textarea>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" form="myForm2" class="btn btn-primary" onclick="printForm('myForm2')"><i
                            class="bi bi-printer"></i> print
                    </button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
    <!-- Lecture view Modal end -->




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
                                    <button type="button" class="btn btn-primary" id="mybutton1" data-bs-toggle="modal"
                                        data-bs-target="#Lecturecreate">
                                        Add Lecture
                                    </button>
                                </div>

                                <hr>


                                <?php
                                try {
                                    // Prepare the SQL statement
                                    $stmt = $conn->prepare("SELECT id, index_number, username, email, password, expertise, address, mobile_no, role FROM lecturers");
                                    $stmt->execute();
                                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                } catch (PDOException $e) {
                                    echo "Connection failed: " . $e->getMessage();
                                }
                                ?>

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
                                        <?php
                                        if (!empty($result)) {
                                            foreach ($result as $row) {
                                                echo '<tr>';
                                                echo '<td>' . htmlspecialchars($row['index_number']) . '</td>';
                                                echo '<td>' . htmlspecialchars($row['username']) . '</td>';
                                                echo '<td>' . htmlspecialchars($row['email']) . '</td>';
                                                echo '<td>' . htmlspecialchars($row['expertise']) . '</td>';
                                                echo '<td>' . htmlspecialchars($row['address']) . '</td>';
                                                echo '<td>' . htmlspecialchars($row['mobile_no']) . '</td>';
                                                echo '<td class="d-flex align-items-lg-center justify-content-around">';
                                                echo '<a href="#" class="m-1" data-bs-toggle="modal" data-bs-target="#LectureView" ';
                                                echo 'data-id="' . htmlspecialchars($row['id']) . '" ';
                                                echo 'data-index_number="' . htmlspecialchars($row['index_number']) . '" ';
                                                echo 'data-username="' . htmlspecialchars($row['username']) . '" ';
                                                echo 'data-email="' . htmlspecialchars($row['email']) . '" ';
                                                echo 'data-about="' . htmlspecialchars($row['expertise']) . '" ';
                                                echo 'data-address="' . htmlspecialchars($row['address']) . '" ';
                                                echo 'data-mobile_no="' . htmlspecialchars($row['mobile_no']) . '"';
                                                echo 'data-lecturerole="' . htmlspecialchars($row['role']) . '"';
                                                echo 'data-inputPassword="' . htmlspecialchars($row['password']) . '"';
                                                echo '><i class="fas fa-eye fa-lg"></i></a>';
                                                echo '<a href="#" class="m-1" data-bs-toggle="modal" data-bs-target="#Lecturecreate" ';
                                                echo 'data-id="' . htmlspecialchars($row['id']) . '" ';
                                                echo 'data-index_number="' . htmlspecialchars($row['index_number']) . '" ';
                                                echo 'data-username="' . htmlspecialchars($row['username']) . '" ';
                                                echo 'data-email="' . htmlspecialchars($row['email']) . '" ';
                                                echo 'data-about="' . htmlspecialchars($row['expertise']) . '" ';
                                                echo 'data-address="' . htmlspecialchars($row['address']) . '" ';
                                                echo 'data-mobile_no="' . htmlspecialchars($row['mobile_no']) . '"';
                                                echo 'data-lecturerole="' . htmlspecialchars($row['role']) . '"';
                                                echo '><i class="fas fa-user-edit fa-lg"></i></a>';
                                                echo '<a href="#" class="m-1"><i class="fas fa-trash-alt fa-lg"></i></a>';
                                                echo '</td>';
                                                echo '</tr>';
                                            }
                                        } else {
                                            echo '<tr><td colspan="7">No results found</td></tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <?php
                                // Close the connection
                                $conn = null;
                                ?>
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


<script>
document.addEventListener('DOMContentLoaded', function () {

// Function to pre-fill the form when edit button is clicked
document.querySelectorAll('[data-bs-target="#Lecturecreate"]').forEach(function(button) {
    button.addEventListener('click', function() {
        const id = this.getAttribute('data-id');
        const index_number = this.getAttribute('data-index_number');
        const username = this.getAttribute('data-username');
        const email = this.getAttribute('data-email');
        const about = this.getAttribute('data-about');
        const address = this.getAttribute('data-address');
        const mobile_no = this.getAttribute('data-mobile_no');
        const lecturerole = this.getAttribute('data-lecturerole');
        const inputPassword = this.getAttribute('data-inputPassword');

        // Populate the form fields with the selected lecturer's data
        document.getElementById('lecturer-id').value = id;
        document.getElementById('Index_num').value = index_number;
        document.getElementById('username').value = username;
        document.getElementById('email').value = email;
        document.getElementById('phonenumber').value = mobile_no;
        document.getElementById('address').value = address;
        document.getElementById('lecturerole').value = lecturerole;
        document.getElementById('about').value = about;
        document.getElementById('inputPassword').value = inputPassword;
    });
});

// Function to pre-fill the LectureView form when view button is clicked
document.querySelectorAll('[data-bs-target="#LectureView"]').forEach(function(button) {
    button.addEventListener('click', function() {
        const id1 = this.getAttribute('data-id');
        const index_number1 = this.getAttribute('data-index_number');
        const username1 = this.getAttribute('data-username');
        const email1 = this.getAttribute('data-email');
        const about1 = this.getAttribute('data-about');
        const address1 = this.getAttribute('data-address');
        const mobile_no1 = this.getAttribute('data-mobile_no');
        const lecturerole1 = this.getAttribute('data-lecturerole');

        // Populate the form fields with the selected lecturer's data
        document.getElementById('view-Index_num').value = index_number1;
        document.getElementById('view-username').value = username1;
        document.getElementById('view-email').value = email1;
        document.getElementById('view-phonenumber').value = mobile_no1;
        document.getElementById('view-address').value = address1;
        document.getElementById('view-lecturerole').value = lecturerole1;
        document.getElementById('view-about').value = about1;
    });
});

});

</script>