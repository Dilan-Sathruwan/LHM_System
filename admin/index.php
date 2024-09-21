<?php include './include/header.php'; ?>

<!-- Content Start -->
<div class="content">
    <!-- Navbar Start -->
    <?php include './include/navbar.php'; ?>
    <!-- Navbar End -->



    <!-- students view Modal model start-->
    <div class="modal fade" id="studentView" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
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
                    <button type="submit" form="myFormS1" class="btn btn-primary" onclick="printForm('myForm1')"><i
                            class="bi bi-printer"></i> print
                    </button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
    <!-- student view Modal end -->


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
                    <button type="submit" form="myForm2" class="btn btn-primary" onclick="printForm('myForm2')"><i
                            class="bi bi-printer"></i> print
                    </button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
    <!-- Lecture view Modal end -->






    <!-- Total card Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-users fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Total Students</p>
                        <h6 class="mb-0">404</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-user fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Total Lectures</p>
                        <h6 class="mb-0">21</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-book fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Today Subject</p>
                        <h6 class="mb-0">23</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-building fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Total Lecture Halls</p>
                        <h6 class="mb-0">45</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Total card End -->


    <!-- Recent Sales Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Recent Salse</h6>
                <a href="">Show All</a>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">Date</th>
                            <th scope="col">Invoice</th>
                            <th scope="col">Customer</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>01 Jan 2045</td>
                            <td>INV-0123</td>
                            <td>Jhon Doe</td>
                            <td>$123</td>
                            <td>Paid</td>
                            <td><a class="btn btn-sm btn-primary" href="">Detail</a></td>
                        </tr>
                        <tr>
                            <td>01 Jan 2045</td>
                            <td>INV-0123</td>
                            <td>Jhon Doe</td>
                            <td>$123</td>
                            <td>Paid</td>
                            <td><a class="btn btn-sm btn-primary" href="">Detail</a></td>
                        </tr>
                        <tr>
                            <td>01 Jan 2045</td>
                            <td>INV-0123</td>
                            <td>Jhon Doe</td>
                            <td>$123</td>
                            <td>Paid</td>
                            <td><a class="btn btn-sm btn-primary" href="">Detail</a></td>
                        </tr>
                        <tr>
                            <td>01 Jan 2045</td>
                            <td>INV-0123</td>
                            <td>Jhon Doe</td>
                            <td>$123</td>
                            <td>Paid</td>
                            <td><a class="btn btn-sm btn-primary" href="">Detail</a></td>
                        </tr>
                        <tr>
                            <td>01 Jan 2045</td>
                            <td>INV-0123</td>
                            <td>Jhon Doe</td>
                            <td>$123</td>
                            <td>Paid</td>
                            <td><a class="btn btn-sm btn-primary" href="">Detail</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>


    </div>
    <!-- Recent Sales End -->


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
                                            <th>View</th>
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
                                                    data-bs-target="#studentView"><i class="fas fa-eye fa-lg"></i></a>
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

    <hr>

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
                                </div>

                                <hr>

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
                                        <tr>
                                            <td>KEG/V/0001</td>
                                            <td>Dilan</td>
                                            <td>dilan@gmail.com</td>
                                            <td>012345</td>
                                            <th>permernat</th>
                                            <td>2024-2-3</td>
                                            <td class="d-flex align-items-lg-center justify-content-around">
                                                <a href="" class="" data-bs-toggle="modal"
                                                    data-bs-target="#LectureView"><i class="fas fa-eye fa-lg"></i></a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>KEG/V/0002</td>
                                            <td>tharuka</td>
                                            <td>tharuka@gmail.com</td>
                                            <td>012345</td>
                                            <th>visiting</th>
                                            <td>2024-6-3</td>
                                            <td class="d-flex align-items-lg-center justify-content-around">
                                                <a href="" class="m-1"><i class="fas fa-eye fa-lg"></i></a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>KEG/V/0003</td>
                                            <td>shehani</td>
                                            <td>shehanis@gmail.com</td>
                                            <td>0123454</td>
                                            <th>visiting</th>
                                            <td>2024-6-3</td>
                                            <td class="d-flex align-items-lg-center justify-content-around">
                                                <a href="" class=""><i class="fas fa-eye fa-lg"></i></a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>KEG/V/0004</td>
                                            <td>ravindu</td>
                                            <td>ravindu@gmail.com</td>
                                            <td>012345</td>
                                            <th>visiting</th>
                                            <td>2024-6-3</td>
                                            <td class="d-flex align-items-lg-center justify-content-around">
                                                <a href="" class=""><i class="fas fa-eye fa-lg"></i></a>
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