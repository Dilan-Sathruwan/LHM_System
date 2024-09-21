<?php include './include/header.php'; ?>

<!-- Content Start -->
<div class="content">
    <!-- Navbar Start -->
    <?php include './include/navbar.php'; ?>
    <!-- Navbar End -->




    <!-- Lecture Add /Edit Modal -->
    <div class="modal fade" id="Lecturecreate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Create Lecture profile</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- type here -->

                    <div class="container">
                        <div class="row">
                            <div class="justify-content-md-center">


                                <div class="card my-1">

                                    <form id="myForm" class="card-body cardbody-color p-lg-2">

                                        <div class="row g-3">

                                            <div class="text-center">
                                                <img src="https://cdn.pixabay.com/photo/2016/03/31/19/56/avatar-1295397__340.png"
                                                    class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3"
                                                    width="200px" alt="profile">
                                            </div>

                                            <div class="col-sm-6">
                                                <label for="firstName" class="form-label">Lecture Name</label>
                                                <input type="text" class="form-control" id="Lecture Name" placeholder=""
                                                    value="" required>
                                                <div class="invalid-feedback">
                                                    Valid Lecture name is required.
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <label for="password" class="form-label">Password</label>
                                                <input type="password" class="form-control" id="inputPassword3">
                                                <div class="invalid-feedback">
                                                    Valid password is required.
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <label for="username" class="form-label">Username</label>
                                                <div class="input-group has-validation">
                                                    <input type="text" class="form-control" id="username"
                                                        placeholder="Username" required>
                                                    <div class="invalid-feedback">
                                                        Your username is required.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <label for="email" class="form-label">Email </label>
                                                <input type="email" class="form-control" id="email"
                                                    placeholder="you@example.com">
                                                <div class="invalid-feedback">
                                                    Please enter a valid email address.
                                                </div>
                                            </div>


                                            <div class="col-sm-6">
                                                <label for="number" class="form-label">Mobile Number</label>
                                                <input type="number" class="form-control" id="inputnumber">
                                                <div class="invalid-feedback">
                                                    Valid Mobile Number is required.
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <label for="address" class="form-label">Address</label>
                                                <input type="text" class="form-control" id="address"
                                                    placeholder="1234, Main St,kegalle" required>
                                                <div class="invalid-feedback">
                                                    Please enter your address.
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <label for="Lecturerole" class="form-label">Lecture Roles</label>
                                                <select class="form-select" id="lecturerole" required>
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
                                                <label for="exampleFormControlTextarea1" class="form-label">About
                                                    Lecture</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1"
                                                    rows="3"></textarea>
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

                                    <form id="myForm1" class=" card-body cardbody-color p-lg-2 ">

                                        <div class=" row g-3">

                                            <div class="text-center">
                                                <img src="https://cdn.pixabay.com/photo/2016/03/31/19/56/avatar-1295397__340.png"
                                                    class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3"
                                                    width="200px" alt="profile">
                                            </div>

                                            <div class="col-sm-6">
                                                <label for="firstName" class="form-label">Lecture Name</label>
                                                <input type="text" class="form-control" id="Lecture Name" placeholder=""
                                                    value="" readonly>
                                                <div class="invalid-feedback">
                                                    Valid Lecture name is required.
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <label for="password" class="form-label">Password</label>
                                                <input type="password" class="form-control" id="inputPassword3"
                                                    readonly>
                                                <div class="invalid-feedback">
                                                    Valid password is required.
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <label for="username" class="form-label">Username</label>
                                                <div class="input-group has-validation">
                                                    <input type="text" class="form-control" id="username" readonly>
                                                    <div class="invalid-feedback">
                                                        Your username is required.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <label for="email" class="form-label">Email </label>
                                                <input type="email" class="form-control" id="email" readonly>
                                                <div class="invalid-feedback">
                                                    Please enter a valid email address.
                                                </div>
                                            </div>


                                            <div class="col-sm-6">
                                                <label for="number" class="form-label">Mobile Number</label>
                                                <input type="number" class="form-control" id="inputnumber" readonly>
                                                <div class="invalid-feedback">
                                                    Valid Mobile Number is required.
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <label for="address" class="form-label">Address</label>
                                                <input type="text" class="form-control" id="address"
                                                    placeholder="1234, Main St,kegalle" readonly>
                                                <div class="invalid-feedback">
                                                    Please enter your address.
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <label for="Lecturerole" class="form-label">Lecture Roles</label>
                                                <select class="form-select" id="lecturerole" disabled readonly>
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
                                                <label for="exampleFormControlTextarea1" class="form-label">About
                                                    Lecture</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="5"
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
                    <button type="submit" form="myForm2" class="btn btn-primary" onclick="printForm()"><i
                            class="bi bi-printer"></i> print
                    </button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
    <!-- Lecture view Modal end -->


    <script>
    function printForm() {
        // Get the form element
        const form = document.getElementById('myForm1');
        // Save the current page content
        const originalContent = document.body.innerHTML;
        // Replace the body content with just the form's HTML for printing
        document.body.innerHTML = form.outerHTML;
        // Trigger the print dialog for the form
        window.print();
        // Restore the original page content after printing
        document.body.innerHTML = originalContent;
        // Optionally, reload the JavaScript and events after restoring the content
        location.reload(); // Reload to re-initialize events or state (if needed)
    }
    </script>





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
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#Lecturecreate">
                                        Add Lecture
                                    </button>

                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#LectureView">
                                        Add Lecture111
                                    </button>
                                </div>

                                <hr>

                                <!-- Table with stripped rows -->
                                <table class="table datatable text-start align-middle table-bordered table-hover mb-0">
                                    <thead>
                                        <tr>

                                            <th>Index Number</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Address</th>
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
                                            <td>kegalle</td>
                                            <td>012345</td>
                                            <th>permernat</th>
                                            <td>2024-2-3</td>
                                            <td class="d-flex align-items-lg-center justify-content-around">
                                                <a href="" class=""><i class="fas fa-eye fa-lg"></i></a>
                                                <a href="" class=""><i class="fas fa-user-edit fa-lg"></i></a>
                                                <a href="" class=""><i class="fas fa-trash-alt fa-lg"></i></a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>KEG/V/0002</td>
                                            <td>tharuka</td>
                                            <td>tharuka@gmail.com</td>
                                            <td>kegalle</td>
                                            <td>012345</td>
                                            <th>visiting</th>
                                            <td>2024-6-3</td>
                                            <td class="d-flex align-items-lg-center justify-content-around">
                                                <a href="" class="m-1"><i class="fas fa-eye fa-lg"></i></a>
                                                <a href="" class="m-1"><i class="fas fa-user-edit fa-lg"></i></a>
                                                <a href="" class="m-1"><i class="fas fa-trash-alt fa-lg"></i></a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>KEG/V/0003</td>
                                            <td>shehani</td>
                                            <td>shehanis@gmail.com</td>
                                            <td>kegalle</td>
                                            <td>0123454</td>
                                            <th>visiting</th>
                                            <td>2024-6-3</td>
                                            <td class="d-flex align-items-lg-center justify-content-around">
                                                <a href="" class=""><i class="fas fa-eye fa-lg"></i></a>
                                                <a href="" class=""><i class="fas fa-user-edit fa-lg"></i></a>
                                                <a href="" class=""><i class="fas fa-trash-alt fa-lg"></i></a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>KEG/V/0004</td>
                                            <td>ravindu</td>
                                            <td>ravindu@gmail.com</td>
                                            <td>kegalle</td>
                                            <td>012345</td>
                                            <th>visiting</th>
                                            <td>2024-6-3</td>
                                            <td class="d-flex align-items-lg-center justify-content-around">
                                                <a href="" class=""><i class="fas fa-eye fa-lg"></i></a>
                                                <a href="" class=""><i class="fas fa-user-edit fa-lg"></i></a>
                                                <a href="" class=""><i class="fas fa-trash-alt fa-lg"></i></a>
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