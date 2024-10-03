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
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Create Lecture profile</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- type here -->

                    <div class="container">
                        <div class="row">
                            <div class="justify-content-md-center">


                                <div class="card my-1">

                                    <form id="myFormS" class="card-body cardbody-color p-lg-2">

                                        <div class="row g-3">

                                            <div class="text-center">
                                                <img src="https://cdn.pixabay.com/photo/2016/03/31/19/56/avatar-1295397__340.png"
                                                    class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3"
                                                    width="200px" alt="profile">
                                            </div>

                                            <div class="col-12">
                                                <label for="username" class="form-label">Course Name</label>
                                                <div class="input-group has-validation">
                                                    <input type="text" class="form-control" id="username"
                                                        placeholder=" " required>
                                                    <div class="invalid-feedback">
                                                        Your username is required.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <label for="firstName" class="form-label">Student Index Number</label>
                                                <input type="text" class="form-control" id="Lecture Name" placeholder=""
                                                    value="" required>
                                                <div class="invalid-feedback">
                                                    Valid Student name is required.
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <label for="username" class="form-label">Student Name</label>
                                                <div class="input-group has-validation">
                                                    <input type="text" class="form-control" id="username"
                                                        placeholder="Username" required>
                                                    <div class="invalid-feedback">
                                                        Your username is required.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <label for="email" class="form-label">Email </label>
                                                <input type="email" class="form-control" id="email" placeholder=" ">
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
                                                <label for="Acadamy year" class="form-label">Acadamy year</label>
                                                <select class="form-select" id="lecturerole" required>
                                                    <option value=""></option>
                                                    <option>1 year</option>
                                                    <option>2 year</option>
                                                    <option>3 year</option>
                                                    <option>4 year</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select a valid year
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <label for="Acadamy semester" class="form-label">Acadamy
                                                    semester</label>
                                                <select class="form-select" id="lecturerole" required>
                                                    <option value=""></option>
                                                    <option>1st semester</option>
                                                    <option>2nd semester</option>
                                                    <option>3nd semester</option>
                                                    <option>4nd semester</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select a valid Semester
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
                    <button type="submit" form="myFormS" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <!-- student Add/Edit Modal end -->






    <!-- students view Modal model start-->
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

                                            <div class="col-12">
                                                <label for="username" class="form-label">Course Name</label>
                                                <div class="input-group has-validation">
                                                    <input type="text" class="form-control" id="username"
                                                        placeholder=" " readonly>
                                                    <div class="invalid-feedback">
                                                        Your username is required.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <label for="firstName" class="form-label">Student Index Number</label>
                                                <input type="text" class="form-control" id="Lecture Name" placeholder=""
                                                    value="" readonly>
                                                <div class="invalid-feedback">
                                                    Valid Student name is required.
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <label for="username" class="form-label">Student Name</label>
                                                <div class="input-group has-validation">
                                                    <input type="text" class="form-control" id="username"
                                                        placeholder="Username" readonly>
                                                    <div class="invalid-feedback">
                                                        Your username is required.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <label for="email" class="form-label">Email </label>
                                                <input type="email" class="form-control" id="email" placeholder=" "
                                                    readonly>
                                                <div class="invalid-feedback">
                                                    Please enter a valid email address.
                                                </div>
                                            </div>


                                            <div class="col-sm-6">
                                                <label for="number" class="form-label">Mobile Number</label>
                                                <input type="number" class="form-control" id="inputnumber">
                                                <div class="invalid-feedback" readonly>
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
                                                <label for="Acadamy year" class="form-label">Acadamy year</label>
                                                <select class="form-select" id="lecturerole" disabled readonly>
                                                    <option value=""></option>
                                                    <option>1 year</option>
                                                    <option>2 year</option>
                                                    <option>3 year</option>
                                                    <option>4 year</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select a valid year
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <label for="Acadamy semester" class="form-label">Acadamy
                                                    semester</label>
                                                <select class="form-select" id="lecturerole" disabled readonly>
                                                    <option value=""></option>
                                                    <option>1st semester</option>
                                                    <option>2nd semester</option>
                                                    <option>3nd semester</option>
                                                    <option>4nd semester</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select a valid Semester
                                                </div>
                                            </div>


                                            <div class="mb-3">
                                                <label for="exampleFormControlTextarea1" class="form-label">About
                                                    Lecture</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                                    disabled readonly></textarea>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" form="myForm1" class="btn btn-primary" onclick="printForm('myForm1')"><i
                            class="bi bi-printer"></i> print
                    </button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
    <!-- Lecture view Modal end -->


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
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#studentcreate">
                                        Add Student
                                    </button>

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
                                            <td>2024-2-3</td>
                                            <td class="d-flex align-items-lg-center justify-content-around">
                                                <a href="" class="m-1" data-bs-toggle="modal"
                                                    data-bs-target="#LectureView"><i class="fas fa-eye fa-lg"></i></a>
                                                <a href="" class="m-1" data-bs-toggle="modal"
                                                    data-bs-target="#studentcreate"><i
                                                        class="fas fa-user-edit fa-lg"></i></a>
                                                <a href="" class="m-1"><i class="fas fa-trash-alt fa-lg"></i></a>
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
                                                <a href="" class="m-1" data-bs-toggle="modal"
                                                    data-bs-target="#studentcreate"><i
                                                        class="fas fa-user-edit fa-lg"></i></a>
                                                <a href="" class="m-1"><i class="fas fa-trash-alt fa-lg"></i></a>
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