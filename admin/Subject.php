<?php include './include/header.php'; ?>

<!-- Content Start -->
<div class="content">
    <!-- Navbar Start -->
    <?php include './include/navbar.php'; ?>
    <!-- Navbar End -->


    <!-- data Subject table Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h3 class="mb-0">Higher National Diploma All Subject</h3>
                <a class="btn btn-sm btn-primary" href="">Add Subject</a>
            </div>
            <nav>
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
                                $stmt = $conn->query("SELECT id, subject_number, subject_name, semester_id, credits FROM subjects");
                                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                if (!empty($result)) {
                                    foreach ($result as $row) {
                                        echo '<tr>';
                                        echo '<td>' . htmlspecialchars($row['id']) . '</td>';
                                        echo '<td>' . htmlspecialchars($row['subject_number']) . '</td>';
                                        echo '<td>' . htmlspecialchars($row['subject_name']) . '</td>';
                                        echo '<td>' . htmlspecialchars($row['semester_id']) . '</td>';
                                        echo '<td>' . htmlspecialchars($row['credits']) . '</td>';
                                        echo '<td class="d-flex align-items-lg-center justify-content-around">';
                                        echo '<a href="" class=""><i class="fas fa-user-edit fa-lg"></i></a>';
                                        echo '<a href="" class=""><i class="fas fa-trash-alt fa-lg"></i></a>';
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
            </div>

        </div>


    </div>
    <!-- data Subject table End -->

</div>
<!-- Content End -->

<?php include './include/footer.php'; ?>