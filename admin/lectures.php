<?php include './include/header.php'; ?>

<!-- Content Start -->
<div class="content">
    <!-- Navbar Start -->
    <?php include './include/navbar.php'; ?>
    <!-- Navbar End -->

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

                                    <form action="./include/create_lecturers.php" id="myForm" method="POST"
                                        class="card-body cardbody-color p-lg-2" enctype="multipart/form-data">

                                        <div class="row g-3">

                                            <input type="hidden" name="id" id="lecturer-id">

                                            <div class="text-center">
                                                <img src="./include/uploads/pngwing.com.png"
                                                    class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3"
                                                    width="200px" alt="profile">
                                            </div>
                                            <div class="col-12">
                                                <input type="file" name="profile_image" class="form-control" id="image_path">
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
                                                    <option value="Permanent">Permernet Lecture</option>
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
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">View Lecture Profile</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form for viewing lecturer's details -->
                    <div class="container">
                        <div class="row">
                            <div class="justify-content-md-center">
                                <div class="card my-3">

                                    <form id="myForm2" class="card-body cardbody-color p-lg-2">

                                        <div class="row g-3">
                                            <!-- Profile Image -->
                                            <div class="text-center">
                                                <img src="./include/uploads/pngwing.com.png"
                                                    class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3"
                                                    width="200px" alt="profile" id="view-profile-image">
                                            </div>

                                            <!-- Lecture ID -->
                                            <div class="col-sm-6">
                                                <label for="view-Index_num" class="form-label">Lecture Index Number</label>
                                                <input type="text" class="form-control" id="view-Index_num" placeholder=""
                                                    readonly>
                                            </div>

                                            <!-- Username -->
                                            <div class="col-12">
                                                <label for="view-username" class="form-label">Username</label>
                                                <input type="text" class="form-control" id="view-username" readonly>
                                            </div>

                                            <!-- Email -->
                                            <div class="col-12">
                                                <label for="view-email" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="view-email" readonly>
                                            </div>

                                            <!-- Mobile Number -->
                                            <div class="col-sm-6">
                                                <label for="view-phonenumber" class="form-label">Mobile Number</label>
                                                <input type="number" class="form-control" id="view-phonenumber" readonly>
                                            </div>

                                            <!-- Address -->
                                            <div class="col-12">
                                                <label for="view-address" class="form-label">Address</label>
                                                <input type="text" class="form-control" id="view-address" readonly>
                                            </div>

                                            <!-- Lecture Role -->
                                            <div class="col-sm-6">
                                                <label for="view-lecturerole" class="form-label">Lecture Role</label>
                                                <select class="form-select" id="view-lecturerole" disabled>
                                                    <option value="Visiting">Visiting Lecturer</option>
                                                    <option value="Permanent">Permanent Lecturer</option>
                                                </select>
                                            </div>

                                            <!-- About Lecturer -->
                                            <div class="mb-3">
                                                <label for="view-about" class="form-label">About Lecturer</label>
                                                <textarea class="form-control" id="view-about" rows="5" readonly></textarea>
                                            </div>

                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="printForm('myForm2')"><i class="bi bi-printer"></i> Print</button>
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

                                <!-- Search Input Above the Table -->
                                <div class="mb-3">
                                    <input type="search" placeholder="Search..." id="search_student" class="form-control" />
                                </div>


                                <!-- Table with striped rows -->
                                <table class="table text-start align-middle table-bordered table-hover mb-0 table-responsive">
                                    <thead>
                                        <tr>
                                            <th>Index Number</th>
                                            <th>Lecture Name</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Roles</th>
                                            <!-- <th>Re. Date</th> -->
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="output"></tbody>
                                </table>
                                <script>
                                    const searchInput = document.getElementById("search_student");
                                    const outputEl = document.getElementById("output");

                                    // Function to fetch and display lectures
                                    function fetchLectures(query = "") {
                                        const xhr = new XMLHttpRequest();
                                        xhr.open("GET", `./include/search_lecture.php?query=${query}`, true);

                                        xhr.onload = function() {
                                            if (xhr.status === 200) {
                                                const data = JSON.parse(xhr.responseText);
                                                outputEl.innerHTML = ""; // Clear previous output

                                                // Check if any results were returned
                                                if (data.length > 0) {
                                                    data.forEach((lecture) => {
                                                        const row = `
                            <tr>
                                <td>${lecture.index_number}</td>
                                <td>${lecture.username}</td>
                                <td>${lecture.email}</td>
                                <td>${lecture.mobile_no || "N/A"}</td>
                                <td>${lecture.role}</td>
                                <td>
                                    <a href="#" class="m-1" data-bs-toggle="modal" data-bs-target="#LectureView"
                                        data-id="${lecture.id}" data-index_number="${lecture.index_number}" 
                                        data-username="${lecture.username}" data-email="${lecture.email}" 
                                        data-about="${lecture.expertise}" data-address="${lecture.address}" 
                                        data-mobile_no="${lecture.mobile_no}" data-lecturerole="${lecture.role}" 
                                        data-image_path="${lecture.image_path}">
                                        <i class="fas fa-eye fa-lg"></i>
                                    </a>
                                    <a href="#" class="m-1" data-bs-toggle="modal" data-bs-target="#Lecturecreate"
                                        data-id="${lecture.id}" data-index_number="${lecture.index_number}" 
                                        data-username="${lecture.username}" data-email="${lecture.email}" 
                                        data-about="${lecture.expertise}" data-address="${lecture.address}" 
                                        data-mobile_no="${lecture.mobile_no}" data-lecturerole="${lecture.role}" 
                                        data-inputPassword="${lecture.password}" data-image_path="${lecture.image_path}">
                                        <i class="fas fa-user-edit fa-lg"></i>
                                    </a>
                                    <a href="include/delete.php?type=lectures&id=${lecture.id}" 
                                        class="m-1" onclick="return confirm('Are you sure you want to delete this Lecture?')">
                                        <i class="fas fa-trash-alt fa-lg"></i>
                                    </a>
                                </td>
                            </tr>`;
                                                        outputEl.innerHTML += row;
                                                    });
                                                } else {
                                                    outputEl.innerHTML = `<tr><td colspan="7" class="text-center">No results found</td></tr>`;
                                                }
                                            }
                                        };
                                        xhr.send();
                                    }

                                    // Event listener for search input
                                    searchInput.addEventListener("keyup", (e) => fetchLectures(e.target.value));

                                    // Initial fetch to display all lectures
                                    document.addEventListener("DOMContentLoaded", () => fetchLectures("init"));
                                </script>

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