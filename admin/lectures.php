<?php include './include/header.php'; ?>

<!-- Content Start -->
<div class="content">
    <!-- Navbar Start -->
    <?php include './include/navbar.php'; ?>
    <!-- Navbar End -->


    <!-- data student table Start -->
    <div class="container-fluid pt-4 px-4">

        <main id="" class="">

            <section class="section">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="card">
                            <div class="card-body table-responsive">
                                <h5 class="card-title">Lectures Datatables</h5>
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